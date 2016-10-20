<?php

namespace framework;

require_once (__DIR__ . '/Config.php');

spl_autoload_register(function ($class) {
    try {
        $class_path = ltrim($class, '\\');
        $file_name = '';
        $namespace = '';
        if ($lastNsPos = strrpos($class_path, '\\')) {
            $namespace = substr($class_path, 0, $lastNsPos);
            $class_path = substr($class_path, $lastNsPos + 1);
            $file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $file_name .= $class_path . '.php';

        $config = new Config();
        $root_path = $config->config['app']['root_path'] . "/";
        $full_path = $root_path . $file_name;

//        $full_path = $_SERVER['DOCUMENT_ROOT'] . '/easyinvoice/' . $file_name;

        require_once ($full_path);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
});
