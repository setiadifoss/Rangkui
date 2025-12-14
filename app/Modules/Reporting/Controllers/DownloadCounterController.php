<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Bibliography\Models\BibliographyModel;

class DownloadCounterController extends BaseController
{
    public $viewPath = "Reporting/";
    public function index()
    {
        $view  = $this->viewPath . "download_counter/v_index";
        $title = "Download Counter";

        /**
         * Biblio title
         */
        $loadModel = new BibliographyModel();
        $biblio = $loadModel->orderBy('biblio_id', 'DESC')->get()->getResult();
        foreach ($biblio as $key => $value) {
            /**
             * files
             */
            $sql = "SELECT
                        ba.*,
                        f.*,
                        (SELECT COUNT(*) FROM biblio_count bc WHERE bc.biblio_id = ba.biblio_id AND bc.file_id = f.file_id) AS count
                    FROM
                        `biblio_attachment` AS ba
                    JOIN files AS f ON
                        ba.file_id = f.file_id
                    WHERE
                        ba.biblio_id = $value->biblio_id
                    ORDER BY
                        ba.file_id ASC";
            $data = $this->db->query($sql);
            $value->attachment = $data->getResult();
        }

        $content = [
            'data' => $biblio,
        ];

        $js = [];

        _render($view, $title, $content, $js);
    }
}
