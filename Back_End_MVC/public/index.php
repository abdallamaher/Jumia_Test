<?php
namespace App;

use App\Core as Core;

if(!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

require '..' . DS . 'app' . DS . 'config.php';

ob_start();

// Open Database Connection and get an instance of Database
$db = Core\Database\DatabaseHandler::factory();

$front = new Core\FrontController();
$front->dispatch();