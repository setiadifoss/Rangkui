<?php

$routes->group('master', ['namespace' => 'App\Modules\Master\Controllers'], function ($routes) {
    $routes->get('gmd', 'GmdController::index');
    $routes->post('gmd/save', 'GmdController::save');
    $routes->post('gmd/delete','GmdController::delete');

    $routes->get('penerbit', 'PenerbitController::index');
    $routes->post('penerbit/save', 'PenerbitController::save');
    $routes->post('penerbit/delete','PenerbitController::delete');

    $routes->get('pengarang', 'PengarangController::index');
    $routes->post('pengarang/save', 'PengarangController::save');
    $routes->post('pengarang/delete','PengarangController::delete');

    $routes->get('supervisor', 'SupervisorController::index');
    $routes->post('supervisor/save', 'SupervisorController::save');
    $routes->post('supervisor/delete','SupervisorController::delete');

    $routes->get('examiner', 'ExaminerController::index');
    $routes->post('examiner/save', 'ExaminerController::save');
    $routes->post('examiner/delete','ExaminerController::delete');

    $routes->get('subject', 'SubjectController::index');
    $routes->post('subject/save', 'SubjectController::save');
    $routes->post('subject/delete','SubjectController::delete');

    $routes->get('location', 'LocationController::index');
    $routes->post('location/save', 'LocationController::save');
    $routes->post('location/delete','LocationController::delete');

    $routes->get('license', 'LicenseController::index');
    $routes->post('license/save', 'LicenseController::save');
    $routes->post('license/delete','LicenseController::delete');

    $routes->get('place', 'PlaceController::index');
    $routes->post('place/save', 'PlaceController::save');
    $routes->post('place/delete','PlaceController::delete');

    $routes->get('collection', 'CollectionController::index');
    $routes->post('collection/save', 'CollectionController::save');
    $routes->post('collection/delete','CollectionController::delete');

    $routes->get('language', 'LanguageController::index');
    $routes->post('language/save', 'LanguageController::save');
    $routes->post('language/delete','LanguageController::delete');

    $routes->get('statusitem', 'StatusItemController::index');
    $routes->post('statusitem/save', 'StatusItemController::save');
    $routes->post('statusitem/delete','StatusItemController::delete');

    $routes->get('frequency', 'FrequencyController::index');
    $routes->post('frequency/save', 'FrequencyController::save');
    $routes->post('frequency/delete','FrequencyController::delete');

    $routes->get('codeministry', 'CodeMinistryController::index');
    $routes->post('codeministry/save', 'CodeMinistryController::save');
    $routes->post('codeministry/delete','CodeMinistryController::delete');
});
