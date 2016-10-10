<?php

require_once '/../../models/Client.php';
require_once '/../../views/client/EditView.php';

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

    if (isset($_POST['id']) and $_POST['id'] === '') {
        $response = Client::getInstance()->create($data);
    } else {
        $data['id'] = $_POST['id'];
        $response = Client::getInstance()->update($data);
    }

    header('Location: read.php');
}
