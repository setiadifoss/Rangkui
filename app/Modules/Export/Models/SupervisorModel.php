<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class SupervisorModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_supervisor';
    protected $primaryKey    = 'supervisor_id';
}
