<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\SubjectModel;

class SubjectController extends BaseController
{
    public function index()
    {
        $loadModel = new SubjectModel();
        $js        = ["assets/custom/js/modules/master/subject"];
        $view      = "subject/v_index";
        $title     = "Subject";

        $content['data'] = $loadModel->orderBy('topic_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new SubjectModel();

        $now = date('Y-m-d');

        $data['topic']          = $this->input->getPost('topic');
        $data['classification'] = $this->input->getPost('classification');
        $data['topic_type']     = $this->input->getPost('topic_type');
        $data['auth_list']      = $this->input->getPost('auth_list');
        $data['last_update']    = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('topic_id'))) {
            $loadModel->update($this->input->getPost('topic_id'), $data);
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
        return redirect()->to('master/subject');
    }
    public function delete()
    {
        $loadModel = new SubjectModel();

        $this->db->transBegin();
        $loadModel->where('topic_id', $this->input->getPost('id'))->delete();
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
