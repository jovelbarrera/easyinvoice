<?php

require_once '/../../models/Client.php';
require_once '/../../views/client/ReadView.php';

if (isset($_GET["id"])) {
    $response = Client::getInstance()->delete(" id = " . $_GET["id"]);
    $data = Client::getInstance()->readAll();
    header('Location: read.php');
}

