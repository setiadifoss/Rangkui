<?php

namespace App\Modules\Profile\Controllers;

use Config\Services;
use App\Controllers\BaseController;
use App\Modules\Profile\Models\ProfileModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $loadModel = new ProfileModel();
        $js        = ["assets/custom/js/modules/profile/profile"];
        $view      = "profile/v_index";
        $title     = "Profile";

        $uid = $this->session->user_id;

        $data      = $loadModel->where('user_id', $uid)
            ->orderBy('user_id', 'DESC')
            ->get()
            ->getRow();

        $data->social_media = unserialize($data->social_media);
        $content['data'] = $data;
        _render($view, $title, $content, $js);
    }
    public function save()
    {
        $loadModel = new ProfileModel();
        $now       = date('Y-m-d');

        $data['realname']     = $this->db->escapeString($this->input->getPost('realname'));
        $data['email']        = $this->db->escapeString($this->input->getPost('email'));
        $data['user_type']    = $this->db->escapeString($this->input->getPost('user_type'));
        $data['social_media'] = serialize($this->input->getPost('social'));
        $data['last_update']  = $now;

        if (!empty($this->input->getPost('passwd1')) && !is_null($this->input->getPost('passwd1'))) {
            $data['passwd'] = password_hash($this->input->getPost('passwd1'), PASSWORD_BCRYPT);
        }
        $this->db->transBegin();
        $loadModel->update($this->input->getPost('user_id'), $data);
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $log_message = "Update profile {$this->input->getPost('username')} success";
            slim_alert('error', 'Data failed to save');
        } else {
            $this->db->transCommit();
            $log_message = "Update profile {$this->input->getPost('username')} success";
            slim_alert('success', 'Data successfully saved');
        }
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'User', $log_message);
        return redirect()->to('profile');
    }
}
