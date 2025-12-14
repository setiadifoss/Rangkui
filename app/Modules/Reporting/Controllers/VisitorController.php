<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class VisitorController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function index()
    {
        $view  = $this->viewPath . "visitor/v_index";
        $title = "Reporting";
        $js    = ['assets/custom/js/modules/reporting/visitor'];

        _render($view, $title, [], $js);
    }
    public function filter()
    {
        if ($this->input->isAjax()) {
            $filter = $this->input->getPost('filter');
            $start  = $this->input->getPost('start');
            $end    = $this->input->getPost('end');
            $where  = '';
            if ((!empty($filter) && $filter != 'all') || !empty($start) || !empty($end)) {
                $arr_where =  [];
                if ((!empty($filter) && $filter != 'all')) {
                    if ($filter == 'member') {
                        $arr_where[] =  "m.member_id IS NOT NULL";
                    } elseif ($filter == 'nonmember') {
                        $arr_where[] =  "m.member_id IS NULL";
                    }
                }
                if (!empty($start) && empty($end)) {
                    $arr_where[] = "DATE(vc.checkin_date) >= '$start'";
                } elseif (empty($start) && !empty($end)) {
                    $arr_where[] = "DATE(vc.checkin_date) <= '$end'";
                } elseif (!empty($start) && !empty($end)) {
                    $arr_where[] = "(DATE(vc.checkin_date) BETWEEN '$start' AND '$end')";
                }
                $string_where = implode(" AND ", $arr_where);
                $where        = "WHERE $string_where";
            }
            $sql = "SELECT
                    COALESCE(m.member_id,'NON-MEMBER') member_id,
                    vc.member_name,
                    COALESCE((SELECT mmt.member_type_name FROM mst_member_type mmt WHERE mmt.member_type_id= m.member_type_id),'NON-MEMBER') tipe,
                    vc.institution,
                    vc.checkin_date
                FROM
                    visitor_count vc
                LEFT JOIN `member` m ON vc.member_id = m.member_id 
                $where ORDER BY vc.checkin_date DESC";

            $list = $this->db->query($sql)->getResult();
            $i    = 1;
            $data = [];
            foreach ($list as $key => $val) {

                $member_id    = $val->member_id;
                $member_name  = $val->member_name;
                $tipe         = $val->tipe;
                $institution  = $val->institution;
                $checkin_date = $val->checkin_date;


                $data[] = [
                    $i++,
                    $member_id,
                    $member_name,
                    $tipe,
                    $institution,
                    $checkin_date
                ];
            }
            $response = [
                'data' => $data,
                'sql'  => $sql,
            ];
            return $this->respond($response);
        }
    }
}
