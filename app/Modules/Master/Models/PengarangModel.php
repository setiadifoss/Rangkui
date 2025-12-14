<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class PengarangModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_author';
    protected $primaryKey    = 'author_id';
}
