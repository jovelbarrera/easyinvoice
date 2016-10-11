<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
require_once ROOT_PATH . '/utils/utils.inc.php';
require_once ROOT_PATH . '/views/user/LoginView.php';
require_once ROOT_PATH . '/models/User.php';

/*if (count($_POST) == 0) {
    $view = new LoginView(NULL);
    $view->buildUI();
} else {
    $data = array(
        "username" => (string) secure_post('username', ''),
        "password" => (string) secure_post('password', ''),
    );

    $response = User::getInstance()->get_user_by_credentials($data);
    if (isset($response['error'])) {
        $view = new LoginView($response);
        $view->buildUI();
    } else {
        header('Location: ' . DOMAIN_NAME . '/index.php');
    }
}*/

echo ROOT_PATH . '/utils/utils.inc.php';

