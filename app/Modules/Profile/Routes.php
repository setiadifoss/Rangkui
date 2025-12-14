<?php

$routes->group('profile', ['namespace' => 'App\Modules\Profile\Controllers'], function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->post('save', 'ProfileController::save');

});
