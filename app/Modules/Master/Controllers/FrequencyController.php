<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\FrequencyModel;

class FrequencyController extends BaseController
{
    public function index()
    {
        $loadModel = new FrequencyModel();
        $js        = ["assets/custom/js/modules/master/frequency"];
        $view      = "frequency/v_index";
        $title     = "Frequency";

        $content['data'] = $loadModel->orderBy('frequency_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new FrequencyModel();

        $now = date('Y-m-d');

        $data['frequency']       = $this->input->getPost('frequency');
        $data['language_prefix'] = $this->input->getPost('language_prefix');
        $data['time_increment']  = $this->input->getPost('time_increment');
        $data['time_unit']       = $this->input->getPost('time_unit');
        $data['last_update']     = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('frequency_id'))) {
            $loadModel->update($this->input->getPost('frequency_id'), $data);
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
        return redirect()->to('master/frequency');
    }
    public function delete()
    {
        $loadModel = new FrequencyModel();

        $this->db->transBegin();
        $loadModel->where('frequency_id', $this->input->getPost('id'))->delete();
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
