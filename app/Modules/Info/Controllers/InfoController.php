<?php

namespace App\Modules\Info\Controllers;

use App\Controllers\BaseController;


class InfoController extends BaseController
{

    public function index()
    {
        $css       = ["assets/vendors/leaflet/leaflet","assets/custom/css/modules/information/information"];
        $js        = ["assets/vendors/leaflet/leaflet","assets/custom/js/modules/information/information"];
        $view      = "v_index";
        $title     = "Information";
        $data      = [];
        $content['data'] = $data;
        _renderView($view, $title, $content, $js, $css);
    }
}
