<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Reporting\Models\ReportingModel;
use CodeIgniter\API\ResponseTrait;

class ReportStafActController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function staff_act()
    {
        $view = $this->viewPath . "staff_act/v_index";
        $title = "Reporting";

        $start_date = '2000-01-01';
        $end_date = date("Y-m-d");

        $report = new ReportingModel();

        $list_report = $report->getStafActReport($start_date, $end_date);
        $content = [
            'list_report' => $list_report,
        ];

        $js = [
            'assets/custom/js/modules/reporting/report-staff-act'
        ];

        _render($view, $title, $content, $js);
    }

    function filter()
    {

        extract($this->input->getPost());

        $report = new ReportingModel();

        $act_from = date("Y-m-d", strtotime($act_from));
        $act_to = date("Y-m-d", strtotime($act_to));

        $staff_report = $report->getStafActReport($act_from, $act_to);

        $data = [];

        if ($staff_report->getNumRows() > 0) {

            foreach ($staff_report->getResult() as $key => $val) {
                array_push($data, [
                    'realname' => $val->realname,
                    'username' => $val->username,
                    'biblio_total' => $val->biblio_total,
                    'item_total' => $val->item_total,
                    'member_total' => $val->member_total,
                    'circulation_total' => $val->circulation_total,
                ]);
            }
        }

        $resp = [
            'data' => $data
        ];

        return $this->respond($resp);
    }
}
