<?php

$routes->group('export', ['namespace' => 'App\Modules\Export\Controllers'], function ($routes) {
    $routes->get('download-counter', 'ExportDownloadCounterController::index');
});
