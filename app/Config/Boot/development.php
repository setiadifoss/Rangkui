<?php

require_once ROOTPATH . 'vendor/autoload.php';

// Load environment variables
if (file_exists(ROOTPATH . '.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(ROOTPATH);
    $dotenv->load();
}

/*
 |--------------------------------------------------------------------------
 | ERROR DISPLAY
 |--------------------------------------------------------------------------
 | In development, we want to show as many errors as possible to help
 | make sure they don't make it to production. And save us hours of
 | painful debugging.
 |
 | If you set 'display_errors' to '1', CI4's detailed error report will show.
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

/*
 |--------------------------------------------------------------------------
 | DEBUG BACKTRACES
 |--------------------------------------------------------------------------
 | If true, this constant will tell the error screens to display debug
 | backtraces along with the other error information. If you would
 | prefer to not see this, set this value to false.
 */
defined('SHOW_DEBUG_BACKTRACE') || define('SHOW_DEBUG_BACKTRACE', true);

/*
 |--------------------------------------------------------------------------
 | DEBUG MODE
 |--------------------------------------------------------------------------
 | Debug mode is an experimental flag that can allow changes throughout
 | the system. This will control whether Kint is loaded, and a few other
 | items. It can always be used within your own application too.
 */
defined('CI_DEBUG') || define('CI_DEBUG', true);



// $logger = \Config\Services::logger();
// $logger->initialize([
//     'handlers' => [
//         [
//             'type' => 'file',
//             'path' => WRITEPATH . 'logs/development.log',
//             'level' => 'debug',
//         ],
//     ],
// ]);

// // Set custom error handler
// set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($logger) {
//     $logger->error("Error: [$errno] $errstr - $errfile:$errline");
//     return false; // Let the default PHP error handler continue
// });

// // Set custom exception handler
// set_exception_handler(function ($exception) use ($logger) {
//     $logger->error("Uncaught Exception: " . $exception->getMessage());
// });
