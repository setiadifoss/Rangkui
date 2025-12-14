<?php

namespace App\Modules\System\Models;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use Config\Services;

class IndexBiblioModel extends Model
{
    protected $table      = 'search_biblio';
    protected $primaryKey = 'biblio_id';
    protected $protectFields      = false;
    protected $useTimestamps      = true;
    protected $createdField       = 'input_date';
    protected $updatedField       = 'last_update';

    public $total_records = 0;
    public $indexed = 0;
    public $failed = array();
    public $errors = array();
    public $indexingTime = 0;
    private $exclude = array();
    private $obj_db = false;
    private $verbose = false;
    private $max_indexed = 1000000;
    public $index_type = 'mysql';

    function createFullIndex(?bool $emptyIndex = false)
    {
        if ($emptyIndex == true) {
            $this->truncate();
        }

        $bilblio = $this->db->table('biblio')
            ->orderBy('biblio_id')
            ->limit($this->max_indexed);

        $totalRows = $bilblio->countAllResults();

        if ($totalRows > 0) {
            $bil = $bilblio->get()->getResult();
            $this->_processingIndex($totalRows, $bil);
        }
    }

    function updateFullIndex()
    {
        switch ($this->index_type) {
            case 'nosql':
                $mongo = Services::mongo();
                $collection = $mongo->biblio->find()->toArray();

                // Ekstrak kolom 'id' dari setiap dokumen
                $list_biblio_id = array_map(function ($doc) {
                    return (string) $doc['biblio_id'];
                }, $collection);

                $bilblio = $this->db->table('biblio')
                    ->whereNotIn('biblio_id', $list_biblio_id)
                    ->get();

                break;

            case 'mysql':
                $sql = "SELECT
                            b.biblio_id
                        FROM
                            biblio AS b
                        LEFT JOIN search_biblio AS sb ON
                            b.biblio_id = sb.biblio_id
                        WHERE
                            sb.biblio_id IS NULL
                        ORDER BY b.biblio_id
                        LIMIT " . $this->max_indexed;
                $bilblio = $this->db->query($sql);

                break;
        }



        $totalRows = $bilblio->getNumRows();


        if ($totalRows > 0) {
            $bil = $bilblio->getResult();
            $this->_processingIndex($totalRows, $bil);
        }
    }

    private function _processingIndex($totalRows, $bilblio)
    {
        $_start = function_exists('microtime') ? microtime(true) : time();
        $this->total_records = $totalRows;

        foreach ($bilblio as $key => $val) {
            $biblio_id = $val->biblio_id;

            $data = [];
            $this->makeIndex($biblio_id, $data);

            if ($this->index_type == 'nosql') {

                $mongo = Services::mongo();

                $collection = $mongo->biblio;
                $collection->insertOne($data);

                // create index
                $collection->createIndex(['title' => 1, 'author' => 1, 'topic' => 1]);

                $this->indexed++;
            } else {
                $this->db->transBegin();

                $this->insert($data);

                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    $this->failed[] = [
                        'id'      => $biblio_id,
                        'message' => $this->db->error()
                    ];
                } else {
                    $this->db->transCommit();
                    $this->indexed++;
                }
            }
        }

        // get end time
        $_end = function_exists('microtime') ? microtime(true) : time();
        $this->indexingTime = $_end - $_start;
    }

    function makeIndex(int $biblio_id, array &$data)
    {
        $sql = "SELECT
                    b.biblio_id,
                    b.title,
                    b.edition,
                    b.publish_year,
                    b.notes,
                    b.series_title,
                    b.classification,
                    b.spec_detail_info,
                    g.gmd_name AS `gmd`,
                    pb.publisher_name AS `publisher`,
                    pl.place_name AS `publish_place`,
                    b.isbn_issn,
                    lg.language_name AS `language`,
                    b.call_number,
                    b.opac_hide,
                    b.promoted,
                    b.labels,
                    b.`collation`,
                    b.image,
                    b.input_date,
                    b.last_update
                FROM
                    biblio AS b
                LEFT JOIN mst_gmd AS g ON
                    b.gmd_id = g.gmd_id
                LEFT JOIN mst_publisher AS pb ON
                    b.publisher_id = pb.publisher_id
                LEFT JOIN mst_place AS pl ON
                    b.publish_place_id = pl.place_id
                LEFT JOIN mst_language AS lg ON
                    b.language_id = lg.language_id
                WHERE
                    b.biblio_id = ? ";

        $recBib = $this->query($sql, [$biblio_id]);

        if ($recBib->getNumRows() > 0) {
            $data = $recBib->getRowArray(); // Ambil data array asli

            /**
             * GMD, Title, Year
             */
            array_walk_recursive($data, function (&$row, $key) {
                if ($key == 'labels') {
                    if (!empty($row) || !is_null($row)) {
                        $row = 'literal{NULL}';
                    }
                }

                if ($key == 'notes') {
                    $row = trim($this->db->escapeString(strip_tags($row, '<br><p><div><span><i><em><strong><b><code>')));
                }

                if (!is_null($row)) {
                    $row = $this->db->escapeString($row);
                }
            });

            /**
             * Author
             */
            $this->_author($biblio_id, $data);
            /**
             * Examiner
             */
            $this->_examiner($biblio_id, $data);
            /**
             * Supervisor
             */
            $this->_supervisor($biblio_id, $data);
            /**
             * Contributor
             */
            $this->_contributor($biblio_id, $data);

            /**
             * Subject
             */
            $this->_subject($biblio_id, $data);

            /**
             * Items 
             */
            $this->_items($biblio_id, $data);

            /**
             * Location
             */
            $this->_location($biblio_id, $data);

            /**
             * Collection Types
             */
            $this->_collType($biblio_id, $data);
        }
    }

    private function _author(int $biblio_id, array &$data)
    {
        $au_sql = "SELECT
                            ba.biblio_id,
                            ba.level,
                            au.author_name AS `name`,
                            au.authority_type AS `type`
                        FROM
                            biblio_author AS ba
                        LEFT JOIN mst_author AS au ON
                            ba.author_id = au.author_id
                        WHERE
                            ba.biblio_id = ?";
        $au_id = $this->db->query($au_sql, [$biblio_id]);

        $au_all = '';
        if ($au_id->getNumRows() > 0) {
            $rows = $au_id->getResult();
            foreach ($rows as $key => $val) {
                $au_all .= $val->name . ' - ';
            }

            $data['author'] = $this->db->escapeString($au_all);
        }
    }
    private function _examiner(int $biblio_id, array &$data)
    {
        $au_sql = "SELECT
                        ba.biblio_id,
                        ba.level,
                        au.examiner_name AS `name`,
                        au.examiner_type AS `type`
                    FROM
                        biblio_examiner AS ba
                    LEFT JOIN mst_examiner AS au ON
                        ba.examiner_id = au.examiner_id 
                    WHERE
                        ba.biblio_id = ?";
        $au_id = $this->db->query($au_sql, [$biblio_id]);

        $au_all = '';
        if ($au_id->getNumRows() > 0) {
            $rows = $au_id->getResult();
            foreach ($rows as $key => $val) {
                $au_all .= $val->name . ' - ';
            }

            $data['examiner'] = $this->db->escapeString($au_all);
        }
    }
    private function _supervisor(int $biblio_id, array &$data)
    {
        $au_sql = "SELECT
                        ba.biblio_id,
                        ba.level,
                        au.supervisor_name AS `name`,
                        au.supervisor_type AS `type`
                    FROM
                        biblio_supervisor AS ba
                    LEFT JOIN mst_supervisor AS au ON
                        ba.supervisor_id = au.supervisor_id 
                    WHERE
                        ba.biblio_id = ?";
        $au_id = $this->db->query($au_sql, [$biblio_id]);

        $au_all = '';
        if ($au_id->getNumRows() > 0) {
            $rows = $au_id->getResult();
            foreach ($rows as $key => $val) {
                $au_all .= $val->name . ' - ';
            }

            $data['supervisor'] = $this->db->escapeString($au_all);
        }
    }
    private function _contributor(int $biblio_id, array &$data)
    {
        $au_sql = "SELECT
                        ba.biblio_id,
                        ba.level,
                        au.contributor_name AS `name`,
                        au.contributor_type AS `type`
                    FROM
                        biblio_contributor AS ba
                    LEFT JOIN mst_contributor AS au ON
                        ba.contributor_id = au.contributor_id 
                    WHERE
                        ba.biblio_id = ?";
        $au_id = $this->db->query($au_sql, [$biblio_id]);

        $au_all = '';
        if ($au_id->getNumRows() > 0) {
            $rows = $au_id->getResult();
            foreach ($rows as $key => $val) {
                $au_all .= $val->name . ' - ';
            }

            $data['contributor'] = $this->db->escapeString($au_all);
        }
    }

    private function _subject(int $biblio_id, array &$data)
    {
        $topic_sql = "SELECT
                            bt.biblio_id,
                            bt.level,
                            tp.topic,
                            tp.topic_type AS `type`
                        FROM
                            biblio_topic AS bt
                        LEFT JOIN mst_topic AS tp ON
                            bt.topic_id = tp.topic_id
                        WHERE
                            bt.biblio_id = ?";
        $topic_all = '';


        $topic_id = $this->db->query($topic_sql, [$biblio_id]);

        if ($topic_id->getNumRows() > 0) {
            $topic_rows = $topic_id->getResult();
            foreach ($topic_rows as $key => $val) {
                $topic_all .= $val->topic . ' - ';
            }

            $topic_all = substr_replace($topic_all, '', -3);
            $data['topic'] = $this->db->escapeString($topic_all);
        }
    }

    private function _items(int $biblio_id, array &$data)
    {
        $barcode_all = '';
        $barcode_sql = "SELECT
                                i.item_code
                            FROM
                                item AS i
                            WHERE
                                i.biblio_id = ? ";
        $barcode_q = $this->db->query($barcode_sql, [$biblio_id]);

        if ($barcode_q->getNumRows() > 0) {
            $barcode_rows = $barcode_q->getResult();
            foreach ($barcode_rows as $key => $val) {
                $barcode_all .= $val->item_code . ' - ';
            }

            $barcode_all = substr_replace($barcode_all, '', -3);
            $data['items'] = $barcode_all;
        }
    }

    private function _location(int $biblio_id, array &$data)
    {
        $loc_all = '';
        $loc_sql = "SELECT
                            i.biblio_id,
                            l.location_name AS `name`
                        FROM
                            item AS i
                        LEFT JOIN mst_location AS l ON
                            i.location_id = l.location_id
                        WHERE
                            i.biblio_id = ?";
        $loc_id = $this->db->query($loc_sql, [$biblio_id]);
        if ($loc_id->getNumRows() > 0) {
            $loc_rows = $loc_id->getResult();
            $_prev_loc = '';
            foreach ($loc_rows as $key => $val) {
                if ($val->name == $_prev_loc) {
                    continue;
                }
                $loc_all .= $val->name . ' - ';
                $_prev_loc = $val->name;
            }

            $loc_all = substr_replace($loc_all, '', -3);
            $data['location'] = $this->db->escapeString($loc_all);
        }
    }

    private function _collType(int $biblio_id, array &$data)
    {
        $colltype_all = '';
        $colltype_sql = "SELECT
                            ct.coll_type_name AS `name`
                        FROM
                            item AS i
                        LEFT JOIN mst_coll_type AS ct ON
                            i.coll_type_id = ct.coll_type_id
                        WHERE
                            i.biblio_id = ? ";
        $colltype_q = $this->db->query($colltype_sql, [$biblio_id]);
        $_prev_colltype = '';
        if ($colltype_q->getNumRows() > 0) {
            $colltype_rows = $colltype_q->getResult();
            foreach ($colltype_rows as $key => $val) {
                if ($val->name == $_prev_colltype) {
                    continue;
                }

                $colltype_all .= $val->name . ' - ';
                $_prev_colltype = $val->name;
            }

            $colltype_all = substr_replace($colltype_all, '', -3);
            $data['collection_types'] = $this->db->escapeString($colltype_all);
        }
    }
}
