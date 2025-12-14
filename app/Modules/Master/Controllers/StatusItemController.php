<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\StatusItemModel;

class StatusItemController extends BaseController
{
    public function index()
    {
        $loadModel = new StatusItemModel();
        $js        = ["assets/custom/js/modules/master/statusitem"];
        $view      = "statusitem/v_index";
        $title     = "Item Status";

        $content['data'] = $loadModel->orderBy('item_status_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new StatusItemModel();

        $now = date('Y-m-d');

        $data['item_status_name'] = $this->input->getPost('item_status_name');
        $data['rules']            = serialize($this->input->getPost('rules'));
        $data['no_loan']          = in_array('1', $this->input->getPost('rules'));
        $data['skip_stock_take']  = in_array('2', $this->input->getPost('rules'));
        $data['last_update']      = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('itemStatusId'))) {
            $loadModel->update($this->input->getPost('itemStatusId'), $data);
        } else {
            $data['item_status_id'] = $this->input->getPost('item_status_id');
            $data['input_date']     = $now;
            $loadModel->insert($data);
        }
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Data failed to save');
        } else {
            $this->db->transCommit();
            slim_alert('success', 'Data successfully saved');
        }
        return redirect()->to('master/statusitem');
    }
    public function delete()
    {
        $loadModel = new StatusItemModel();

        $this->db->transBegin();
        $loadModel->where('item_status_id', $this->input->getPost('id'))->delete();
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
