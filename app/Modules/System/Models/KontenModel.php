<?php

namespace App\Modules\System\Models;

use CodeIgniter\Model;

class KontenModel extends Model
{
    protected $table              = 'content';
    protected $primaryKey         = 'content_id';
    protected $returnType         = 'object';
    protected $protectFields      = false;
    protected $useTimestamps      = true;
    protected $createdField       = 'input_date';
    protected $updatedField       = 'last_update';
}
