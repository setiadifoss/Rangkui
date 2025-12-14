<?php

namespace App\Modules\System\Models;

use App\Models\BaseModel;

class SystemModel extends BaseModel
{
    protected $table = 'setting';

    protected $protectFields = false;
}
