<?php

final class Helper {

    final static function getPostSecurely($value, $on_null) {
        if (isset($_POST[$value]))
            return $_POST[$value];
        return $on_null;
    }

    final static function getFileSecurely($value) {
        if (isset($_FILES[$value]))
            return $_POST[$value];
        return null;
    }

    final static function getValueSecurely($source, $value, $on_null) {
        if (isset($source[$value]))
            return $source[$value];
        return $on_null;
    }

    final static function isValidName($name) {
        $regex = "/^([ \x{00c0}-\x{01ff}a-zA-Z'\-])+$/u";
        return preg_match($regex, $name);
    }

    final static function isValidNit($name) {
        $regex = '/^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}$/';
        return preg_match($regex, $name);
    }

    final static function isValidDui($name) {
        $regex = '/^\d{8}-\d{1}$/';
        return preg_match($regex, $name);
    }

    final static function isValidDate($date) {
        $regex = '/^(((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8])))))$/';
        return preg_match($regex, $date);
    }

    final static function isValidFile($filename) {
        $array_ext_permitidos = [];


        $trozos = explode(".", $filename);
        $extension = end($trozos);
//$array_ext_permitidos = ['png', 'jpe', 'jpeg', 'jpg', 'gif', 'bmp', 'ico', 'tiff', 'tif', 'svg', 'svgz', 'mp3', 'qt', 'mov'];
        $array_ext_permitidos = ['txt'];
        if (in_array($extension, $array_ext_permitidos)):
            return true;
        else:
            return false;
        endif;
    }

}
