<?php 
namespace app\core;

class Router {

    private $routes = [];
    private $notFoundCallback;

   public function __construct(array $routes){
    $this->routes = $routes;
    
   }
   
   public function setNotFoundCallback(callable $callback)
   {
       $this->notFoundCallback = $callback;
   }

   public function dispatch($Uri){
        foreach ($this->routes as $Route) {
            var_dump($Route['path']);die;
        if($Route['path'] === $Uri){
      $controllerClass = "\App\Controllers\ " . $Route['Controller'] ;
      $Action = $Route['Action'];

            if(file_exists($controllerClass) && method_exists($controllerClass,$Action)){
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

}


?>