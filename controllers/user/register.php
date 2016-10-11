<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
require_once ROOT_PATH . '/models/User.php';
require_once ROOT_PATH . '/views/user/RegisterView.php';

session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: ' . DOMAIN_NAME . '/utils/forbidden.php');
}

if (count($_POST) == 0) {
    $view = new RegisterUserView(NULL, NULL);
    $view->buildUI();
} else {
    $data = array(
        "username" => (string) secure_post('email', ''),
        "email" => (string) secure_post('email', ''),
        "firstname" => (string) secure_post('firstname', ''),
        "lastname" => (string) secure_post('lastname', ''),
        "password" => (string) secure_post('password', ''),
    );
    $response = User::getInstance()->create($data);
    if (isset($response['error'])) {
        $view = new RegisterUserView($_POST, $response);
        $view->buildUI();
    } else {
        header('Location: ' . DOMAIN_NAME);
    }
}
