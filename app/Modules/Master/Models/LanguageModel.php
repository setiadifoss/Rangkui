<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class LanguageModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_language';
    protected $primaryKey    = 'language_id';
}
