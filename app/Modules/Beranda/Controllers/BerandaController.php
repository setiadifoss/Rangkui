<?php

namespace App\Modules\Beranda\Controllers;

use SimpleXMLElement;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Modules\Beranda\Models\BerandaModel;

class BerandaController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $loadModel = new BerandaModel();
        $css       = ["https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css", "assets/custom/css/modules/beranda/beranda"];
        $js        = ["https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js", "assets/custom/js/modules/beranda/beranda"];
        $view      = "v_index";
        $title     = "DIFOSS";
        $data      = $loadModel->biblio(null, 10);
        $content['data'] = $data;
        _renderView($view, $title, $content, $js, $css);
    }
    public function detail($id)
    {
        $id = slim_decrypt($id);

        extract($this->input->getGet());

        if (isset($p) && $p == "show_detail") {
            return $this->_showDetail($id, $inXML);
        } else {
            $loadModel = new BerandaModel();
            $css       = ["assets/custom/css/modules/beranda/beranda"];
            $js        = ["assets/custom/js/modules/beranda/beranda"];
            $view      = "v_detail";
            $title     = "DIFOSS";
            $data      = $loadModel->biblio($id);

            if (!$data) {
                slim_alert('error', 'Bibliography not found');
                return redirect()->to(base_url());
            }
            $data->author      = $loadModel->biblio_author($id);
            $data->supervisor  = $loadModel->biblio_supervisor($id);
            $data->examiner    = $loadModel->biblio_examiner($id);
            $data->contributor = $loadModel->biblio_contributor($id);
            $data->topic       = $loadModel->biblio_topic($id);
            $data->attachment  = $loadModel->biblio_attachment($id);

            $content['data'] = $data;
            _renderView($view, $title, $content, $js, $css);
        }
    }

    function _showDetail($biblio_id, $inXML = false)
    {
        if ($inXML) {
            $model = new BerandaModel();
            $sysConf = config('SysConf');

            $xml = new SimpleXMLElement(
                '<modsCollection xmlns:xlink="http://www.w3.org/1999/xlink" 
                                 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                                 xmlns="http://www.loc.gov/mods/v3" 
                                 xmlns:slims="http://slims.web.id" 
                                 xsi:schemaLocation="http://www.loc.gov/mods/v3 http://www.loc.gov/standards/mods/v3/mods-3-3.xsd" />'
            );

            $modsNode = $xml->addChild('mods');
            $modsNode->addAttribute('version', '3.3');
            $modsNode->addAttribute('ID', $biblio_id);

            $data = $this->_getRecord($biblio_id);

            $data['title'] = str_replace('/', '&#47;', $data['title']);
            $_title_main = $data['title'];
            $_title_sub = '';
            $_title_statement_resp = '';

            if (strpos($data['title'], ':') !== false) {
                list($_title_main, $_title_sub) = array_map('trim', explode(':', $data['title'], 2));
            } elseif (strpos($data['title'], '/') !== false) {
                list($_title_main, $_title_statement_resp) = array_map('trim', explode('/', $data['title'], 2));
            }

            // title info
            $titleInfo = $modsNode->addChild('titleInfo');
            $t = $titleInfo->addChild('title');
            $this->addCData($t, $_title_main);

            if ($_title_sub !== "") {
                $t_sub = $titleInfo->addChild('subTitle');
                $this->addCData($t_sub, $_title_sub);
            }

            // authors
            $authors     = $model->biblio_author($biblio_id);
            if (!empty($authors) || !is_null($authors)) {
                foreach ($authors as $key => $author) {
                    $name = $modsNode->addChild('name');
                    $name->addAttribute('type', $sysConf->authority_type[$author->authority_type]);
                    $name->addAttribute('authority', $author->auth_list);
                    $name->addChild('namePart', $author->author_name);

                    // role
                    $role = $name->addChild('role');
                    $role->addAttribute('type', 'text');
                    $role->addChild('roleTerm', $sysConf->authority_level[$author->level]);
                }
            }

            // supervisors
            $supervisors  = $model->biblio_supervisor($biblio_id);
            if (!empty($supervisors) || !is_null($supervisors)) {
                foreach ($supervisors as $key => $spv) {
                    $name = $modsNode->addChild('name');
                    $name->addAttribute('type', $sysConf->supervisor_type[$spv->supervisor_type]);
                    $name->addAttribute('authority', $spv->supervisor_list);
                    $name->addChild('namePart', $spv->supervisor_name);

                    // role
                    $role = $name->addChild('role');
                    $role->addAttribute('type', 'text');
                    $role->addChild('roleTerm', $sysConf->authority_level_supervisor[$spv->level]);
                }
            }

            //examiners
            $examiners    = $model->biblio_examiner($biblio_id);
            if (!empty($examiners) || !is_null($examiners)) {
                foreach ($examiners as $key => $ex) {
                    $name = $modsNode->addChild('name');
                    $name->addAttribute('type', $sysConf->examiner_type[$ex->examiner_type]);
                    $name->addChild('namePart', $ex->examiner_name);

                    // role
                    $role = $name->addChild('role');
                    $role->addAttribute('type', 'text');
                    $role->addChild('roleTerm', $sysConf->authority_level_examiner[$ex->level]);
                }
            }

            // contributors
            $contributors = $model->biblio_contributor($biblio_id);
            if (!empty($contributors) || !is_null($contributors)) {
                foreach ($contributors as $key => $contributor) {
                    $name = $modsNode->addChild('name');
                    $name->addAttribute('type', $sysConf->contributor_type[$contributor->contributor_type]);
                    $name->addChild('namePart', $contributor->contributor_name);

                    // role
                    $role = $name->addChild('role');
                    $role->addAttribute('type', 'text');
                    $role->addChild('roleTerm', $sysConf->authority_level_contributor[$contributor->level]);
                }
            }

            // $modsNode->addChild('< manuscript="yes" collection="yes" />', 'mixed material');
            $typeResource = $modsNode->addChild('typeOfResource', "mixed material");
            $typeResource->addAttribute("manuscript", "yes");
            $typeResource->addAttribute("collection", "yes");

            $marcgt = $modsNode->addChild("genre", "bibliography");
            $marcgt->addAttribute("authority", "marcgt");

            // imprint/publication data
            $originInfo = $modsNode->addChild('originInfo');

            $place = $originInfo->addChild('place');
            $place->addChild('placeTerm', $data['publish_place']);

            $originInfo->addChild('publisher', $data['publisher_name']);
            $originInfo->addChild('dateIssued', $data['publish_year']);

            $freq = (int) $data['frequency'];
            if ($freq > 0) {
                $originInfo->addChild('dateIssued', $data['frequency']);
            } else {
                $originInfo->addChild('dateIssued', 'monographic');
            }

            $originInfo->addChild('edition', $data['edition']);

            // language
            $lang = $modsNode->addChild('language');
            $lang->addChild('languageTerm', $data['language_id']);
            $lang->addChild('languageTerm', $data['language_name']);

            // item type
            $item = $modsNode->addChild('itemType');

            $code = $item->addChild('itemTypeTerm', $data['item_type_code']);
            $code->addAttribute('type', 'code');

            $text = $item->addChild('itemTypeTerm', $data['item_type_name']);
            $text->addAttribute('type', 'text');

            //copyright
            $copy = $modsNode->addChild('copyright');
            $code = $copy->addChild('copyrightTerm ', $data['copyright_id']);
            $code->addAttribute('type', 'code');

            $text = $copy->addChild('copyrightTerm ', $data['copyright_name']);
            $text->addAttribute('type', 'text');

            // Physical Description/Collation
            $physical = $modsNode->addChild('physicalDescription');
            $form = $physical->addChild('form', $data['gmd_name']);
            $form->addAttribute('authority', 'gmd');

            $exten = $physical->addChild('extent', $data['collation']);

            if (!is_null($data['series_title']) && $data['series_title'] !== "") {

                $relatedItem = $modsNode->addChild('relatedItem');
                $relatedItem->addAttribute('type', 'series');

                $titleInfo = $relatedItem->addChild('titleInfo');
                $titleInfo->addChild('title', $data['series_title']);
            }

            // note
            $note = $modsNode->addChild('note', $data['notes']);
            if ($_title_statement_resp != "") {
                $nc = $note->addChild('note');
                $this->addCData($nc, $_title_statement_resp);

                $nc->addAttribute('type', 'statement of responsibility');
            }

            $topics = $model->biblio_topic($biblio_id);

            if (!empty($topics) || !is_null($topics)) {
                foreach ($topics as $key => $topic) {
                    $subject_type = strtolower($sysConf->subject_type[$topic->topic_type]);
                    $sub = $modsNode->addChild('subject');

                    $sub->addAttribute('authority', $topic->auth_list);
                    $sub->addChild($subject_type, $topic->topic);
                }
            }

            // classification
            $modsNode->addChild('classification', $data['classification']);
            $modsNode->addChild('ministry', $data['code_ministry']);
            $modsNode->addChild('studentID', $data['student_id']);

            $identifier = $modsNode->addChild('identifier', str_replace(array('-', ' '), '', $data['isbn_issn']));
            $identifier->addAttribute('type', 'isbn');

            $modsNode->addChild('departementID', $data['departement']);
            $modsNode->addChild('urlCrossref', $data['url_crossref']);


            $loc = $modsNode->addChild('location');
            $loc->addChild('physicalLocation', $sysConf->library['name'] . ' ' . $sysConf->library['subname']);
            $loc->addChild('shelfLocator', $data['call_number']);



            $location = $model->biblio_location($biblio_id);

            if (!empty($location) || !is_null($location)) {
                $list = $location;

                $hold = $loc->addChild('holdingSimple');
                foreach ($list as $key => $val) {
                    $cpi = $hold->addChild('copyInformation');

                    $num = $cpi->addChild('numerationAndChronology', $val['item_code']);
                    $num->addAttribute('type', '1');

                    $cpi->addChild('sublocation', $val['location_name'] . ($val['site'] ? ' (' . $val['site'] . ')' : ''));
                    $cpi->addChild('shelfLocator', $val['call_number']);
                }
            }



            $attachment = $model->biblio_attachment($biblio_id);
            if (!empty($attachment) || !is_null($attachment)) {
                $slims = $modsNode->addChild('slims:digitals');

                foreach ($attachment as $key => $val) {
                    if ($val->access_limit) {
                        continue;
                    }

                    $sdi = $slims->addChild('slims:digital_item');
                    $sdi->addAttribute('id', $val->file_id);
                    $sdi->addAttribute('url', trim($val->file_url));
                    $sdi->addAttribute('path', htmlentities($val->file_dir . '/' . $val->file_name));
                    $sdi->addAttribute('mimetype', $val->mime_type);
                }
            }


            if (!empty($data['image'])) {
                $image = urlencode($data['image']);

                $sim = $modsNode->addChild('slims:image');
                $this->addCData($sim, $image);
            }

            // Create a new XML element for 'recordInfo'
            $recordInfo = $modsNode->addChild('recordInfo');

            $recordInfo->addChild('recordIdentifier');
            $this->addCData($recordInfo, $biblio_id);

            $recordCreationDate = $recordInfo->addChild('recordCreationDate');
            $recordCreationDate->addAttribute('encoding', 'w3cdtf');
            $this->addCData($recordCreationDate, $data['input_date']);

            $recordChangeDate = $recordInfo->addChild('recordChangeDate');
            $recordChangeDate->addAttribute('encoding', 'w3cdtf');
            $this->addCData($recordChangeDate, $data['last_update']);

            $recordInfo->addChild('recordOrigin', 'machine generated');



            return $this->respondXML($xml);
        }
    }

    // Function to send XML response
    private function respondXML(SimpleXMLElement $xml)
    {
        return $this->response
            ->setHeader('Content-Type', 'application/xml')
            ->setBody($xml->asXML());
    }

    function addCData(SimpleXMLElement $node, $cdata_text)
    {
        // Import the SimpleXMLElement into DOM
        $dom = dom_import_simplexml($node);
        // Get the owner document (DOMDocument) of the node
        $owner = $dom->ownerDocument;
        // Create a CDATA section with the provided text
        $dom->appendChild($owner->createCDATASection($cdata_text));
    }


    function _getRecord($biblio_id)
    {
        $sql = "SELECT
                    b.*,
                    l.language_name,
                    p.publisher_name,
                    mc.copyright_id,
                    mc.copyright_name,
                    mit.item_type_name ,
                    mit.item_type_code,
                    pl.place_name AS publish_place,
                    gmd.gmd_name,
                    fr.frequency
                FROM
                    biblio AS b
                LEFT JOIN mst_gmd AS gmd ON
                    b.gmd_id = gmd.gmd_id
                LEFT JOIN mst_language AS l ON
                    b.language_id = l.language_id
                LEFT JOIN mst_publisher AS p ON
                    b.publisher_id = p.publisher_id
                LEFT JOIN mst_place AS pl ON
                    b.publish_place_id = pl.place_id
                LEFT JOIN mst_frequency AS fr ON
                    b.frequency_id = fr.frequency_id
                LEFT JOIN mst_copyright AS mc ON
                    b.copyright_id = mc.copyright_id
                LEFT JOIN mst_item_type AS mit ON
                    b.item_type_id = mit.item_type_id
                WHERE
                    biblio_id = :biblio_id:";

        $record_detail = $this->db->query($sql, ['biblio_id' => $biblio_id])->getRowArray();

        return $record_detail;
    }
    public function search()
    {
        $loadModel = new BerandaModel();
        $css       = ["assets/custom/css/modules/beranda/beranda"];
        $js        = [];
        $view      = "v_search";
        $title     = "DIFOSS";
        if (!is_null($this->input->getGet('s'))) {
            $data = $loadModel->search_biblio($this->input->getGet('s'));
        } else {
            $data = $loadModel->search_biblio_specific(array_key_first($this->input->getGet()), $this->input->getGet(array_key_first($this->input->getGet())));
        }

        $content['data'] = $data;
        _renderView($view, $title, $content, $js, $css);
    }
    public function counting()
    {
        $dec = explode('|', base64_decode($this->input->getPost('file')));

        $data = [
            'biblio_id' => $dec[0],
            'file_id'   => $dec[1],
        ];

        $this->db->table('biblio_count')->insert($data);

        echo json_encode($dec[2]);
    }
}
