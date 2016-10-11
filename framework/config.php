<?php

$enviroment = "production";

if ($enviroment == "production") {
// Global settings
    define("APPLICATION_NAME", "Invoice Maker");
    define("DOMAIN_NAME", "http://localhost/invoicemaker");
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker");
    define("FRAMEWORK_PATH", ROOT_PATH . "/framework");

// Database settings
    define("DB_SERVERNAME", "localhost");
    define("DB_USERNAME", "phpmyadmin");
    define("DB_PASSWORD", "root");
    define("DB_DATABASE", "invoicemaker");
} else {
// Global settings
    define("APPLICATION_NAME", "Invoice Maker");
    define("DOMAIN_NAME", "http://localhost/invoicemaker");
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker");
    define("FRAMEWORK_PATH", ROOT_PATH . "/framework");

// Database settings
    define("DB_SERVERNAME", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_DATABASE", "invoicemaker");
}
