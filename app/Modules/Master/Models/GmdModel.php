<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class GmdModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_gmd';
    protected $primaryKey    = 'gmd_id';
}
