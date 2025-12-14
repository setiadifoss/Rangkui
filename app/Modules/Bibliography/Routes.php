<?php

$routes->group('bibliography', ['namespace' => 'App\Modules\Bibliography\Controllers'], function ($routes) {
    $routes->get('/', 'BibliographyController::index');
    $routes->get('add', 'BibliographyController::add');
    $routes->get('edit', 'BibliographyController::edit');
    $routes->get('mail', 'BibliographyController::sendMail');

    $routes->post('attDelete', 'BibliographyController::atthacmentDelete');
    $routes->post('save', 'BibliographyController::save');
    $routes->post('update', 'BibliographyController::update');
    $routes->post('docDelete', 'BibliographyController::delete');
    $routes->post('getAttachment', 'BibliographyController::getAttachment');
    $routes->post('updateAttachment', 'BibliographyController::updateAttachment');

    /**
     * Tools
     */
    $routes->get('import-xml', 'BibliographyController::import_xml');

    /**
     * Add Options
     */
    $routes->post('addopti', 'BibliographyController::addOptions');
    $routes->post('addmstry', 'BibliographyController::addMinistry');
});
