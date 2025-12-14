<?php

$routes->group('opac', ['namespace' => 'App\Modules\Opac\Controllers'], function ($routes) {
    $routes->get('/', 'OpacController::index');
});
