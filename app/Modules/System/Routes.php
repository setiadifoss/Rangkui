<?php

use Config\Database;

$routes->group('sistem', ['namespace' => 'App\Modules\System\Controllers'], function ($routes) {
    $routes->get('pengaturan-sistem', 'SystemController::pengaturan');
    $routes->post('pengaturan-sistem/update', 'SystemController::update');
    $routes->post('pengaturan-sistem/update-key', 'SystemController::updateKey');

    // Konten
    $routes->get('konten', 'KontenController::index');
    $routes->get('konten/add', 'KontenController::add');
    $routes->post('konten/save', 'KontenController::save');
    $routes->get('konten/edit/(:num)', 'KontenController::edit/$1');
    $routes->post('konten/update', 'KontenController::update');
    $routes->post('konten/delete', 'KontenController::delete');

    // Pintasan
    $routes->get('pintasan', 'PintasanController::index');
    $routes->post('pintasan/sub-menu', 'PintasanController::listSubmenu');
    $routes->post('pintasan/add', 'PintasanController::add');
    $routes->post('pintasan/delete', 'PintasanController::delete');

    //IndexBiblio
    $routes->get('indeks-biblio', 'IndexBiblioController::index');
    $routes->get('indeks-biblio/add', 'IndexBiblioController::add');
    $routes->post('indeks-biblio/save', 'IndexBiblioController::save');
    $routes->post('indeks-biblio/check', 'IndexBiblioController::check');
    $routes->get('indeks-biblio/reindex', 'IndexBiblioController::reindex');
    $routes->get('indeks-biblio/delete', 'IndexBiblioController::delete');

    //Modul
    $routes->get('modul', 'ModulController::index');
    $routes->get('modul/add', 'ModulController::add');
    $routes->post('modul/save', 'ModulController::save');
    $routes->get('modul/edit/(:num)', 'ModulController::edit/$1');
    $routes->post('modul/update/', 'ModulController::update');
    $routes->post('modul/delete/', 'ModulController::delete');

    //Pustakawan
    $routes->get('pustakawan', 'PustakawanController::index');
    $routes->get('pustakawan/add', 'PustakawanController::add');
    $routes->post('pustakawan/save', 'PustakawanController::save');
    $routes->get('pustakawan/edit/(:num)', 'PustakawanController::edit/$1');
    $routes->post('pustakawan/update', 'PustakawanController::update');
    $routes->post('pustakawan/delete', 'PustakawanController::delete');

    // UserGroups
    $routes->get('user-groups', 'KelompokPenggunaController::index');
    $routes->get('user-groups/add', 'KelompokPenggunaController::add');
    $routes->post('user-groups/save', 'KelompokPenggunaController::save');
    $routes->get('user-groups/edit/(:num)', 'KelompokPenggunaController::edit/$1');
    $routes->post('user-groups/update', 'KelompokPenggunaController::update');
    $routes->post('user-groups/delete', 'KelompokPenggunaController::delete');

    // Log
    $routes->get('logs', 'LogController::index');
    $routes->get('logs/delete', 'LogController::delete');
    $routes->get('logs/save', 'LogController::save');

    // Backup
    $routes->get('backups', 'BackupController::index');
    $routes->get('backups/add', 'BackupController::add');
    $routes->get('backups/download/(:num)', 'BackupController::download/$1');
});
