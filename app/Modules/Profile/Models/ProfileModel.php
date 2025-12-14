<?php

namespace App\Modules\Profile\Models;

use App\Models\BaseModel;

class ProfileModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'user';
    protected $primaryKey    = 'user_id';
}
