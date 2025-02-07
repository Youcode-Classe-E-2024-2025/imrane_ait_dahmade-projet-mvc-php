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
        
        // Make sure we're only working with the path (remove query string)
        $path = $parsedUrl['path'] ?? '/';
        $path = rtrim($parsedUrl['path'], '/');  // This removes any trailing slashes.

        // Debugging: output the full path
        echo "Requested Path: " . $path . "<br>";  
        
        // Check each route
        foreach ($this->routes as $Route) {
            echo "Checking Route: " . $Route['path'] . "<br>";  // Debugging line
    
            // Check if the current route matches the requested path
            if ($Route['path'] === $path) {
                echo "Route Matched: " . $Route['path'] . "<br>";  // Debugging line
    
                $controllerClass = $Route['controller'];
                $action = $Route['action'];
    
                echo "Controller: " . $controllerClass . "<br>";  // Debugging line
    
                // Check if the class and method exist
                if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                    $controller = new $controllerClass();
                    return $controller->$action();
                } else {
                    echo "Controller or Action does not exist.";
                }
            }
        }
        
        echo "No route found for: " . $path;
    }
    
    
    
    public function GetRoutes()
    {
        return $this->routes;
    }
}
