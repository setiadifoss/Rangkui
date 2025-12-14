<?php

$routes->group('membership', ['namespace' => 'App\Modules\Membership\Controllers'], function ($routes) {
    // KeanggotaanController

    // get
    $routes->get('/', 'KeanggotaanController::index');
    $routes->get('add', 'KeanggotaanController::add');
    $routes->get('edit', 'KeanggotaanController::edit');
    $routes->get('xmember', 'KeanggotaanController::expMember');

    // post
    $routes->post('save', 'KeanggotaanController::save');
    $routes->post('update', 'KeanggotaanController::update');
    $routes->post('updateExp', 'KeanggotaanController::updateExp');
    $routes->post('delete', 'KeanggotaanController::delete');

    // TipeKeanggotaanController

    // get
    $routes->get('membertype', 'TipeKeanggotaanController::index');
    $routes->get('addtype', 'TipeKeanggotaanController::add');
    $routes->get('edittype', 'TipeKeanggotaanController::edit');

    // post
    $routes->post('savetype', 'TipeKeanggotaanController::save');
    $routes->post('updatetype', 'TipeKeanggotaanController::update');
    
});
