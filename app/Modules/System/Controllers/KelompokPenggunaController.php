<?php

namespace App\Modules\System\Controllers;

use Config\Services;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Modules\System\Models\PintasanModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Modules\System\Models\KelompokPenggunaModel;

class KelompokPenggunaController extends BaseController
{
    use ResponseTrait;

    public $viewPath = "KelompokPengguna/";
    public function index()
    {
        $view = $this->viewPath . "v_index";
        $title = "User Group";

        $kelompok = new KelompokPenggunaModel();

        $list_group = $kelompok->findAll();

        $content = [
            'list_group' => $list_group,
        ];

        $js = [
            'assets/custom/js/modules/system/user-groups'
        ];
        _render($view, $title, $content, $js);
    }

    function add()
    {
        $view = $this->viewPath . "v_add";
        $title = "Add New Group";

        $menu = new PintasanModel();
        $list_menu = $menu->getTopMenu();

        $content = [
            'list_menu' => $list_menu,
        ];

        $js = [];
        _render($view, $title, $content, $js);
    }

    function save()
    {
        extract($this->input->getPost());

        $list_user_group = [];
        $modules = array_unique(array_merge($write, $read));

        $now = date("Y-m-d H:i:s");
        $this->db->transBegin();

        $log_message = "{$this->session->name} add group user";
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'GroupUser', $log_message);

        $dataUser = [
            'group_name' => $username,
            'input_date' => $now,
            'last_update' => $now,
        ];

        $kelompok = new KelompokPenggunaModel();
        $kelompok->insert($dataUser);

        $group_id = $this->db->insertID();
        foreach ($modules as $module_id) {
            $list_user_group[] = [
                'group_id' => $group_id,
                'module_id' => $module_id,
                'r' => in_array($module_id, $read) ? 1 : 0,
                'w' => in_array($module_id, $write) ? 1 : 0
            ];
        }

        $ga = $this->db->table('group_access');
        $ga->insertBatch($list_user_group);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            slim_alert('error', 'Save new group failed');
        } else {
            $this->db->transCommit();
            slim_alert('success', 'Save new group success');
        }
        return redirect()->to('sistem/user-groups');
    }

    function edit($id)
    {
        $kelompok = new KelompokPenggunaModel();

        $list_kelompok = $kelompok->groupAccess($id);

        if ($list_kelompok->getNumRows() == 0) {
            throw PageNotFoundException::forPageNotFound();
        } else {

            $menu = new PintasanModel();
            $list_menu = $menu->getTopMenu();

            $view = $this->viewPath . "v_edit";
            $title = "Edit Group";
            $content = [

                'list_kelompok' => $list_kelompok->getResult(),
                'list_menu' => $list_menu,
            ];

            $js = [
                'assets/custom/js/modules/system/edit-konten',
            ];
            _render($view, $title, $content, $js);
        }
    }

    function update()
    {
        extract($this->input->getPost());

        $list_user_group = [];
        $modules = array_unique(array_merge($write, $read));
        $id = $w_id;

        $kelompok = new KelompokPenggunaModel();
        $list_kelompok = $kelompok->groupAccess($id);


        if ($list_kelompok->getNumRows() == 0) {
            throw PageNotFoundException::forPageNotFound();
        } else {
            $ga = $this->db->table('group_access');
            $ga->where('group_id', $id)
                ->delete();

            foreach ($modules as $module_id) {
                $list_user_group[] = [
                    'group_id' => $id,
                    'module_id' => $module_id,
                    'r' => in_array($module_id, $read) ? 1 : 0,
                    'w' => in_array($module_id, $write) ? 1 : 0
                ];
            }

            $this->db->transBegin();

            $log_message = "{$this->session->name} update group user";
            Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'GroupUser', $log_message);

            $ga->insertBatch($list_user_group);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                slim_alert('error', 'Update group failed');
            } else {
                $this->db->transCommit();
                slim_alert('success', 'Update group success');
            }
        }

        return redirect()->to("sistem/user-groups/edit/{$id}");
    }

    function delete()
    {
        $log_message = "Failed remove group";

        if ($this->input->isAJAX()) {
            $this->db->transBegin();

            $id  = $this->input->getPost('id');
            $kelompok = new KelompokPenggunaModel();

            $list_kelompok = $kelompok->find($id);
            if (!empty($list_kelompok)) {
                $kelompok->delete($id);

                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    $log_message = "Failed remove {$list_kelompok->group_name}";
                    slim_alert('error', $log_message);

                    $resp = [
                        'status' => 500,
                        'message' => 'Error'
                    ];
                } else {
                    $this->db->transCommit();
                    $log_message = "Success remove {$list_kelompok->group_name}";
                    slim_alert('success', $log_message);

                    $resp = [
                        'status' => 200,
                        'message' => 'Success'
                    ];
                }
            } else {
                slim_alert('error', $log_message);
                $resp = [
                    'status' => 410,
                    'message' => 'The requested resource is gone and won’t be coming back'
                ];
            }
        } else {
            $resp = [
                'status' => 405,
                'message' => 'Method Not Allowed'
            ];
        }

        $log_message = "{$this->session->name} remove group user";
        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'GroupUser', $log_message);

        return $this->respond($resp);
    }
}
