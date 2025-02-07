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
        foreach ($this->routes as $Route) {

            if ($Route['path'] === $Uri) {
                $controllerClass = "app\\controllers\\" . $Route['controller'];
                $Action = $Route['action'];

                if (class_exists($controllerClass) && method_exists($controllerClass, $Action)) {
                    $controller = new $controllerClass();
                    return $controller->$Action();
                }
            }
            if ($this->notFoundCallback) {
                call_user_func($this->notFoundCallback);
            } else {
                echo "404 Not Found";
            }
        }
    }
    public function GetRoutes()
    {

        return $this->routes;
    }
}
