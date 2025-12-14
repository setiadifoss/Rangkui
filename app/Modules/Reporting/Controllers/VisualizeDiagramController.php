<?php

namespace App\Modules\Reporting\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class VisualizeDiagramController extends BaseController
{
    use ResponseTrait;
    public $viewPath = "Reporting/";

    function index()
    {
        $view            = $this->viewPath . "visual_diagram/v_index";
        $title           = "Reporting";
        $db              = \Config\Database::connect();
        $builder         = $this->db->table('mst_author');
        $content['data'] = $builder->select('*')
            ->get()
            ->getresult();
        $css             = [
            'https://cdn.jsdelivr.net/npm/jsmind@0.8.5/style/jsmind.css',
        ];
        
        $js              = [
            'https://cdn.jsdelivr.net/npm/jsmind@0.8.5/es6/jsmind.js',
            'assets/custom/js/modules/reporting/visualize_diagram',
        ];

        _render($view, $title, $content, $js, $css);
    }
    public function showMm()
    {
        $authorId = $this->request->getPost('author_id');
        $db       = \Config\Database::connect();
        $view     =  $this->viewPath . "v_index";
        $title    = "Keanggotaan";

        $hasil = $db->query("SELECT
                        json_array(
                            json_object(
                                'id' , ba.biblio_id,
                                'topic' , (SELECT b.title FROM biblio b WHERE b.biblio_id = ba.biblio_id),
                                'children' , (SELECT json_array(
                                                        json_object(
                                                            'id' , ba2.author_id,
                                                            'topic',(
                                                                        SELECT ma.author_name FROM mst_author ma WHERE ma.author_id = ba2.author_id 
                                                            )
                                                        ) 
                                                )
                                                FROM 
                                                    biblio_author ba2 
                                                WHERE 
                                                    ba2.biblio_id = ba.biblio_id 
                                                AND 
                                                    ba2.author_id <> ba.author_id
                                                ) 
                            ) 
                        ) AS DATA
                    FROM
                        biblio_author ba
                    WHERE
                        ba.author_id = ? ", [$authorId]);
        if ($hasil->getNumRows() > 0) {
            $hasil = $hasil->getResult();
        } else {
            $hasil = [];
        }
        return $this->respond($hasil);
    }
}
