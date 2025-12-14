<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\PlaceModel;

class PlaceController extends BaseController
{
    public function index()
    {
        $loadModel = new PlaceModel();
        $js        = ["assets/custom/js/modules/master/place"];
        $view      = "place/v_index";
        $title     = "Places";

        $content['data'] = $loadModel->orderBy('place_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new PlaceModel();

        $now = date('Y-m-d');

        $data['place_name'] = $this->input->getPost('place_name');
        $data['last_update']  = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('place_id'))) {
            $loadModel->update($this->input->getPost('place_id'), $data);
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
        return redirect()->to('master/place');
    }
    public function delete()
    {
        $loadModel = new PlaceModel();

        $this->db->transBegin();
        $loadModel->where('place_id', $this->input->getPost('id'))->delete();
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
