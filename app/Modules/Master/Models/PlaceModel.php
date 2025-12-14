<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class PlaceModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_place';
    protected $primaryKey    = 'place_id';
}
