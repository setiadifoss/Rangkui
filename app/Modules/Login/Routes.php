<?php

$routes->group('login', ['namespace' => 'App\Modules\Login\Controllers'], function ($routes) {
    $routes->get('/', 'Login::index');
    $routes->post('auth', 'Login::login');
    $routes->get('logout', 'Login::logout');
});
