<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\LocationModel;

class LocationController extends BaseController
{
    public function index()
    {
        $loadModel = new LocationModel();
        $js        = ["assets/custom/js/modules/master/location"];
        $view      = "location/v_index";
        $title     = "Locations";

        $content['data'] = $loadModel->orderBy('location_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new LocationModel();

        $now = date('Y-m-d');

        $data['location_name'] = $this->input->getPost('location_name');
        $data['last_update']    = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('LocationId'))) {
            $loadModel->update($this->input->getPost('LocationId'), $data);
        } else {
            $data['location_id'] = $this->input->getPost('location_id');
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
        return redirect()->to('master/location');
    }
    public function delete()
    {
        $loadModel = new LocationModel();

        $this->db->transBegin();
        $loadModel->where('location_id', $this->input->getPost('id'))->delete();
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
