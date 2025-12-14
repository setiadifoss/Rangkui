<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class FrequencyModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_frequency';
    protected $primaryKey    = 'frequency_id';
}
