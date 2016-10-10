<?php

require_once 'models/User.php';
require_once 'views/LoginView.php';
$data = array(
    "username" => (string) "ernesto@mail.com",
    "email" => (string) "ernesto@mail.com",
    "firstname" => (string) "RE",
    "lastname" => (string) "50",
    "password" => (string) md5("12345678"),
);
$response = User::getInstance()->create($data);
print_r($response);
//$login_view = new LoginView($_GET, $_POST, $_FILES);
//$login_view->buildUI();
