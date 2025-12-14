<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class CodeMinistryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_code_ministry';
    protected $primaryKey    = 'code_ministry';
}
