<?php

namespace App\Modules\System\Controllers;

use Config\Services;
use App\Controllers\BaseController;
use App\Modules\System\Models\PintasanModel;
use Symfony\Component\Console\Helper\Dumper;

class PintasanController extends BaseController
{
    public $viewPath = "Pintasan/";
    public function index()
    {
        $view = $this->viewPath . "v_index";
        $title = "Shortcut";

        $pintasan = new PintasanModel();

        $query = "SELECT
                        DISTINCT m1.*
                    FROM
                        `mst_menu` m1
                    JOIN `mst_menu` m2 ON
                        m1.id = m2.parent_id
                    WHERE
                        m1.type = 'menu' and m1.id != 1";
        $menu = $pintasan->query($query)
            ->getResult();

        $setting = $this->db->table('setting');

        $sc = $setting->select('setting_value')
            ->where('setting_name', 'setiadi_shortcut_1')
            ->get()
            ->getRow();

        $content = [
            'menu' => $menu,
            'sc' => $sc,
        ];

        $js = [
            '/assets/custom/js/modules/system/pintasan'
        ];
        _render($view, $title, $content, $js);
    }

    function listSubmenu()
    {
        global $module;
        $module = get_current_module();

        extract($this->input->getPost());

        $pintasan = new PintasanModel();
        $list_sub_menu = $pintasan->listSubMenu($id);
        if (!empty($list_sub_menu)) {

            $tree = buildHierarchy($list_sub_menu, $id);

            $setting = $this->db->table('setting');
            $sc_setting = $setting->select('setting_value')
                ->where('setting_name', 'setiadi_shortcut_1')
                ->get()
                ->getRow();

            $list_sc = [];

            if (!empty(trim($sc_setting->setting_value))) {
                $list_sc = array_column(unserialize($sc_setting->setting_value), "title");
            }


            $page = $module . "//Views//" . $this->viewPath . "v_list_submenu";

            $data = [
                'list_sub_menu' => $list_sub_menu,
                'tree' => $tree,
                'list_sc' => $list_sc,
            ];

            return view($page, $data);
        } else {
            echo "Sub Menu Not Found";
        }
    }

    function add()
    {
        extract($this->input->getPost());

        $this->db->transBegin();

        $data = [];
        foreach ($sub_list as $key => $val) {
            $menu = $this->db->table('mst_menu')
                ->where('id', $val)
                ->get()
                ->getRow();

            $data[] = $menu;
        }

        $setting = $this->db->table('setting');

        $old_sc = $setting->where("setting_name", "setiadi_shortcut_1")
            ->get()
            ->getRow()
            ->setting_value;

        if (!empty(trim($old_sc))) {
            $ar_old_sc = unserialize($old_sc);
            $existing_sc = array_column($ar_old_sc, "id");

            foreach ($data as $val) {
                if (!in_array($val->id, $existing_sc)) {
                    $new_data_sc[] = $val;
                }
            }

            $new_sc = array_merge($ar_old_sc, $new_data_sc);
        } else {
            $new_sc = $data;
        }



        $setting->set("setting_value", serialize($new_sc));
        $setting->where("setting_name", "setiadi_shortcut_1");
        $setting->update();

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();

            $log_message = "Update shortcut failed";
            slim_alert('error', $log_message);
        } else {
            $this->db->transCommit();
            $log_message = "Update shortcut success";
            slim_alert('success',);
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Shortcut', $log_message);

        return redirect()->to('sistem/pintasan');
    }

    function delete()
    {
        extract($this->input->getPost());

        $this->db->transBegin();

        $setting = $this->db->table('setting');
        $sc = $setting->where('setting_name', 'setiadi_shortcut_1')
            ->get()
            ->getRow();

        $list_sc = unserialize($sc->setting_value);

        $total = count($list_sc);
        if ($total > 1) {
            $sc_delete = array_filter($list_sc, function ($row) use ($sub_list) {
                return !in_array($row->id, $sub_list);
            });

            $sc_delete = array_values($sc_delete);

            $idToDelete = (int) $sc_delete[0]->id;

            $data = [];
            $data = array_filter($list_sc, function ($row) use ($idToDelete) {
                return $row->id != $idToDelete;
            });

            $setting->set('setting_value', serialize($data));
        } else if ($total == 1) {
            $setting->set('setting_value', '');
        } else {
            return redirect()->to('sistem/pintasan');
        }


        $setting->where('setting_name', 'setiadi_shortcut_1');
        $setting->update();

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            $log_message = 'Delete shortcut failed';
            slim_alert('error', $log_message);
        } else {
            $this->db->transCommit();
            $log_message = 'Delete shortcut success';
            slim_alert('success', $log_message);
        }

        Services::writeLog(getTypeUser($this->session->user_type), $this->session->user_id, 'Shortcut', $log_message);
        return redirect()->to('sistem/pintasan');
    }
}
