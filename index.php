<?php

//use framework\Dispatcher;
echo $_SERVER['DOCUMENT_ROOT'];
require_once ('/framework/loader.php');
//require_once (__DIR__ . '/framework/loader.php');
//require_once (__DIR__ . '/framework/Dispatcher.php');

$controller = isset($_GET['controller']) ? $_GET['controller'] : "home";
$action = isset($_GET['action']) ? $_GET['action'] : "index";
$raw_parameters = isset($_GET['parameters']) ? $_GET['parameters'] : "";
$parameters = $raw_parameters == "" ? array() : explode("/", $raw_parameters);
print_r($controller);
print_r($action);
print_r($parameters);
$dispatcher = new Dispatcher();
$dispatcher->handle($controller, $action, $parameters);
