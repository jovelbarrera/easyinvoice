<?php

//namespace framework;

use framework\Config;
use framework\Routes;

//require_once (__DIR__ . '/loader.php');
/* require_once ('Config.php');
  require_once ('Routes.php');
 */

final class Dispatcher {

    function handle($controller, $action, $parameters) {
        print_r($controller);
        $routes_instance = new Routes();
         print_r($action);
        $routes = $routes_instance->routes;
        print_r($parameters);
        $route_name = $controller . "/" . $action;
        $route_exist = array_key_exists($route_name, $routes);
        
        if ($route_exist) {
            if (count($parameters) >= count($routes[$route_name])) {
                $class_name = 'app\controllers\\' . ucfirst($controller) . "Controller";
                $class = new ReflectionClass($class_name);
                $reflectionMethod = new ReflectionMethod($class_name, $action);
                $reflectionMethod->invokeArgs($class->newInstanceArgs(), $parameters);
            }
        }
    }

}
