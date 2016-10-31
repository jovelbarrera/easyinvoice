<?php

namespace framework;

use framework\Routes;
use framework\Config;

//require_once (__DIR__ . '/loader.php');
/* require_once ('Config.php');
  require_once ('Routes.php');
 */

final class Dispatcher {

    function handle($controller, $action, $parameters) {
        $routes_instance = new Routes();
        $routes = $routes_instance->routes;
        $route_name = $controller . "/" . $action;
        $route_exist = array_key_exists($route_name, $routes);

        $config = new Config();
        
        if ($route_exist) {
            if (count($parameters) >= count($routes[$route_name])) {
                $class_name = 'app\controllers\\' . ucfirst($controller) . "Controller";
                $class = new \ReflectionClass($class_name);
                $reflectionMethod = new \ReflectionMethod($class_name, $action);
                $reflectionMethod->invokeArgs($class->newInstanceArgs(), $parameters);
            } else {
                require_once($config->config['app']['framework_path'] . "/pages/notfound.php");
//                echo file_get_contents($config->config['app']['framework_path'] . "/pages/notfound.php");
            }
        } else {
            require_once($config->config['app']['framework_path'] . "/pages/notfound.php");
//            echo file_get_contents($config->config['app']['framework_path'] . "/pages/notfound.php");
        }
    }

}
