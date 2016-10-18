<?php

namespace framework;

spl_autoload_register(function ($class_name) {
    try {

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $file_name = "\\" . $class_name;
        } else {
            $class_name = ltrim($class_name, '\\');
            $file_name = '';
            $namespace = '';
            if ($lastNsPos = strrpos($class_name, '\\')) {
                $namespace = substr($class_name, 0, $lastNsPos);
                $class_name = substr($class_name, $lastNsPos + 1);
                $file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $file_name .= str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
        }
        echo $_SERVER['DOCUMENT_ROOT'] . '/easyinvoice/' .$file_name;
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/easyinvoice/' . $file_name);
    } catch (Exception $ex) {
        //echo $ex->getMessage();
        echo 'spl_autoload_register';
    }
});
