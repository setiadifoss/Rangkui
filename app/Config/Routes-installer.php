<?php

use App\Controllers\InstallController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$router = service('router');
$module = $router->controllerName();

if (file_exists(ROOTPATH . 'admin/conf.inc.php')) {

    $routes->get('/', [InstallController::class, 'install']);
    $routes->get('install/fresh', [InstallController::class, 'fresh']);
    $routes->post('install/fresh', [InstallController::class, 'fresh']);
    $routes->get('install/upgrade', [InstallController::class, 'upgrade']);
    $routes->post('install/upgrade', [InstallController::class, 'upgrade']);
    $routes->get('install/type-installation', [InstallController::class, 'type']);
    $routes->post('install/process', [InstallController::class, 'process']);
}
