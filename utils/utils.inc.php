<?php

function secure_post($value, $on_null) {
    if (isset($_POST[$value]))
        return $_POST[$value];
    return $on_null;
}

function secure_file($value) {
    if (isset($_FILES[$value]))
        return $_POST[$value];
    return null;
}

function secure_value($source, $value, $on_null) {
    if (isset($source[$value]))
        return $source[$value];
    return $on_null;
}

function is_valid_name($name) {
    $regex = "/^([ \x{00c0}-\x{01ff}a-zA-Z'\-])+$/u";
    return preg_match($regex, $name);
}

function is_valid_nit($name) {
    $regex = '/^[0-9]{4}-[0-9]{6}-[0-9]{3}-[0-9]{1}$/';
    return preg_match($regex, $name);
}

function is_valid_dui($name) {
    $regex = '/^\d{8}-\d{1}$/';
    return preg_match($regex, $name);
}

function is_valid_date($date) {
    $regex = '/^(((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8])))))$/';
    return preg_match($regex, $date);
}

function is_valid_media($filename) {
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

$mime_types = array(
    'txt' => 'text/plain',
    'htm' => 'text/html',
    'html' => 'text/html',
    'php' => 'text/html',
    'css' => 'text/css',
    'js' => 'application/javascript',
    'json' => 'application/json',
    'xml' => 'application/xml',
    'swf' => 'application/x-shockwave-flash',
    'flv' => 'video/x-flv',
    // images
    'png' => 'image/png',
    'jpe' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpeg',
    'gif' => 'image/gif',
    'bmp' => 'image/bmp',
    'ico' => 'image/vnd.microsoft.icon',
    'tiff' => 'image/tiff',
    'tif' => 'image/tiff',
    'svg' => 'image/svg+xml',
    'svgz' => 'image/svg+xml',
    // archives
    'zip' => 'application/zip',
    'rar' => 'application/x-rar-compressed',
    'exe' => 'application/x-msdownload',
    'msi' => 'application/x-msdownload',
    'cab' => 'application/vnd.ms-cab-compressed',
    // audio/video
    'mp3' => 'audio/mpeg',
    'qt' => 'video/quicktime',
    'mov' => 'video/quicktime',
    // adobe
    'pdf' => 'application/pdf',
    'psd' => 'image/vnd.adobe.photoshop',
    'ai' => 'application/postscript',
    'eps' => 'application/postscript',
    'ps' => 'application/postscript',
    // ms office
    'doc' => 'application/msword',
    'rtf' => 'application/rtf',
    'xls' => 'application/vnd.ms-excel',
    'ppt' => 'application/vnd.ms-powerpoint',
    // open office
    'odt' => 'application/vnd.oasis.opendocument.text',
    'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
);
