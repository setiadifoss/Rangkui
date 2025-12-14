<?php

namespace App\Modules\Export\Controllers;

use App\Controllers\BaseController;
use App\Modules\Bibliography\Models\BibliographyModel;

class ExportDownloadCounterController extends BaseController
{
    public function index()
    {
        /**
         * Biblio title
         */
        $loadModel = new BibliographyModel();
        $biblio    = $loadModel->orderBy('biblio_id', 'DESC')->get()->getResult();

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
            'data'  => $biblio,
            'title' => "Download Counter",
        ];
        echo view("App\Modules\Export\Views/download_counter/v_index", $content);
    }
}
