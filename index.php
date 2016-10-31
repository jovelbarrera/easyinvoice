<?php

require_once (__DIR__ . '/framework/Loader.php');

use framework\Dispatcher;

$controller = (isset($_GET['controller']) and $_GET['controller'] != "index.php") ? $_GET['controller'] : "home";
$action = isset($_GET['action']) ? $_GET['action'] : "index";
$raw_parameters = isset($_GET['parameters']) ? $_GET['parameters'] : "";
$parameters = $raw_parameters == "" ? array() : explode("/", $raw_parameters);

$dispatcher = new Dispatcher();
$dispatcher->handle($controller, $action, $parameters);
