<?php

namespace App\Modules\Membership\Controllers;

use App\Modules\Membership\Models\MembershipModel;
use App\Controllers\BaseController;


class TipeKeanggotaanController extends BaseController
{

    public $viewPath = "TipeKeanggotaan/";
    private $datetime;
    public $options = [];
    public function __construct()
    {
        $this->datetime = date('YmdHis');
        $this->options = [
            'cost' => 12,
        ];
    }

    public function index()
    {
        $db       = \Config\Database::connect();
        $view     =  $this->viewPath . "v_index";
        $title    = "Keanggotaan";
        $builder  = $db->table('mst_member_type as m');
        $builder->select('m.*');
        $content['data'] = $builder->get()->getResult();
        $js              = [
            'assets/custom/js/modules/membership/membership',
        ];
        _render($view, $title, $content, $js);
    }


    public function add()
    {
        $membership = new MembershipModel();
        $view = $this->viewPath . "v_add";
        $title = 'Tipe Keanggotaan';
        $content = [];
        $js = [
            'assets/custom/js/modules/membership/membership',
        ];

        _render($view, $title, $content, $js);
    }
    public function edit()
    {
        $membership = new MembershipModel();
        $db         = \Config\Database::connect();
        $view       = $this->viewPath . "v_edit";
        $title      = 'Tipe Keanggotaan';
        $builder    = $db->table('mst_member_type as m');
        $builder->select('m.*');
        $builder->where('m.member_type_id =', $this->input->getGet('mt'));
        $content['data']     = $builder->get()->getRow();
        $js               = [
            'assets/custom/js/modules/membership/membership',
        ];

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        extract($this->input->getPost());

        $rules = [
            'member_type_name' => 'required',
            'loan_limit'       => 'required',
            'loan_periode'     => 'required',
            'enable_reserve'   => 'required',
            'member_periode'   => 'required',
            'reserve_limit'    => 'required',
            'reborrow_limit'   => 'required',
            'fine_each_day'    => 'required',
            'grace_periode'    => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }
        $data = [
            'member_type_name' => $member_type_name,
            'loan_limit'       => $loan_limit,
            'loan_periode'     => $loan_periode,
            'enable_reserve'   => $enable_reserve,
            'member_periode'   => $member_periode,
            'reserve_limit'    => isset($reserve_limit) ?? 0,
            'reborrow_limit'   => $reborrow_limit,
            'fine_each_day'    => $fine_each_day,
            'grace_periode'    => $grace_periode,
        ];

        $memberType = new MembershipModel();
        $memberType->insertMemberType($data);

        if ($memberType) {
            slim_alert('success', "Berhasil Menambah Membership");
        } else {
            slim_alert('error', "Gagal Menambah Membership");
        }

        return redirect()->to('membership/membertype');
    }

    public function update()
    {
        extract($this->input->getPost());
        $member_type_id = $this->input->getPost('member_type_id');

        $rules = [
            'member_type_name' => 'required',
            'loan_limit'       => 'required',
            'loan_periode'     => 'required',
            'enable_reserve'   => 'required',
            'member_periode'   => 'required',
            'reserve_limit'    => 'required',
            'reborrow_limit'   => 'required',
            'fine_each_day'    => 'required',
            'grace_periode'    => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', \Config\Services::validation());
        }
        $db = \Config\Database::connect();


        $query = $db->table('mst_member_type')->where('member_type_id', $member_type_id)->get();

        if ($query->getNumRows() > 0) {
            $this->db->transBegin();
            $data = [
                'member_type_name' => $member_type_name,
                'loan_limit'       => $loan_limit,
                'loan_periode'     => $loan_periode,
                'enable_reserve'   => $enable_reserve,
                'member_periode'   => $member_periode,
                'reserve_limit'    => $reserve_limit,
                'reborrow_limit'   => $reborrow_limit,
                'fine_each_day'    => $fine_each_day,
                'grace_periode'    => $grace_periode,
            ];

            $db->table('mst_member_type')->where('member_type_id', $member_type_id)->update($data);

            if ($this->db->transStatus() === true) {
                $this->db->transCommit();
                slim_alert('Success', 'Berhasil Ubah Dokumen');
            } else {
                $this->db->transRollback();

                $error = $this->db->errors();
                log_message('error', reset($error));
                slim_alert('Error', 'Gagal Ubah Dokumen');
            }
        } else {
            slim_alert('Error', 'Member Type ID tidak ditemukan');
        }
        return redirect()->to('/membership/membertype');
    }
}
