<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Bibliography\Models\BibliographyModel;
use App\Modules\Master\Models\GmdModel;
use CodeIgniter\API\ResponseTrait;

class ReportRecapController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function recap()
    {
        $view = $this->viewPath . "recap/v_index";
        $title = "Reporting";

        $content = [];

        $js = [
            'https://code.highcharts.com/highcharts.js',
            'https://code.highcharts.com/modules/exporting.js',
            'https://code.highcharts.com/modules/accessibility.js',
            'assets/custom/js/modules/reporting/report-recap'
        ];

        _render($view, $title, $content, $js);
    }

    function filter()
    {
        if ($this->input->isAjax()) {
            extract($this->input->getPost());

            $response = [
                'status' => 'error',
                'message' => 'Not Found'
            ];

            switch ($filter) {
                case 'gmd':
                    return $this->_gmdRecap();
                    break;

                case 'lang':
                    return $this->_langRecap();
                    break;

                case 'coll_type':
                    return $this->_collTypeRecap();
                    break;

                default:
                    return $this->respond($response);
                    break;
            }
        }
    }

    function _gmdRecap()
    {
        $gmd = new GmdModel();

        $list_gmd = $gmd->distinct()
            ->select('gmd_id, gmd_name')
            ->get()
            ->getResult();

        $data = [];

        $biblio = new BibliographyModel();
        foreach ($list_gmd as $key => $val) {

            $classification_name = $val->gmd_name;
            $id = $val->gmd_id;
            // count by title
            $total_title = $biblio->where('gmd_id', $id)
                ->get()
                ->getNumRows();

            $total_item = $this->db->table('item i')
                ->join('biblio b', 'i.biblio_id = b.biblio_id')
                ->where('b.gmd_id', $id)
                ->get()
                ->getNumRows();


            $data[] = [
                $classification_name,
                $total_title,
                $total_item
            ];
        }

        $response = [
            'data' => $data
        ];

        return $this->respond($response);
    }
    function _langRecap()
    {
        $lang = $this->db->table('mst_language')
            ->distinct()
            ->select('language_id, language_name')
            ->get()
            ->getResult();

        $data = [];
        $biblio = new BibliographyModel();
        foreach ($lang as $val) {

            $lang_name = $val->language_name;
            $id = $val->language_id;
            // count by title
            $total_title = $biblio->where('language_id', $id)
                ->get()
                ->getNumRows();

            $total_item = $this->db->table('item i')
                ->join('biblio b', 'i.biblio_id = b.biblio_id')
                ->where('b.language_id', $id)
                ->get()
                ->getNumRows();


            $data[] = [
                $lang_name,
                $total_title,
                $total_item
            ];
        }

        $response = [
            'data' => $data
        ];

        return $this->respond($response);
    }

    function _collTypeRecap()
    {
        $coll = $this->db->table('mst_coll_type')
            ->distinct()
            ->select('coll_type_id, coll_type_name')
            ->get()
            ->getResult();

        $data = [];
        foreach ($coll as $val) {

            $lang_name = $val->coll_type_name;
            $id = $val->coll_type_id;
            // count by title
            $item = $this->db->table('item i');

            $total_title = $item->distinct()
                ->select('biblio_id')
                ->where('coll_type_id', $id)
                ->get()
                ->getNumRows();

            $total_item = $item->where('coll_type_id', $id)
                ->get()
                ->getRow();


            $data[] = [
                $lang_name,
                $total_title,
                $total_item
            ];
        }

        $response = [
            'data' => $data
        ];

        return $this->respond($response);
    }

    function stats()
    {
        $data = [];

        $response = [
            'series' => $data,
        ];

        return $this->respond($response);
    }
}
