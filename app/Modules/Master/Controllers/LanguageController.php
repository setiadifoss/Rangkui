<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\LanguageModel;

class LanguageController extends BaseController
{
    public function index()
    {
        $loadModel = new LanguageModel();
        $js        = ["assets/custom/js/modules/master/language"];
        $view      = "language/v_index";
        $title     = "Document Language";

        $content['data'] = $loadModel->orderBy('language_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new LanguageModel();

        $now = date('Y-m-d');

        $data['language_name'] = $this->input->getPost('language_name');
        $data['last_update']    = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('languageId'))) {
            $loadModel->update($this->input->getPost('languageId'), $data);
        } else {
            $data['language_id'] = $this->input->getPost('language_id');
            $data['input_date']  = $now;
            $loadModel->insert($data);
        }
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Data failed to save');
        } else {
            $this->db->transCommit();
            slim_alert('success', 'Data successfully saved');
        }
        return redirect()->to('master/language');
    }
    public function delete()
    {
        $loadModel = new LanguageModel();

        $this->db->transBegin();
        $loadModel->where('language_id', $this->input->getPost('id'))->delete();
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
