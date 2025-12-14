<?php

$routes->group('home', ['namespace' => 'App\Modules\Home\Controllers'], function ($routes) {
    $routes->get('/', 'HomeController::index');
    $routes->get('stats', 'HomeController::stats');
});
