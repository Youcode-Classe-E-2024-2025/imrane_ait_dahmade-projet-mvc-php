<?php

namespace app\core;

class Router {

    private $routes = [];
    private $notFoundCallback;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function setNotFoundCallback(callable $callback)
    {
        $this->notFoundCallback = $callback;
    }

    public function dispatch($Uri)
    {
        $parsedUrl = parse_url($Uri);
        $path = $parsedUrl['path'] ?? '/';

        foreach ($this->routes as $Route) {
            if ($Route['path'] === $path) {
                echo "Route found";
                $controllerClass = "app\\controllers\\" . $Route['controller'];
                $action = $Route['action'];

                if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                    $controller = new $controllerClass();
                    return $controller->$action();
                }
            }
        }
        if ($this->notFoundCallback) {
            call_user_func($this->notFoundCallback);
        } else {
            echo "404 Not Found";
        }
    }
    public function GetRoutes()
    {
        return $this->routes;
    }
}
