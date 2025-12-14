<?php

namespace App\Modules\Master\Controllers;

use App\Controllers\BaseController;
use App\Modules\Master\Models\CodeMinistryModel;

class CodeMinistryController extends BaseController
{
    public function index()
    {
        $loadModel = new CodeMinistryModel();
        $js        = ["assets/custom/js/modules/master/codeministry"];
        $view      = "codeministry/v_index";
        $title     = "Ministry Code";

        $content['data'] = $loadModel->orderBy('code_ministry', 'DESC')->get()->getResult();

        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new CodeMinistryModel();

        $now = date('Y-m-d');

        $data['name_prodi']  = $this->input->getPost('name_prodi');
        $data['degree']      = $this->input->getPost('degree');
        $data['university']  = $this->input->getPost('university');
        $data['last_update'] = $now;

        $this->db->transBegin();
        if (!is_null($this->input->getPost('codeMinistryId'))) {
            $loadModel->update($this->input->getPost('codeMinistryId'), $data);
        } else {
            $data['code_ministry'] = $this->input->getPost('code_ministry');
            $data['input_date']    = $now;
            $loadModel->insert($data);
        }
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Data failed to save');
        } else {
            $this->db->transCommit();
            slim_alert('success', 'Data successfully saved');
        }
        return redirect()->to('master/codeministry');
    }
    public function delete()
    {
        $loadModel = new CodeMinistryModel();

        $this->db->transBegin();
        $loadModel->where('code_ministry', $this->input->getPost('id'))->delete();
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
