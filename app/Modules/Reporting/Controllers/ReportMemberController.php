<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Membership\Models\MembershipModel;
use CodeIgniter\API\ResponseTrait;

class ReportMemberController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function member()
    {
        $member = new MembershipModel();

        $total_member = $member->countAllResults();
        $active_member = $member->getActiveMembers();
        $expired_member = $member->getExpiredMembers();

        $view = $this->viewPath . "report_member/v_index";
        $title = "Reporting";

        $content = [
            'total_member' => $total_member,
            'active_member' => $active_member,
            'expired_member' => $expired_member,
        ];

        $js = [
            'https://code.highcharts.com/highcharts.js',
            'https://code.highcharts.com/modules/exporting.js',
            'https://code.highcharts.com/modules/accessibility.js',
            'assets/custom/js/modules/reporting/report-member'
        ];

        _render($view, $title, $content, $js);
    }

    function stats()
    {
        $member = new MembershipModel();

        $list_member = $member->getMemberByType();

        $data = [];
        foreach ($list_member as $key => $val) {
            $data[] = [
                'name' => $val->member_name,
                'y' => (float) $val->total,
            ];
        }

        $response = [
            'series' => $data,
        ];

        return $this->respond($response);
    }

    public function list()
    {
        $member = new MembershipModel();

        $list_member = $member->select('member.member_id, member.member_name,member.gender, member.member_type_id, member.expire_date, mmt.member_type_name')
            ->join('mst_member_type mmt', 'mmt.member_type_id = member.member_type_id')
            ->get()
            ->getResult();

        $view = $this->viewPath . "report_member/v_list_member";
        $title = "Reporting";

        $content = [
            'list_member' => $list_member,
        ];

        $js = [];

        _render($view, $title, $content, $js);
    }
}
