<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\SupervisorModel;

class SupervisorController extends BaseController
{
    public function index()
    {
        $loadModel = new SupervisorModel();
        $js        = ["assets/custom/js/modules/master/supervisor"];
        $view      = "supervisor/v_index";
        $title     = "Supervisors";

        $content['data'] = $loadModel->orderBy('supervisor_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new SupervisorModel();

        $now = date('Y-m-d');

        $data['supervisor_name']   = $this->input->getPost('superName');
        $data['supervisor_number'] = $this->input->getPost('supervisorNumber');
        $data['supervisor_year']   = $this->input->getPost('supervisorYear');
        $data['supervisor_type']   = $this->input->getPost('supervisorType');
        $data['supervisor_list']   = $this->input->getPost('supervisorList');
        $data['last_update']       = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('supervisorId'))) {
            $loadModel->update($this->input->getPost('supervisorId'), $data);
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
        return redirect()->to('master/supervisor');
    }
    public function delete()
    {
        $loadModel = new SupervisorModel();

        $this->db->transBegin();
        $loadModel->where('supervisor_id', $this->input->getPost('id'))->delete();
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
