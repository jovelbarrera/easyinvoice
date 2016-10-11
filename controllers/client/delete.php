<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
require_once ROOT_PATH . '/models/Client.php';
require_once ROOT_PATH . '/views/client/ReadView.php';

session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: ' . DOMAIN_NAME . '/utils/forbidden.php');
}

if (!isset($_SESSION['logged'])) {
    header('Location: '.ROOT_PATH.'/utils/forbidden.php');
}

if (isset($_GET["id"])) {
    $response = Client::getInstance()->delete(" id = " . $_GET["id"]);
    $data = Client::getInstance()->readAll();
    header('Location: read.php');
}

