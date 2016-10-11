<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
//echo 'Location: ' . DOMAIN_NAME . '/controllers/user/login.php';
session_start();
if (isset($_SESSION['logged'])) {
    header('Location: ' . DOMAIN_NAME . '/controllers/client/read.php');
} else {
    header('Location: ' . DOMAIN_NAME . '/controllers/user/login.php');
}
