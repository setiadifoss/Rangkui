<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class StatusItemModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_item_status';
    protected $primaryKey    = 'item_status_id';
}
