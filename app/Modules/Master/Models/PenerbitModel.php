<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class PenerbitModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_publisher';
    protected $primaryKey    = 'publisher_id';
}
