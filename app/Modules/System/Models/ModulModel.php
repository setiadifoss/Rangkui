<?php


namespace App\Modules\System\Models;

use CodeIgniter\Model;

class ModulModel extends Model
{
    protected $table              = 'mst_menu';
    protected $primaryKey         = 'id';
    protected $returnType         = 'object';
    protected $protectFields      = false;
}
