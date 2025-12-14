<?php

use App\Modules\Login\Controllers\Login;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$router = service('router');
$module = $router->controllerName();


/**
 * OAI PMH
 */
$routes->get('oai', 'OaiPmhController::index');
$routes->get('information', "\App\Modules\info\Controllers\InfoController::index");
$routes->get('logout', [Login::class, 'logout']);

$routes->setTranslateURIDashes(true);

$routes->get('/', "\App\Modules\Beranda\Controllers\\$module::index");

// Directory for modules
$modulesPath = APPPATH . 'Modules/';

// Debug: Print path and check if directory exists
if (!is_dir($modulesPath)) {
    die('Modules directory does not exist: ' . $modulesPath);
}


$dirs = scandir($modulesPath);
foreach ($dirs as $module) {
    if ($module === '.' || $module === '..' || !is_dir($modulesPath . $module)) {
        continue;
    }

    $routesFile = $modulesPath . $module . '/Routes.php';
    if (file_exists($routesFile)) {
        include $routesFile;
    }
    // else {
    //     // Debug: Print missing file
    //     echo 'Routes.php not found in: ' . $routesFile . '<br>';
    // }
}
