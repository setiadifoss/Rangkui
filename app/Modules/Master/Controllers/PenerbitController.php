<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\PenerbitModel;

class PenerbitController extends BaseController
{
    public function index()
    {
        $loadModel = new PenerbitModel();
        $js        = ["assets/custom/js/modules/master/penerbit"];
        $view      = "penerbit/v_index";
        $title     = "Publisher";

        $content['data'] = $loadModel->orderBy('publisher_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new PenerbitModel();

        $now = date('Y-m-d');

        $data['publisher_name'] = $this->input->getPost('publisherName');
        $data['last_update']    = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('penerbitId'))) {
            $loadModel->update($this->input->getPost('penerbitId'), $data);
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
        return redirect()->to('master/penerbit');
    }
    public function delete()
    {
        $loadModel = new PenerbitModel();

        $this->db->transBegin();
        $loadModel->where('publisher_id', $this->input->getPost('id'))->delete();
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
