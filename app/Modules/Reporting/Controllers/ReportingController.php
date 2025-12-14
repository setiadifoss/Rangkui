<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Bibliography\Models\BibliographyModel;
use App\Modules\Membership\Models\MembershipModel;
use CodeIgniter\API\ResponseTrait;

class ReportingController extends BaseController
{
    use ResponseTrait;

    public $viewPath = "Reporting/";
    public function index()
    {
        $view = $this->viewPath . "stats_collection/v_index";
        $title = "Reporting";

        /**
         * Total title
         */
        $biblio = new BibliographyModel();
        $biblio_total = $biblio->countAllResults();

        /**
         * Total title by GMD/medium
         */
        $sql = "SELECT
                    gmd_name,
                    COUNT(biblio_id) AS total_titles
                FROM
                    `biblio` AS b
                INNER JOIN mst_gmd AS gmd ON
                    b.gmd_id = gmd.gmd_id
                GROUP BY
                    b.gmd_id
                HAVING
                    total_titles>0
                ORDER BY
                    gmd_name";
        $stats = $this->db->query($sql);


        $content = [
            'biblio_total' => $biblio_total,
            'stats' => $stats,
        ];

        $js = [
            'https://code.highcharts.com/highcharts.js',
            'https://code.highcharts.com/modules/exporting.js',
            'https://code.highcharts.com/modules/accessibility.js',
            'assets/custom/js/modules/reporting/stats-collection'
        ];

        _render($view, $title, $content, $js);
    }

    function stats()
    {

        /**
         * Total title by GMD/medium
         */
        $sql = "SELECT
                    gmd_name,
                    COUNT(biblio_id) AS total_titles
                FROM
                    `biblio` AS b
                INNER JOIN mst_gmd AS gmd ON
                    b.gmd_id = gmd.gmd_id
                GROUP BY
                    b.gmd_id
                HAVING
                    total_titles>0
                ORDER BY
                    gmd_name";
        $stats = $this->db->query($sql);

        $data = [];
        foreach ($stats->getResult() as $key => $val) {
            $data[] = [
                'name' => $val->gmd_name,
                'y' => (float) $val->total_titles,
            ];
        }

        $response = [
            'series' => $data,
        ];

        return $this->respond($response);
    }
}
