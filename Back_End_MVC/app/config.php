<?php

// 1 for Development | 2 for Production
define('PROJECT_SCOPE', 1);

// Database Credentials
defined('DATABASE_HOST_NAME')       ? null : define ('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_USER_NAME')       ? null : define ('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')        ? null : define ('DATABASE_PASSWORD', '');
defined('DATABASE_DB_NAME')         ? null : define ('DATABASE_DB_NAME', 'store');
defined('DATABASE_PORT_NUMBER')     ? null : define ('DATABASE_PORT_NUMBER', 3306);
defined('DATABASE_CONN_DRIVER')     ? null : define ('DATABASE_CONN_DRIVER', 1);

// Paths
define('APP_PATH', dirname(realpath(__FILE__)));
define('MODELS_PATH', APP_PATH . DS . 'models');
define('VIEWS_PATH', APP_PATH . DS . 'views');
define('CONTROLLERS_PATH', APP_PATH . DS . 'controllers');
define('CORE_PATH', APP_PATH . DS . 'core');


// define an autoloader function
function autoload ($className)
{
    $namespacePrefix = 'App';
    $class = str_replace($namespacePrefix, '', $className);
    $class = str_replace('\\', '/', $class);
    $classFile = APP_PATH . strtolower($class) . '.php';
    if(file_exists($classFile)) {
        require $classFile;
    }
}

spl_autoload_register('autoload');

if (PROJECT_SCOPE === 1) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', APP_PATH . DS . 'error.log');
}
error_reporting(E_ALL);
mb_internal_encoding('utf8');