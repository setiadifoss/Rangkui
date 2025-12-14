<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\PengarangModel;

class PengarangController extends BaseController
{
    public function index()
    {
        $loadModel = new PengarangModel();
        $js        = ["assets/custom/js/modules/master/pengarang"];
        $view      = "pengarang/v_index";
        $title     = "Authors";

        $content['data'] = $loadModel->orderBy('author_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new PengarangModel();

        $now = date('Y-m-d');

        $data['author_name']    = $this->input->getPost('authorName');
        $data['author_year']    = $this->input->getPost('authorYear');
        $data['authority_type'] = $this->input->getPost('authorityType');
        $data['auth_list']      = $this->input->getPost('authList');
        $data['last_update']    = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('pengarangId'))) {
            $loadModel->update($this->input->getPost('pengarangId'), $data);
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
        return redirect()->to('master/pengarang');
    }
    public function delete()
    {
        $loadModel = new PengarangModel();

        $this->db->transBegin();
        $loadModel->where('author_id', $this->input->getPost('id'))->delete();
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
