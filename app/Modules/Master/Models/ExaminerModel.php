<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class ExaminerModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_examiner';
    protected $primaryKey    = 'examiner_id';
}
