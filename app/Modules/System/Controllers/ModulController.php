<?php

namespace App\Modules\System\Controllers;

use Config\Services;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Modules\System\Models\ModulModel;
use App\Modules\System\Models\PintasanModel;

class ModulController extends BaseController
{
    use ResponseTrait;

    public $viewPath = "Modul/";
    public function index()
    {
        $view = $this->viewPath . "v_index";
        $title = formatString(lang("Messages.modul"));

        $modul = new ModulModel();
        $menu = $modul->where('level', 1)
            ->get()
            ->getResult();

        $content = [
            'menu' => $menu,
        ];
        $js = ['assets/custom/js/modules/system/modul'];
        _render($view, $title, $content, $js);
    }

    function add()
    {
        $view = $this->viewPath . "v_add";
        $title = "Add New Modul";

        $icon = $this->db->table('mst_icon');
        $list_icon = $icon->get()->getResult();

        $content = [
            'list_icon' => $list_icon,
        ];

        $js = ['assets/custom/js/modules/system/modul'];
        _render($view, $title, $content, $js);
    }

    function save()
    {
        extract($this->input->getPost());


        $this->db->transBegin();
        $data = [
            'parent_id' => null,
            'url' => null,
            'title'       => trim($title),
            'icon'        => trim($icon),
            'type' => 'menu',
            'level' => 1,
            'desc' => $desc,
        ];

        $menu = $this->db->table('mst_menu');
        $menu->insert($data);

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $log_message = "Save new module {$title} failed";
            slim_alert('error', $log_message);
        } else {
            $this->db->transCommit();
            $log_message = "Save new module {$title} success";
            slim_alert('success', $log_message);
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Modul', $log_message);


        return redirect()->to('sistem/modul');
    }

    function edit($id)
    {
        $menu = $this->db->table('mst_menu');
        $list_menu = $menu->where('id', $id)->get();

        if ($list_menu->getNumrows() > 0) {
            $view = $this->viewPath . "v_edit";
            $title = "Edit Module";

            $icon = $this->db->table('mst_icon');
            $list_icon = $icon->get()->getResult();


            $content = [
                'list_icon' => $list_icon,
                'list_menu' => $list_menu->getRow(),
            ];

            $js = ['assets/custom/js/modules/system/modul'];
            _render($view, $title, $content, $js);
        } else {
            slim_alert('error', "Modul tidak ditemukan");
        }
    }

    function update()
    {
        extract($this->input->getPost());

        $id = $w_id;

        $menu = $this->db->table('mst_menu');
        $list_menu = $menu->where('id', $id)->get();

        if ($list_menu->getNumrows() > 0) {

            $data = [
                'title' => $title,
                'icon' => $icon,
                'desc' => $desc,
            ];

            $this->db->transBegin();
            $menu->set($data);
            $menu->where('id', $id);
            $menu->update();

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                $log_message = "Update module {$title} failed";
                slim_alert('error', $log_message);
            } else {
                $this->db->transCommit();
                $log_message = "Update module {$title} success";
                slim_alert('success', $log_message);
            }

            Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Module', $log_message);

            return redirect()->to("sistem/modul/edit/{$id}");
        } else {
            slim_alert('error', "Module Not Found");

            return redirect()->to("sistem/modul");
        }
    }

    function delete()
    {
        if ($this->input->isAJAX()) {
            $this->db->transBegin();

            $id  = $this->input->getPost('id');
            $menu = new PintasanModel();

            $list_menu = $menu->find($id);

            if (!empty($list_menu)) {
                $menu->delete($id);

                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    $log_message = "Delete module {$list_menu->title} failed";
                    slim_alert('error', $log_message);

                    $resp = [
                        'status' => 500,
                        'message' => 'Error'
                    ];
                } else {
                    $this->db->transCommit();
                    $log_message = "Delete module {$list_menu->title} success";
                    slim_alert('success', $log_message);

                    $resp = [
                        'status' => 200,
                        'message' => 'Success'
                    ];
                }

                Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Modul', $log_message);
            } else {
                slim_alert('error', "Data failed to delete");
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
        return $this->respond($resp);
    }
}
