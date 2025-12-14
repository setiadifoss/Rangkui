<?php

namespace App\Modules\Home\Controllers;

use App\Modules\Home\Models\HomeModel;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class HomeController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Home/";

    public function index()
    {
        $dashboard          = new HomeModel();
        $view               = "v_Dashboard";
        $title              = "";
        $content['penulis'] = $dashboard->getAuhtor(1, 'true');
        $content['dosen']   = $dashboard->getAuhtor(2, 'true');
        $content['penguji'] = $dashboard->getAuhtor(3, 'true');
        $content['gmd']     = $dashboard->getDatas(1);
        $content['judul']   = $dashboard->getDatas(2);
        $content['user']    = $this->session->name;
        $js = [
            'https://code.highcharts.com/highcharts.js',
            'https://code.highcharts.com/modules/exporting.js',
            'https://code.highcharts.com/modules/accessibility.js',
            'assets/custom/js/modules/dashboard/dashboard',
        ];

        _render($view, $title, $content, $js);
    }

    function stats()
    {

        /**
         * Total title by GMD/medium
         */
        $sql = "SELECT
                    gmd_name AS `name`,
                    COUNT(biblio_id) AS total_titles
                FROM
                    `biblio` AS b
                INNER JOIN mst_gmd AS gmd ON
                    b.gmd_id = gmd.gmd_id
                GROUP BY
                    b.gmd_id";
        $stats = $this->db->query($sql);

        $data = [];
        foreach ($stats->getResult() as $key => $val) {
            $data[] = [
                'name' => $val->name,
                'y' => (float) $val->total_titles,
            ];
        }

        $response = [
            'series' => $data,
        ];

        return $this->respond($response);
    }
}
