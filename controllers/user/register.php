<?php

require_once '/../../framework/config.php';
require_once ROOT_PATH . '/models/User.php';
require_once ROOT_PATH . '/views/user/RegisterView.php';

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
    $view = new RegisterUserView($_POST, $response);
    $view->buildUI();
}
