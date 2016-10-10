<?php

require_once 'views/LoginView.php';

$login_view = new LoginView($_GET, $_POST, $_FILES);
$login_view->buildUI();
