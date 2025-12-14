<?php

namespace App\Modules\System\Models;

use CodeIgniter\Model;

class KelompokPenggunaModel extends Model
{
    protected $table              = 'user_group';
    protected $primaryKey         = 'group_id';
    protected $returnType         = 'object';
    protected $protectFields      = false;
    protected $useTimestamps      = true;
    protected $createdField       = 'input_date';
    protected $updatedField       = 'last_update';

    public function groupAccess(int $id)
    {
        $sql = "SELECT
                    ug.group_id,
                    ug.group_name ,
                    ug.input_date,
                    ug.last_update,
                    ga.module_id ,
                    ga.r ,
                    ga.w
                FROM
                    user_group ug
                JOIN group_access ga ON
                    ga.group_id = ug.group_id
                WHERE
                    ug.group_id = ?";

        return $this->query($sql, [$id]);
    }
}
