<?php

namespace App\Modules\Opac\Controllers;

use App\Controllers\BaseController;
use App\Modules\Opac\Models\OpacModel;

class OpacController extends BaseController
{
    public function index()
    {
        $loadModel = new OpacModel();
        $view      = "opac/v_index";
        $title     = "OPAC";

        $content['data'] = [];

        _render($view, $title, $content);
    }
}
