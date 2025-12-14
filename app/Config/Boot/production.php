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
 | Don't show ANY in production environments. Instead, let the system catch
 | it and display a generic error message.
 |
 | If you set 'display_errors' to '1', CI4's detailed error report will show.
 */
// error_reporting(E_ALL & ~E_DEPRECATED);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// If you want to suppress more types of errors.
// error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

/*
 |--------------------------------------------------------------------------
 | DEBUG MODE
 |--------------------------------------------------------------------------
 | Debug mode is an experimental flag that can allow changes throughout
 | the system. It's not widely used currently, and may not survive
 | release of the framework.
 */

defined('SHOW_DEBUG_BACKTRACE') || define('SHOW_DEBUG_BACKTRACE', false);
defined('CI_DEBUG') || define('CI_DEBUG', false);
