<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class CollectionModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_coll_type';
    protected $primaryKey    = 'coll_type_id';
}
