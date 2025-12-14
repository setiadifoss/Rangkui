<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\LicenseModel;

class LicenseController extends BaseController
{
    public function index()
    {
        $loadModel = new LicenseModel();
        $js        = ["assets/custom/js/modules/master/license"];
        $view      = "license/v_index";
        $title     = "License";

        $content['data'] = $loadModel->orderBy('license_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new LicenseModel();

        $now = date('Y-m-d');

        $data['license_name'] = $this->input->getPost('license_name');
        $data['last_update']  = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('license_id'))) {
            $loadModel->update($this->input->getPost('license_id'), $data);
        } else {
            $data['input_date'] = $now;
            $loadModel->save($data);
        }
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Data failed to save');
        } else {
            $this->db->transCommit();
            slim_alert('success', 'Data successfully saved');
        }
        return redirect()->to('master/license');
    }
    public function delete()
    {
        $loadModel = new LicenseModel();

        $this->db->transBegin();
        $loadModel->where('license_id', $this->input->getPost('id'))->delete();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Data failed to delete');
        } else {
            $this->db->transCommit();
            slim_alert('success', 'Data successfully deleted');
        }
        echo json_encode('Done');
    }
}
