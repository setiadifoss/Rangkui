<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\CollectionModel;

class CollectionController extends BaseController
{
    public function index()
    {
        $loadModel = new CollectionModel();
        $js        = ["assets/custom/js/modules/master/collection"];
        $view      = "collection/v_index";
        $title     = "Collection Type";

        $content['data'] = $loadModel->orderBy('coll_type_id', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new CollectionModel();

        $now = date('Y-m-d');

        $data['coll_type_name'] = $this->input->getPost('coll_type_name');
        $data['last_update']    = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('coll_type_id'))) {
            $loadModel->update($this->input->getPost('coll_type_id'), $data);
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
        return redirect()->to('master/collection');
    }
    public function delete()
    {
        $loadModel = new CollectionModel();

        $this->db->transBegin();
        $loadModel->where('coll_type_id', $this->input->getPost('id'))->delete();
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
