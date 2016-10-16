<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';

session_start();
session_destroy();
unset($_SESSION);
header('Location: ' . DOMAIN_NAME . '/index.php');
