<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class LicenseModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_license';
    protected $primaryKey    = 'license_id';
}
