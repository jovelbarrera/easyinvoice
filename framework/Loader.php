<?php

namespace framework;

spl_autoload_register(function ($class_name) {
    try {
        $class_name = ltrim($class_name, '\\');
        $file_name = '';
        $namespace = '';
        if ($lastNsPos = strrpos($class_name, '\\')) {
            $namespace = substr($class_name, 0, $lastNsPos);
            $class_name = substr($class_name, $lastNsPos + 1);
            $file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
//        $file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
        $file_name .= $class_name . '.php';

        $full_path = $_SERVER['DOCUMENT_ROOT'] . '/easyinvoice/' . $file_name;
//        echo $full_path." existe:".file_exists($full_path)."- ";
        require_once ($full_path);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
});
