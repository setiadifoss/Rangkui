<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\ExaminerModel;

class ExaminerController extends BaseController
{
    public function index()
    {
        $loadModel = new ExaminerModel();
        $js        = ["assets/custom/js/modules/master/examiner"];
        $view      = "examiner/v_index";
        $title     = "Examiner";

        $content['data'] = $loadModel->orderBy('examiner_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new ExaminerModel();

        $now = date('Y-m-d');

        $data['examiner_name']   = $this->input->getPost('examinerName');
        $data['examiner_number'] = $this->input->getPost('examinerNumber');
        $data['examiner_type']   = $this->input->getPost('examinerType');
        $data['last_update']     = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('examinerId'))) {
            $loadModel->update($this->input->getPost('examinerId'), $data);
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
        return redirect()->to('master/examiner');
    }
    public function delete()
    {
        $loadModel = new ExaminerModel();

        $this->db->transBegin();
        $loadModel->where('examiner_id', $this->input->getPost('id'))->delete();
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
