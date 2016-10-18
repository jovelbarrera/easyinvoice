<?php

require_once (__DIR__ . '/framework/loader.php');

use framework\dispatcher;
//require_once (__DIR__ . '/framework/loader.php');
//require_once (__DIR__ . '/framework/Dispatcher.php');

$controller = isset($_GET['controller']) ? $_GET['controller'] : "home";
$action = isset($_GET['action']) ? $_GET['action'] : "index";
$raw_parameters = isset($_GET['parameters']) ? $_GET['parameters'] : "";
$parameters = $raw_parameters == "" ? array() : explode("/", $raw_parameters);

$dispatcher = new dispatcher();
$dispatcher->handle($controller, $action, $parameters);
