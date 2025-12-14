<?php

namespace App\Modules\System\Models;

use CodeIgniter\Model;

class PintasanModel extends Model
{
    protected $table         = 'mst_menu ';
    protected $primaryKey    = 'id';
    protected $returnType    = 'object';
    protected $protectFields = false;


    public function listSubMenu(int $parentID)
    {
        $sql = "SELECT *
                    FROM `mst_menu`
                WHERE parent_id IN (
                    SELECT id
                    FROM `mst_menu`
                    WHERE parent_id = ?
                ) OR parent_id = ? ";

        try {
            $data = $this->query($sql, [$parentID, $parentID]);

            return $data->getResult('array');
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());

            return [];
        }
    }

    public function getTopMenu()
    {
        $menu = $this->select('id,title,icon')
            ->where('level', 1)
            ->get()
            ->getResult();

        return $menu;
    }
}
