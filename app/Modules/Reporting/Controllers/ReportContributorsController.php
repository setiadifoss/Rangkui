<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\CollectionModel;
use App\Modules\Master\Models\GmdModel;
use App\Modules\Master\Models\LanguageModel;
use App\Modules\Master\Models\LocationModel;
use App\Modules\Reporting\Models\ReportingModel;
use CodeIgniter\API\ResponseTrait;

class ReportContributorsController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function contributors()
    {
        $view = $this->viewPath . "contributors/v_index";
        $title = "Reporting";

        $report = new ReportingModel();

        $list_item = $this->db->table('mst_item_type')
            ->select('item_type_id, item_type_name')
            ->get()
            ->getResult();


        $contributor_report = $report->getContributorsReport()->getResult();

        $content = [
            'contributor_report' => $contributor_report,
            'list_item' => $list_item,
        ];

        $js = [
            'https://code.highcharts.com/highcharts.js',
            'https://code.highcharts.com/modules/exporting.js',
            'https://code.highcharts.com/modules/accessibility.js',
            'assets/custom/js/modules/reporting/report-contributors'
        ];

        _render($view, $title, $content, $js);
    }

    function filter()
    {
        $item = [];
        $contributor_type = [];
        extract($this->input->getPost());

        $report = new ReportingModel();

        $title_report = $report->getContributorsReport($title, $author, $classification, $contributor_type, $item, $subject, $contributor_name);

        $data = [];
        if ($title_report->getNumRows() > 0) {

            foreach ($title_report->getResult() as $key => $val) {
                array_push($data, [
                    'title' => $val->title,
                    'item_type' => $val->item_type_name,
                    'subject' => $val->subject ?? "",
                    'contributor' => $val->contributor_name,
                    'year' => $val->publish_year,
                ]);
            }
        }

        $resp = [
            'data' => $data
        ];

        return $this->respond($resp);
    }
}
