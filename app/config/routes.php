<?php

namespace app\Config;

use app\core\Router;

$routes = [
    'home' => [
        'path' => '/',
        'controller' => 'App\\Controllers\\Front\\HomeController',
        'action' => 'index',
    ],
    'login' => [
        'path' => '/login',
        'controller' => 'App\\Controllers\\Back\\UserController',
        'action' => 'Login',
    ],
];


$Router = new Router($routes);
$Router->dispatch($_SERVER['REQUEST_URI']);
echo $_SERVER['REQUEST_URI'];  // This will print the requested URI
