<?php

use CodeIgniter\Database\Database;
use CodeIgniter\Session\Session as SessionSession;
use Config\Services;
use Config\Session;

if (!function_exists('pd')) {
    /**
     * @param $val
     * @param $exit
     */
    function pd($val, $exit = 0)
    {
        if ($_ENV['CI_ENVIRONMENT'] != 'production') {
            echo "<pre>";
            print_r($val);
            echo "</pre>";

            if ($exit == 1) {
                die;
            }
        }
    }
}

if (!function_exists('_render')) {
    /**
     * Digunakan untuk merender view admin page menggunakan sistem HMVC
     * Menambahkan js atau css yang diperlukan sesuai module yang dipanggil 
     *
     * @param string $view
     * @param string $title
     * @param array $content
     * @param array $js
     * @param array $css
     * @return void
     */
    function _render(string $view, string $title, array $content, array $js = [], array $css = [])
    {
        global $contentPath;
        global $module;

        $module = get_current_module();

        $view = str_replace("/", "\\", $view);
        $dir = ucfirst(strtolower($view));
        // Path untuk view modul
        $contentPath = $module . '\Views\\';
        $page = $contentPath . $view;

        $groups_id = session()->get('groups');

        $db = \Config\Database::connect();

        $list_group = $db->table('group_access ga')
            ->where('group_id', $groups_id)
            ->get()
            ->getResult();

        $groups = array_column($list_group, 'module_id');
        $groups = "('" . implode("', '", $groups) . "')";


        $menus = getMenu($groups);
        // Path untuk template utama
        $templatePath = 'App\Modules\Template\Views\v_template';
        $data = [
            'title'   => $title,
            'content' => view($page, $content),   // Memuat konten halaman dari view
            'css'     => $css,
            'js'      => $js,
            'menus'   => $menus

        ];

        // Render template utama dengan data
        echo view($templatePath, $data);
    }

    /**
     * Digunakan untuk merender view client page menggunakan sistem HMVC
     * Menambahkan js atau css yang diperlukan sesuai module yang dipanggil 
     *
     * @param string $view
     * @param string $title
     * @param array $content
     * @param array $js
     * @param array $css
     * @return void
     */
    function _renderView(string $view, string $title, array $content, array $js = [], array $css = [])
    {
        global $contentPath;
        global $module;

        $module = get_current_module();

        $view = str_replace("/", "\\", $view);
        $dir = ucfirst(strtolower($view));
        // Path untuk view modul
        $contentPath = $module . '\Views\\';
        $page = $contentPath . $view;

        // Path untuk template utama
        $templatePath = 'App\Modules\Template\Views\v_beranda';

        $data = [
            'title'   => $title,
            'content' => view($page, $content),   // Memuat konten halaman dari view
            'css'     => $css,
            'js'      => $js,

        ];

        // Render template utama dengan data
        echo view($templatePath, $data);
    }
    function _renderLogin(string $view, string $title, array $content, array $js = [], array $css = [])
    {
        global $contentPath;
        global $module;

        $module = get_current_module();

        $view = str_replace("/", "\\", $view);
        $dir = ucfirst(strtolower($view));
        // Path untuk view modul
        $contentPath = $module . '\Views\\';
        $page = $contentPath . $view;

        // Path untuk template utama
        $templatePath = 'App\Modules\Template\Views\v_login';

        $data = [
            'title'   => $title,
            'content' => view($page, $content),   // Memuat konten halaman dari view
            'css'     => $css,
            'js'      => $js,

        ];

        // Render template utama dengan data
        echo view($templatePath, $data);
    }
}


if (!function_exists('get_current_module')) {
    function get_current_module()
    {
        // Dapatkan instance router
        $router = Services::router();

        // Dapatkan nama controller yang sedang diakses
        $controller = $router->controllerName();

        // Namespace controller biasanya sesuai dengan nama modul
        // Contoh: 'App\Modules\System\Controllers\SystemController'
        // Pisahkan namespace berdasarkan "\" untuk mendapatkan modul
        $parts = explode('\\', $controller);

        // Anggap nama modul berada di posisi ke-3 (0-indexed)
        // 'App', 'Modules', 'System', 'Controllers', 'SystemController'
        if (isset($parts[3])) {
            return $parts[1] . "\\" . $parts[2] . "\\" . $parts[3]; // Ini adalah nama modul
        }

        return null; // Jika tidak ada modul ditemukan
    }
}

if (!function_exists('buildHierarchy')) {
    // Fungsi untuk membangun array hirarkis
    function buildHierarchy($elements, $parentId = 0)
    {
        $branch = [];

        foreach ($elements as $element) {
            // Pastikan tipe data sama, dengan melakukan perbandingan secara eksplisit
            if ((int)$element['parent_id'] === (int)$parentId) {
                // Mencari anak dari elemen ini secara rekursif
                $children = buildHierarchy($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}

if (!function_exists('getTypeUser')) {
    function getTypeUser($type)
    {
        switch ($type) {
            case 1:
                return "Pustakawan";
                break;
            case 2:
                return "Pustakawan";
                break;
            case 3:
                return "Staff Perpustakaan";
                break;

            default:
                return "Pengguna tidak dikenal";
                break;
        }
    }
}

if (!function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

if (!function_exists('lq')) {

    function lq()
    {
        $db = \Config\Database::connect();
        echo $db->getLastQuery();
        exit;
    }
}


if (!function_exists('cleanUri')) {
    function cleanUri($uri)
    {
        // Menghapus spasi dan menggantinya dengan tanda penghubung
        $uri = str_replace(' ', '-', $uri);

        // Menghapus karakter yang tidak diizinkan (tanda kurung dan karakter khusus lainnya)
        $uri = preg_replace('/[(){}<>]/', '', $uri);

        return $uri;
    }
}

function slim_encrypt($data)
{
    $key = 'slim_key';
    $data = $key . ',' . $data;
    $data = base64_encode($data);
    $data = rawurlencode($data);
    $data = rawurlencode($data);
    return $data;
}

function slim_decrypt($data)
{
    $data = rawurldecode($data);
    $data = rawurldecode($data);
    $data = base64_decode($data);
    $data = explode(',', $data);
    return $data[1];
}
function authority_type($type)
{
    if ($type == 'p') {
        $result = 'Personal Name';
    } elseif ($type == 'o') {
        $result = 'Organization Body';
    } elseif ($type == 'c') {
        $result = 'Conference';
    } else {
        $result = '-';
    }
    return $result;
}

if (!function_exists('getMenu')) {
    function getMenu($groups)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT
                    *
                FROM
                    `mst_menu` m
                WHERE
                    m.`id` IN {$groups}
                    OR 
                    m.`parent_id` IN {$groups}
                    AND `level` = 2
                UNION 
                SELECT
                    m.*
                FROM
                    `mst_menu` m
                WHERE
                    m.`parent_id` IN (
                    SELECT
                        m.id
                    FROM
                        `mst_menu` m
                    WHERE
                        m.`parent_id` IN {$groups}
                            AND `level` = 2
                        ORDER BY
                            m.`parent_id` )";

        $query = $db->query($sql)
            ->getResultArray();

        $menuItems = $query;
        $list_menu = buildMenuTree($menuItems);
        // insert Shortcut
        $shortcuts = getShortcut();
        if (!is_null($shortcuts)) {
            foreach ($shortcuts as $shortcut) {
                $shortcut->parent_id = 1;
                $list_menu[0]['children'][] = (array)$shortcut;
            }
        }

        return $list_menu;
    }
}
if (!function_exists('buildMenuTree')) {
    function buildMenuTree($menuItems, $parentId = null)
    {
        $tree = [];
        foreach ($menuItems as $menuItem) {
            if ($menuItem['parent_id'] == $parentId) {
                // Cari child dari menu ini
                $children = buildMenuTree($menuItems, $menuItem['id']);

                // Jika ada child, tambahkan ke array children
                if ($children) {
                    $menuItem['children'] = $children;
                }

                // Masukkan item ke tree
                $tree[] = $menuItem;
            }
        }
        return $tree;
    }
}

if (!function_exists('getShortcut')) {
    function getShortcut()
    {
        $db = \Config\Database::connect();
        $setting = $db->table('setting');

        $old_sc = $setting->where("setting_name", "setiadi_shortcut_1")
            ->get();

        $shortcut = [];

        if ($old_sc->getNumRows() > 0) {

            $old_sc = $old_sc
                ->getRow()
                ->setting_value;

            if (!empty(trim($old_sc))) {
                $shortcut = unserialize($old_sc);
            }
        }

        return $shortcut;
    }
}
