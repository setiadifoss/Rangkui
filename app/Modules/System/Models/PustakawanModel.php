<?php


namespace App\Modules\System\Models;

use CodeIgniter\Model;

class PustakawanModel extends Model
{
    protected $table              = 'user';
    protected $primaryKey         = 'user_id';
    protected $returnType         = 'object';
    protected $protectFields      = false;
}
