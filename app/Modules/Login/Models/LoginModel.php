<?php

namespace App\Modules\Login\Models;

class LoginModel extends \App\Models\BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'password'];

    protected $hidden = ['password'];
}
