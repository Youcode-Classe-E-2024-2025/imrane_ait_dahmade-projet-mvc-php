<?php

require_once 'vendor/autoload.php';
require_once './app/config/routes.php';

use app\core\Database;
use app\core\Router;

$db = Database::instance();

$r = new Router($return);
echo $_SERVER['REQUEST_URI'];
