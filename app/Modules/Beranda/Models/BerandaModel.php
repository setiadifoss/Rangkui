<?php

namespace App\Modules\Beranda\Models;

use MongoDB\Client;
use Config\Services;
use App\Models\BaseModel;

use function PHPSTORM_META\map;
use MongoDB\Exception\Exception;

class BerandaModel extends BaseModel
{


    public function biblio($biblio_id = null, $limit = null)
    {
        $where = $lm = '';
        if (!is_null($biblio_id)) {
            $where  = " WHERE b.biblio_id = $biblio_id ";
            $result = false;
        } else {
            $result = [];
        }
        if (!is_null($limit)) {
            $lm = " LIMIT $limit ";
        }
        $sql = "SELECT
                    b.*,
                    (SELECT mg.gmd_name FROM mst_gmd mg WHERE mg.gmd_id = b.gmd_id LIMIT 1) gmd,
                    (SELECT ml.language_name FROM mst_language ml WHERE ml.language_id = b.language_id LIMIT 1) language,
                    (SELECT mcm.name_prodi FROM mst_code_ministry mcm WHERE mcm.code_ministry = b.code_ministry LIMIT 1) ministry,
                    (SELECT mp.publisher_name FROM mst_publisher mp WHERE mp.publisher_id = b.publisher_id LIMIT 1) publisher,
                    (SELECT mp.place_name FROM mst_place mp WHERE mp.place_id = b.publish_place_id LIMIT 1) publisher_place,
                    (SELECT ml.license_name FROM mst_license ml WHERE ml.license_id = b.license_id LIMIT 1) licence,
                    (SELECT mc.copyright_name FROM mst_copyright mc WHERE mc.copyright_id = b.copyright_id LIMIT 1) copyright,
                    (SELECT mit.item_type_name FROM mst_item_type mit WHERE mit.item_type_id = b.item_type_id LIMIT 1) item_type
                FROM
                    biblio b 
                 $where ORDER BY b.biblio_id DESC 
                 $lm;";
        $query  = $this->db->query($sql);
        if ($query->getNumRows() > 0) {
            if (!is_null($biblio_id)) {
                $result = $query->getRow();
            } else {
                $result = $query->getResult();
            }
        }
        return $result;
    }
    function biblio_author($biblio_id)
    {
        $sql = "SELECT
                ba.`level` ,
                ma.*
            FROM
                biblio_author ba
            JOIN mst_author ma ON
                ma.author_id = ba.author_id
            WHERE
                ba.biblio_id =$biblio_id";
        $query  = $this->db->query($sql);
        $result = [];
        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        }

        return $result;
    }
    function biblio_supervisor($biblio_id)
    {
        $sql = "SELECT
                    bs.`level` ,
                    ms.*
                FROM
                    biblio_supervisor bs
                JOIN mst_supervisor ms ON
                    bs.supervisor_id = ms.supervisor_id
                WHERE
                    bs.biblio_id = $biblio_id";
        $query  = $this->db->query($sql);
        $result = [];
        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        }
        return $result;
    }
    function biblio_examiner($biblio_id)
    {
        $sql = "SELECT
                    be.`level`,
                    me.*
                FROM
                    biblio_examiner be
                JOIN mst_examiner me ON
                    be.examiner_id = me.examiner_id
                WHERE
                    be.biblio_id = $biblio_id";
        $query  = $this->db->query($sql);
        $result = [];
        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        }
        return $result;
    }
    function biblio_contributor($biblio_id)
    {
        $sql = "SELECT
                    bc.`level`,
                    mc.*
                FROM
                    biblio_contributor bc 
                JOIN mst_contributor mc ON
                    bc.contributor_id = mc.contributor_id 
                WHERE
                    bc.biblio_id = $biblio_id";
        $query  = $this->db->query($sql);
        $result = [];
        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        }
        return $result;
    }
    function biblio_topic($biblio_id)
    {
        $sql = "SELECT 
                    bt.`level`,
                    mt.* 
                FROM biblio_topic bt
                JOIN mst_topic mt ON
                    bt.topic_id = mt.topic_id 
                WHERE
                    bt.biblio_id = $biblio_id";
        $query  = $this->db->query($sql);
        $result = [];
        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        }
        return $result;
    }
    function biblio_attachment($biblio_id)
    {
        $sql = "SELECT
                    ba.access_type,
                    ba.access_limit,
                    f.*
                FROM
                    biblio_attachment ba
                JOIN files f ON
                    f.file_id = ba.file_id
                WHERE
                    ba.biblio_id = $biblio_id";
        $query  = $this->db->query($sql);
        $result = [];
        if ($query->getNumRows() > 0) {
            $result = $query->getResult();
        }
        return $result;
    }

    function biblio_location($biblio_id)
    {
        $sql = "SELECT 
                    i.item_code, 
                    i.call_number, 
                    stat.item_status_name, 
                    loc.location_name, 
                    stat.rules, 
                    i.site 
                FROM 
                    item AS i
                LEFT JOIN 
                    mst_item_status AS stat ON i.item_status_id = stat.item_status_id
                LEFT JOIN 
                    mst_location AS loc ON i.location_id = loc.location_id
                WHERE 
                    i.biblio_id = :biblio_id:";
        $query = $this->db->query($sql, ['biblio_id' => $biblio_id]);
        $result = [];

        if ($query->getNumRows() > 0) {
            $result = $query->getResultArray();
        }

        return $result;
    }
    function search_biblio($get)
    {
        $result     = [];
        $index_type = env('INDEX_TYPE', 'mysql');
        if ($index_type == "mysql") {

            $search_column = ['title', 'author', 'topic'];
            $filter = '';
            foreach ($search_column as $key => $column) {
                if ($key > 0) {
                    $filter .= " OR ";
                }
                $filter .= " $column LIKE '%$get%' ";
            }
            $sql = "SELECT
                    *
                FROM
                    search_biblio
                WHERE $filter
                ORDER BY biblio_id DESC";
            $query  = $this->db->query($sql);
            if ($query->getNumRows() > 0) {
                $result = $query->getResult();
            }
        } else {
            $mongo = Services::mongo();
            //check avaibility mongodb
            $output = "";
            exec("php -i | grep -i mongodb", $output);

            $filteredArray = array_filter($output, function ($item) {
                return strpos($item, 'MONGO_URL') === false;
            });

            if ($filteredArray !== "" || $filteredArray == true) {
                $packageMongo = \Composer\InstalledVersions::getPrettyVersion('mongodb/mongodb');

                if (!is_null($packageMongo)) {
                    $collection = $mongo->biblio;


                    try {
                        $filter = [
                            '$or' => [
                                ['author' => ['$regex' => $get, '$options' => 'i']],
                                ['title'  => ['$regex' => $get, '$options' => 'i']],
                                ['topic'  => ['$regex' => $get, '$options' => 'i']],
                            ]
                        ];
                        $result_array = $collection->find($filter)->toArray();
                        $result       = json_decode(json_encode($result_array), FALSE);
                    } catch (Exception $e) {

                        return $result = [];
                    }
                }
            }
        }
        return $result;
    }
    function search_biblio_specific($column, $get)
    {
        $get        = rawurldecode($get);
        $result     = [];
        $index_type = $_ENV['INDEX_TYPE'];
        if ($index_type == "mysql") {

            $sql = "SELECT
                    *
                FROM
                    search_biblio
                WHERE $column LIKE '%$get%' 
                ORDER BY biblio_id DESC";
            $query  = $this->db->query($sql);
            if ($query->getNumRows() > 0) {
                $result = $query->getResult();
            }
        } else {
            $mongo = Services::mongo();
            //check avaibility mongodb
            $output = "";
            exec("php -i | grep -i mongodb", $output);

            $filteredArray = array_filter($output, function ($item) {
                return strpos($item, 'MONGO_URL') === false;
            });

            if ($filteredArray !== "" || $filteredArray == true) {
                $packageMongo = \Composer\InstalledVersions::getPrettyVersion('mongodb/mongodb');

                if (!is_null($packageMongo)) {
                    $collection = $mongo->biblio;
                    $filter = [
                        '$or' => [
                            [$column => ['$regex' => $get, '$options' => 'i']],
                        ]
                    ];
                    $result_array = $collection->find($filter)->toArray();
                    $result       = json_decode(json_encode($result_array), FALSE);
                }
            }
        }
        return $result;
    }
}
