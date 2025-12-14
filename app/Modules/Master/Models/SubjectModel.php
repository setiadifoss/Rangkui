<?php

namespace App\Modules\Master\Models;

use App\Models\BaseModel;

class SubjectModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $protectFields = false;
    protected $table         = 'mst_topic';
    protected $primaryKey    = 'topic_id';
}
