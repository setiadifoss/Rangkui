<?php

namespace App\Libraries;

use CodeIgniter\Database\BaseBuilder;

class MODSoutputLibrary
{
    protected $db;
    protected $record_detail;
    protected $detail_id;
    protected $detail_prefix;
    protected $detail_suffix;

    public function __construct($record_detail, $detail_id)
    {
        $this->db = \Config\Database::connect();
        $this->record_detail = $record_detail;
        $this->detail_id = $detail_id;
    }

    public function MODSoutput()
    {
        $sysconf = config('SysConf'); // Ambil konfigurasi global dari file konfigurasi
        // set prefix and suffix
        $this->detail_prefix = '<modsCollection xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.loc.gov/mods/v3" xmlns:slims="http://slims.web.id" xsi:schemaLocation="http://www.loc.gov/mods/v3 http://www.loc.gov/standards/mods/v3/mods-3-3.xsd">' . "\n";
        $this->detail_suffix = '</modsCollection>';

        $_xml_output = '<mods version="3.3" ID="' . $this->detail_id . '">' . "\n";

        // parse title
        $this->record_detail['title'] = preg_replace('/\//i', '&#47;', $this->record_detail['title']);
        $_title_sub = '';
        $_title_statement_resp = '';

        if (stripos($this->record_detail['title'], ':') !== false) {
            $_title_main = trim(substr($this->record_detail['title'], 0, stripos($this->record_detail['title'], ':')));
            $_title_sub = trim(substr($this->record_detail['title'], stripos($this->record_detail['title'], ':') + 1));
        } elseif (stripos($this->record_detail['title'], '/') !== false) {
            $_title_statement_resp = trim(substr($this->record_detail['title'], stripos($this->record_detail['title'], '/') + 1));
            $_title_main = trim(substr($this->record_detail['title'], 0, stripos($this->record_detail['title'], '/')));
        } else {
            $_title_main = trim($this->record_detail['title']);
        }

        $_xml_output .= '<titleInfo>' . "\n" . '<title><![CDATA[' . $_title_main . ']]></title>' . "\n";
        if ($_title_sub) {
            $_xml_output .= '<subTitle><![CDATA[' . $_title_sub . ']]></subTitle>' . "\n";
        }
        $_xml_output .= '</titleInfo>' . "\n";
        // Usage
        $_xml_output .= $this->generateXML($_xml_output, $sysconf, $this->record_detail);
        // echo $xml;

        return $_xml_output;
    }

    private function generateAuthors($sysconf)
    {
        $builder = $this->db->table('mst_author a');
        $builder->select('a.*, ba.level')
            ->join('biblio_author ba', 'a.author_id = ba.author_id', 'left')
            ->where('ba.biblio_id', $this->detail_id);

        $query = $builder->get();
        $_xml_output = '';

        foreach ($query->getResultArray() as $_auth_d) {
            $_xml_output .= '<name type="' . $sysconf->authority_type[$_auth_d['authority_type']] . '" authority="' . $_auth_d['auth_list'] . '">' . "\n"
                . '<namePart>' . $_auth_d['author_name'] . '</namePart>' . "\n"
                . '<role><roleTerm type="text">' . $sysconf->authority_level[$_auth_d['level']] . '</roleTerm></role>' . "\n"
                . '</name>' . "\n";
        }

        return $_xml_output;
    }

    private function generateSupervisors($sysconf)
    {
        $builder = $this->db->table('mst_supervisor a');
        $builder->select('a.*, ba.level')
            ->join('biblio_supervisor ba', 'a.supervisor_id = ba.supervisor_id', 'left')
            ->where('ba.biblio_id', $this->detail_id);

        $query = $builder->get();
        $_xml_output = '';

        foreach ($query->getResultArray() as $_auth_d) {
            $_xml_output .= '<name type="' . $sysconf->supervisor_type[$_auth_d['supervisor_type']] . '" authority="' . $_auth_d['supervisor_list'] . '">' . "\n"
                . '<namePart>' . $_auth_d['supervisor_name'] . '</namePart>' . "\n"
                . '<role><roleTerm type="text">' . $sysconf->authority_level_supervisor[$_auth_d['level']] . '</roleTerm></role>' . "\n"
                . '</name>' . "\n";
        }

        return $_xml_output;
    }

    private function generateExaminers($sysconf)
    {
        $builder = $this->db->table('mst_examiner a');
        $builder->select('a.*, ba.level')
            ->join('biblio_examiner ba', 'a.examiner_id = ba.examiner_id', 'left')
            ->where('ba.biblio_id', $this->detail_id);

        $query = $builder->get();
        $_xml_output = '';

        foreach ($query->getResultArray() as $_auth_d) {
            $_xml_output .= '<name type="' . $sysconf->examiner_type[$_auth_d['examiner_type']] . '">' . "\n"
                . '<namePart>' . $_auth_d['examiner_name'] . '</namePart>' . "\n"
                . '<role><roleTerm type="text">' . $sysconf->authority_level_examiner[$_auth_d['level']] . '</roleTerm></role>' . "\n"
                . '</name>' . "\n";
        }

        return $_xml_output;
    }

    private function generateContributors($sysconf)
    {
        $builder = $this->db->table('mst_contributor c');
        $builder->select('c.*, bc.level')
            ->join('biblio_contributor bc', 'c.contributor_id = bc.contributor_id', 'left')
            ->where('bc.biblio_id', $this->detail_id);

        $query = $builder->get();
        $_xml_output = '';

        foreach ($query->getResultArray() as $_auth_d) {
            $_xml_output .= '<name type="' . $sysconf->contributor_type[$_auth_d['contributor_type']] . '">' . "\n"
                . '<namePart>' . $_auth_d['contributor_name'] . '</namePart>' . "\n"
                . '<role><roleTerm type="text">' . $sysconf->authority_level_contributor[$_auth_d['level']] . '</roleTerm></role>' . "\n"
                . '</name>' . "\n";
        }

        return $_xml_output;
    }

    // Function to generate XML from contributors
    function generateContributorsXML($sysconf)
    {
        $query = 'SELECT c.*, bc.level FROM mst_contributor AS c'
            . ' LEFT JOIN biblio_contributor AS bc ON c.contributor_id=bc.contributor_id WHERE bc.biblio_id=' . $this->detail_id;

        $result = $this->db->query($query);
        return array_reduce($result->getResultArray(), function ($xml_output, $contributor) use ($sysconf) {
            $contributor_type = $sysconf->contributor_type[$contributor['contributor_type']] ?? '';
            $contributor_level = $sysconf->authority_level_contributor[$contributor['level']] ?? '';
            return $xml_output .
                '<name type="' . $contributor_type . '">' . "\n" .
                '<namePart>' . $contributor['contributor_name'] . '</namePart>' . "\n" .
                '<role><roleTerm type="text">' . $contributor_level . '</roleTerm></role>' . "\n" .
                '</name>' . "\n";
        }, '');
    }

    // Function to generate originInfo XML
    function generateOriginInfoXML($record_detail)
    {
        $origin_info = '<originInfo>' . "\n" .
            '<place><placeTerm type="text"><![CDATA[' . $record_detail['publish_place'] . ']]></placeTerm></place>' . "\n" .
            '<publisher><![CDATA[' . $record_detail['publisher_name'] . ']]></publisher>' . "\n" .
            '<dateIssued><![CDATA[' . $record_detail['publish_year'] . ']]></dateIssued>' . "\n";

        if ((int) $record_detail['frequency_id'] > 0) {
            $origin_info .= '<issuance><![CDATA[continuing]]></issuance>' . "\n" .
                '<frequency><![CDATA[' . $record_detail['frequency'] . ']]></frequency>' . "\n";
        } else {
            $origin_info .= '<issuance><![CDATA[monographic]]></issuance>' . "\n";
        }

        $origin_info .= '<edition><![CDATA[' . $record_detail['edition'] . ']]></edition>' . "\n";
        $origin_info .= '</originInfo>' . "\n";

        return $origin_info;
    }

    // Function to generate subjects XML
    function generateSubjectsXML($sysconf)
    {
        $query = 'SELECT t.topic, t.topic_type, t.auth_list, bt.level FROM mst_topic AS t'
            . ' LEFT JOIN biblio_topic AS bt ON t.topic_id=bt.topic_id WHERE bt.biblio_id=' . $this->detail_id . ' ORDER BY t.auth_list';

        $result = $this->db->query($query);
        return array_reduce($result->getResultArray(), function ($xml_output, $topic) use ($sysconf) {
            $subject_type = strtolower($sysconf['subject_type'][$topic['topic_type']] ?? '');
            return $xml_output .
                '<subject authority="' . $topic['auth_list'] . '">' . "\n" .
                '<' . $subject_type . '><![CDATA[' . $topic['topic'] . ']]></' . $subject_type . '>' . "\n" .
                '</subject>' . "\n";
        }, '');
    }

    // Main function to generate the full XML
    function generateXML($xml_output, $sysconf, $record_detail)
    {
        // Authors
        $xml_output .= $this->generateAuthors($sysconf);

        // Supervisors
        $xml_output .= $this->generateSupervisors($sysconf);

        // Examiners
        $xml_output .= $this->generateExaminers($sysconf);

        // Contributors
        $xml_output .= $this->generateContributors($sysconf);

        // Contributors
        $xml_output .= $this->generateContributorsXML($sysconf);

        // Resource type
        $xml_output .= '<typeOfResource manuscript="yes" collection="yes"><![CDATA[mixed material]]></typeOfResource>' . "\n";

        // GMD
        $xml_output .= '<genre authority="marcgt"><![CDATA[bibliography]]></genre>' . "\n";

        // Origin info
        $xml_output .= $this->generateOriginInfoXML($record_detail);

        // Language
        $xml_output .= '<language>' . "\n" .
            '<languageTerm type="code"><![CDATA[' . $record_detail['language_id'] . ']]></languageTerm>' . "\n" .
            '<languageTerm type="text"><![CDATA[' . $record_detail['language_name'] . ']]></languageTerm>' . "\n" .
            '</language>' . "\n";

        // Item type
        $xml_output .= '<itemType>' . "\n" .
            '<itemTypeTerm type="code"><![CDATA[' . $record_detail['item_type_code'] . ']]></itemTypeTerm>' . "\n" .
            '<itemTypeTerm type="text"><![CDATA[' . $record_detail['item_type_name'] . ']]></itemTypeTerm>' . "\n" .
            '</itemType>' . "\n";

        // Copyright
        $xml_output .= '<copyright>' . "\n" .
            '<copyrightTerm type="code"><![CDATA[' . $record_detail['copyright_id'] . ']]></copyrightTerm>' . "\n" .
            '<copyrightTerm type="text"><![CDATA[' . $record_detail['copyright_name'] . ']]></copyrightTerm>' . "\n" .
            '</copyright>' . "\n";

        // Physical description
        $xml_output .= '<physicalDescription>' . "\n" .
            '<form authority="gmd"><![CDATA[' . $record_detail['gmd_name'] . ']]></form>' . "\n" .
            '<extent><![CDATA[' . $record_detail['collation'] . ']]></extent>' . "\n" .
            '</physicalDescription>' . "\n";

        // Series title
        if ($record_detail['series_title']) {
            $xml_output .= '<relatedItem type="series">' . "\n" .
                '<titleInfo>' . "\n" .
                '<title><![CDATA[' . $record_detail['series_title'] . ']]></title>' . "\n" .
                '</titleInfo>' . "\n" .
                '</relatedItem>' . "\n";
        }

        // Notes
        $xml_output .= '<note>' . $record_detail['notes'] . '</note>' . "\n";

        // Subjects
        $xml_output .= $this->generateSubjectsXML($sysconf);

        // Final closing tags and return XML
        $xml_output .= '</mods>';
        return $xml_output;
    }
}
