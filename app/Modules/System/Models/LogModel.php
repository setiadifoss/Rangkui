<?php

namespace App\Modules\System\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table              = 'system_log';
    protected $primaryKey         = 'log_id';
    protected $returnType         = 'object';
    protected $protectFields      = false;
    protected $createdField       = 'log_date';
}
