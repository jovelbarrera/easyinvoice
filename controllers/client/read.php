<?php

require_once '/../../models/Client.php';
require_once '/../../views/client/ReadView.php';

$response = Client::getInstance()->readAll();
$view = new ReadView($response);
$view->buildUI();

