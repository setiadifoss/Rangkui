<?php

use App\Modules\Info\Controllers\InfoController;

$routes->get('/', [InfoController::class, 'index']);
