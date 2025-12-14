<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\CollectionModel;
use App\Modules\Master\Models\GmdModel;
use App\Modules\Master\Models\LanguageModel;
use App\Modules\Master\Models\LocationModel;
use App\Modules\Reporting\Models\ReportingModel;
use CodeIgniter\API\ResponseTrait;

class ReportTitleController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function titles()
    {
        $view = $this->viewPath . "titles/v_index";
        $title = "Reporting";

        $gmd = new GmdModel();
        $list_gmd = $gmd->findAll();

        $lang = new LanguageModel();
        $list_lang = $lang->findAll();

        $coll = new CollectionModel();
        $list_coll = $coll->findAll();

        $loc = new LocationModel();
        $list_loc = $loc->findAll();

        $report = new ReportingModel();

        $title_report = $report->getTitleReport()->getResult();

        $content = [
            'list_gmd' => $list_gmd,
            'list_lang' => $list_lang,
            'list_coll' => $list_coll,
            'list_loc' => $list_loc,
            'title_report' => $title_report,
        ];

        $js = [
            'https://code.highcharts.com/highcharts.js',
            'https://code.highcharts.com/modules/exporting.js',
            'https://code.highcharts.com/modules/accessibility.js',
            'assets/custom/js/modules/reporting/report-titles'
        ];

        _render($view, $title, $content, $js);
    }

    function filter()
    {
        $gmd = [];
        $coll_type = [];
        extract($this->input->getPost());

        $report = new ReportingModel();

        $title_report = $report->getTitleReport($title, $author, $classification, $gmd, $coll_type, $lang, $loc);

        $data = [];

        if ($title_report->getNumRows() > 0) {

            foreach ($title_report->getResult() as $key => $val) {
                array_push($data, [
                    'title' => $val->title,
                    'place_name' => $val->place_name,
                    'publisher_name' => $val->publisher_name,
                    'isbn_issn' => $val->isbn_issn,
                    'call_number' => $val->call_number,
                ]);
            }
        }

        $resp = [
            'data' => $data
        ];

        return $this->respond($resp);
    }
}
