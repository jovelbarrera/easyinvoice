<?php

spl_autoload_register(function ($class_name) {
    try {
        echo $class_name;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            spl_autoload($class_name);
        } else {
            spl_autoload(strtolower(str_replace("\\", "/", $class_name)));
        }
    } catch (Exception $ex) {
        //echo $ex->getMessage();
        echo 'spl_autoload_register';
    }
});
