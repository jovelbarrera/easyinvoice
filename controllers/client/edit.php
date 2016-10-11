<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
require_once ROOT_PATH . '/utils/utils.inc.php';
require_once ROOT_PATH . '/views/client/EditView.php';
session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: ' . DOMAIN_NAME . '/utils/forbidden.php');
}

if (isset($_GET["id"])) {
    $data = Client::getInstance()->read("id = " . $_GET["id"]);

    if (isset($data['error'])) {
        $view = new EditView(NULL, $data);
    } else {
        $view = new EditView($data[0], NULL);
    }
    $view->buildUI();
} else if (count($_POST) == 0) {
    $view = new EditView(NULL, NULL);
    $view->buildUI();
} else {
    $data = array(
        "name" => (string) secure_post('name', ''),
        "nit" => (string) secure_post('nit', ''),
        "address" => (string) secure_post('address', ''),
        "phone" => (string) secure_post('phone', ''),
    );
    print_r($data);
    
    if (isset($_POST['id']) and $_POST['id'] === '') {
        $response = Client::getInstance()->create($data);
        echo 'create';
    } else {
        $data['id'] = $_POST['id'];
        $response = Client::getInstance()->update($data);
        echo 'update';
    }

    header('Location: read.php');
}
