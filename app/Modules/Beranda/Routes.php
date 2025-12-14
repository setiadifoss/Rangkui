<?php

use App\Modules\Beranda\Controllers\BerandaController;

$routes->group('beranda', ['namespace' => 'App\Modules\Beranda\Controllers'], function ($routes) {
    $routes->get('/', [BerandaController::class, 'index']);
    $routes->get('detail/(:any)', 'BerandaController::detail/$1');
    $routes->get('search', 'BerandaController::search');
    $routes->post('counting', 'BerandaController::counting');
});
