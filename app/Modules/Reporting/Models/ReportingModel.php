<?php

namespace App\Modules\Reporting\Models;

use App\Models\BaseModel;

class ReportingModel extends BaseModel
{

    function getTitleReport($title = "", $author = "", $class = "", $gmd = [], $coll_type = [], $lang = "", $loc = "")
    {
        $extra_condition = "";

        $this->_titleFilter($extra_condition, $title);
        $this->_authorFilter($extra_condition, $author);
        $this->_classFilter($extra_condition, $class);
        $this->_gmdFilter($extra_condition, $gmd);
        $this->_collTypeFilter($extra_condition, $coll_type);
        $this->_langFilter($extra_condition, $lang);
        $this->_locFilter($extra_condition, $loc);

        $sql = "SELECT 
                    b.*,
                    pl.place_name,
                    pb.publisher_name,
                    mg.gmd_name,
                    (SELECT
                        GROUP_CONCAT(a.author_name SEPARATOR ' - ') AS authors
                    FROM
                        biblio AS bi
                    LEFT JOIN biblio_author AS ba ON
                        bi.biblio_id = ba.biblio_id
                    LEFT JOIN mst_author AS a ON
                        ba.author_id = a.author_id
                    WHERE bi.biblio_id = b.bid) authors
                FROM (SELECT
                        DISTINCT bsub.biblio_id as bid,
                        bsub.gmd_id,
                        bsub.title,
                        bsub.isbn_issn,
                        bsub.call_number,
                        bsub.classification,
                        bsub.language_id,
                        bsub.publish_place_id,
                        bsub.publisher_id
                    FROM
                        biblio AS bsub
                    LEFT JOIN biblio_author AS ba ON
                        bsub.biblio_id = ba.biblio_id
                    LEFT JOIN mst_author AS ma ON
                        ba.author_id = ma.author_id
                    LEFT JOIN biblio_topic AS bt ON
                        bsub.biblio_id = bt.biblio_id
                    LEFT JOIN mst_topic AS mt ON
                        bt.topic_id = mt.topic_id
                    WHERE
                        bsub.biblio_id IS NOT NULL {$extra_condition}
                    ) AS b
                LEFT JOIN item AS i ON b.bid=i.biblio_id
                LEFT JOIN mst_place AS pl ON b.publish_place_id=pl.place_id
                LEFT JOIN mst_publisher AS pb ON b.publisher_id=pb.publisher_id
                LEFT JOIN mst_gmd mg ON mg.gmd_id = b.gmd_id
                GROUP BY bid ";

        $data = $this->db->query($sql);

        return $data;
    }

    function _titleFilter(&$extra_condition, $title)
    {
        if (!empty($title)) {
            $keywords = trim($title);

            $words = explode(" ", $keywords);
            if (count($words) > 1) {
                $conditions = array_map(function ($word) {
                    return "(bsub.title LIKE '%$word%' OR bsub.isbn_issn LIKE '%$word%')";
                }, $words);

                $concat_sql = ' AND (' . implode(' AND ', $conditions) . ') ';
                $extra_condition .= $concat_sql;
            } else {
                $extra_condition .= " AND (bsub.title LIKE '%$keywords%' OR bsub.isbn_issn LIKE '%$keywords%')";
            }
        }
    }

    function _authorFilter(&$extra_condition, $author)
    {
        if (!empty($author)) {
            $extra_condition .= " AND ma.author_name LIKE '%{$author}%' ";
        }
    }

    function _classFilter(&$extra_condition, $class)
    {
        if (!empty($class)) {
            $extra_condition .= " AND bsub.classification LIKE '%{$class}%' ";
        }
    }

    function _gmdFilter(&$extra_condition, $gmd)
    {
        if (!empty($gmd)) {
            $gmd_IDs = implode(',', array_filter(array_map('intval', $gmd)));

            if ($gmd_IDs) {
                $extra_condition .= " AND bsub.gmd_id IN($gmd_IDs)";
            }
        }
    }

    function _collTypeFilter(&$extra_condition, $coll_type)
    {
        if (!empty($coll_type)) {
            $collTypes = implode(',', array_filter(array_map('intval', $coll_type)));

            if ($collTypes) {
                $extra_condition .= " AND i.coll_type_id IN($collTypes)";
            }
        }
    }

    function _langFilter(&$extra_condition, $lang)
    {
        if (!empty($lang)) {
            $extra_condition .= " AND bsub.language_id={$lang} ";
        }
    }

    function _locFilter(&$extra_condition, $loc)
    {
        if (!empty($loc)) {
            $extra_condition .= " AND i.location_id={$loc} ";
        }
    }


    /**
     * Contributors
     */
    function getContributorsReport($title = "", $author = "", $class = "", $contributor_type = [], $item_type = [], $subject = "", $contributor_name = "")
    {
        $extra_condition = " ";

        $this->_titleFilter($extra_condition, $title);
        $this->_authorFilter($extra_condition, $author);
        $this->_classFilter($extra_condition, $class);
        $this->_contributorFilter($extra_condition, $contributor_type);
        $this->_itemTypeFilter($extra_condition, $item_type);
        $this->_subjectFilter($extra_condition, $subject);
        $this->_contributorNameFilter($extra_condition, $contributor_name);

        $sql = "SELECT
                    b.*,
                    mit.item_type_name,
                    mt.topic,
                    mc.contributor_name ,
                    b.publish_year,
                     (SELECT
                        GROUP_CONCAT(a.author_name SEPARATOR ' - ') AS authors
                    FROM
                        biblio AS bi
                    LEFT JOIN biblio_author AS ba ON
                        bi.biblio_id = ba.biblio_id
                    LEFT JOIN mst_author AS a ON
                        ba.author_id = a.author_id
                    WHERE bi.biblio_id = b.biblio_id) authors,
                    (SELECT
                       GROUP_CONCAT(a.topic SEPARATOR ' - ') AS subject
                    FROM
                        biblio AS bi
                    LEFT JOIN biblio_topic AS bt ON
                        bi.biblio_id = bt.biblio_id
                    LEFT JOIN mst_topic AS a ON
                        bt.topic_id = a.topic_id
                    WHERE
                        bi.biblio_id  = b.biblio_id
                    ) subject
                FROM
                    (
                    SELECT
                        DISTINCT bsub.biblio_id,
                        bsub.title,
                        bsub.isbn_issn,
                        bsub.call_number,
                        bsub.classification,
                        bsub.language_id,
                        bsub.publish_place_id,
                        bsub.publisher_id,
                        bsub.publish_year,
                        bsub.item_type_id,
                        mc.contributor_name
                    FROM
                        biblio AS bsub
                    LEFT JOIN biblio_author AS ba ON
                        bsub.biblio_id = ba.biblio_id
                    LEFT JOIN mst_item_type AS mit ON
                        bsub.item_type_id = mit.item_type_id
                    LEFT JOIN mst_author AS ma ON
                        ba.author_id = ma.author_id
                    LEFT JOIN biblio_topic AS bt ON
                        bsub.biblio_id = bt.biblio_id
                    LEFT JOIN mst_topic AS mt ON
                        bt.topic_id = mt.topic_id
                    LEFT JOIN biblio_contributor AS bc ON
                        bsub.biblio_id = bc.biblio_id
                    LEFT JOIN mst_contributor AS mc ON
                        bc.contributor_id = mc.contributor_id
                    WHERE
                        bsub.biblio_id IS NOT NULL {$extra_condition} ) AS b
                LEFT JOIN item AS i ON
                    b.biblio_id = i.biblio_id
                LEFT JOIN mst_item_type AS mit ON
                    b.item_type_id = mit.item_type_id
                LEFT JOIN mst_place AS pl ON
                    b.publish_place_id = pl.place_id
                LEFT JOIN mst_publisher AS pb ON
                    b.publisher_id = pb.publisher_id
                LEFT JOIN biblio_topic AS bt ON
                    b.biblio_id = bt.biblio_id
                LEFT JOIN mst_topic AS mt ON
                    bt.topic_id = mt.topic_id
                LEFT JOIN biblio_contributor AS bc ON
                    b.biblio_id = bc.biblio_id
                LEFT JOIN mst_contributor AS mc ON
                    bc.contributor_id = mc.contributor_id
                GROUP BY b.biblio_id";

        $data = $this->db->query($sql);

        return $data;
    }

    function _contributorFilter(&$extra_condition, $contributor)
    {
        if (!empty($contributor)) {
            $contributor_IDs = implode(',', array_filter(array_map('intval', $contributor)));

            if ($contributor_IDs) {
                $extra_condition .= " AND bt.level IN($contributor_IDs)";
            }
        }
    }

    function _itemTypeFilter(&$extra_condition, $item_type)
    {
        if (!empty($item_type)) {
            $item_type_IDs = implode(',', array_filter(array_map('intval', $item_type)));

            if ($item_type_IDs) {
                $extra_condition .= " AND mit.item_type_id IN($item_type_IDs)";
            }
        }
    }

    function _subjectFilter(&$extra_condition, $subject)
    {
        if (!empty($subject)) {
            $extra_condition .= " AND mt.topic LIKE '%{$subject}%' ";
        }
    }

    function _contributorNameFilter(&$extra_condition, $contributtor_name)
    {
        if (!empty($contributtor_name)) {
            $extra_condition .= " AND mc.contributor_name LIKE '%{$contributtor_name}%' ";
        }
    }

    function getStafActReport($start_date, $end_date)
    {
        $sql = " SELECT
                    u.user_id,
                    u.username,
                    u.realname,
                    u.user_type,
                    (
                        SELECT
                            COUNT(log_id)
                        FROM
                            system_log
                        WHERE
                            log_location = 'bibliography'
                            AND log_type = 'staff'
                            AND log_msg LIKE '%insert bibliographic data%'
                            AND id = u.user_id
                            -- Gantikan dengan prepared statement
                            AND TO_DAYS(log_date) BETWEEN TO_DAYS(:startdate:) AND TO_DAYS(:enddate:)
                    ) AS biblio_total,
                    (
                        SELECT
                            COUNT(log_id)
                        FROM
                            system_log
                        WHERE
                            log_location = 'bibliography'
                            AND log_type = 'staff'
                            AND log_msg LIKE '%insert item data%'
                            AND id = u.user_id
                            -- Gantikan dengan prepared statement
                            AND TO_DAYS(log_date) BETWEEN TO_DAYS(:startdate:) AND TO_DAYS(:enddate:)
                    ) AS item_total,
                    (
                        SELECT
                            COUNT(log_id)
                        FROM
                            system_log
                        WHERE
                            log_location = 'membership'
                            AND log_type = 'staff'
                            AND log_msg LIKE '%add new member%'
                            AND id = u.user_id
                            -- Gantikan dengan prepared statement
                            AND TO_DAYS(log_date) BETWEEN TO_DAYS(:startdate:) AND TO_DAYS(:enddate:)
                    ) AS member_total,
                    (
                    SELECT
                        COUNT(log_id)
                    FROM
                        system_log
                    WHERE
                        log_location = 'circulation'
                        AND log_type = 'member'
                        AND (log_msg LIKE CONCAT(u.user_id, '%transaction with member%')
                            OR log_msg LIKE CONCAT(u.user_id, '%Quick Return%'))
                            AND TO_DAYS(log_date) BETWEEN TO_DAYS(:startdate:) AND TO_DAYS(:enddate:)
                    ) AS circulation_total
                FROM
                    `user` u";

        $data = $this->db->query($sql, [
            'startdate' => $start_date,
            'enddate' => $end_date
        ]);

        return $data;
    }
}
