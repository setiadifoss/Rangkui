<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\GmdModel;

class GmdController extends BaseController
{
    public function index()
    {
        $loadModel = new GmdModel();
        $js        = ["assets/custom/js/modules/master/gmd"];
        $view      = "gmd/v_index";
        $title     = "Physical Document Format";

        $content['data'] = $loadModel->orderBy('gmd_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new GmdModel();

        $now = date('Y-m-d');

        $data['gmd_code']    = $this->input->getPost('gmdCode');
        $data['gmd_name']    = $this->input->getPost('gmdName');
        $data['last_update'] = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('gmdId'))) {
            $loadModel->update($this->input->getPost('gmdId'), $data);
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
        return redirect()->to('master/gmd');
    }
    public function delete()
    {
        $loadModel = new GmdModel();

        $this->db->transBegin();
        $loadModel->where('gmd_id', $this->input->getPost('id'))->delete();
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
