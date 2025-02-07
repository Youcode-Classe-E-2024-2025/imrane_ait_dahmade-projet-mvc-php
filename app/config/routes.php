<?php

namespace App\Config;
use app\core\Router;


$routes = [
    'home' => [
        'path' => '/',
        'controller' => 'front\\HomeController',
        'action' => 'index',
    ],
    'login' => [
        'path' =>'/login',
        'controller'=>'UserController',
        'action' => 'login',
        ]
        
    ];
    
$Router = new Router($routes);
$Router->dispatch($_SERVER['REQUEST_URI']);