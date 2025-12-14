<?php

namespace App\Modules\Home\Models;

use App\Models\BaseModel;

class HomeModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAuhtor(int $where, string $distinct = 'false')
    {

        switch ($where) {
            case 2: // dosen
                $where = "IN (2, 3)";
                break;

            case 3: // penguji
                $where = "IN (4, 5)";
                break;

            default: // penulis
                $where = "= 1";
                break;
        }
        $hasil = $this->db->query("SELECT {$distinct} author_id, level FROM biblio_author WHERE level {$where}");
        return $hasil->getNumRows();
    }

    public function getDatas($for)
    {
        switch ($for) {
            case 2: // Judul
                $hasil = $this->db->query("SELECT biblio_id FROM biblio ");
                break;
            default: // GMD
                $hasil = $this->db->query("SELECT gmd_id FROM mst_gmd ");
                break;
        }
        return $hasil->getNumRows();
    }
}
