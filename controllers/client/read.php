<?php

require_once '/../../framework/config.php';
require_once ROOT_PATH . '/models/Client.php';
require_once ROOT_PATH . '/views/client/ReadView.php';

session_start();

if (!isset($_SESSION['logged'])) {
    header('Location: ' . DOMAIN_NAME . '/utils/forbidden.php');
}

$response = Client::getInstance()->readAll();
$view = new ReadView($response);
$view->buildUI();

