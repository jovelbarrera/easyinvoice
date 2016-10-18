<?php

spl_autoload_register(function ($class_name) {
    try {

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $include = $class_name;
        } else {
            $include = __DIR__ . "/" . strtolower(str_replace("\\", "/", $class_name));
        }
        echo PHP_OS;
        echo '<br>';
        echo $include;
        spl_autoload($include);
    } catch (Exception $ex) {
        //echo $ex->getMessage();
        echo 'spl_autoload_register';
    }
});
