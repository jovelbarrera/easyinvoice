<?php

require_once 'models/User.php';
require_once 'views/RegisterUserView.php';

if (count($_POST) == 0) {
    $login_view = new RegisterUserView(NULL, NULL);
    $login_view->buildUI();
} else {
    $data = array(
        "username" => (string) secure_post('email', ''),
        "email" => (string) secure_post('email', ''),
        "firstname" => (string) secure_post('firstname', ''),
        "lastname" => (string) secure_post('lastname', ''),
        "password" => (string) secure_post('password', ''),
    );
    $response = User::getInstance()->create($data);
    $login_view = new RegisterUserView($_POST, $response);
    $login_view->buildUI();
}
