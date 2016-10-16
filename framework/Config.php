<?php

namespace framework;

final class Config {

    var $config = array();

    function __construct() {
        $this->config["enviroment"] = "test";

        $app["test"] = array(
            "application_name" => "Invoice Maker",
            "domain_name" => "http://localhost/invoicemaker",
            "root_path" => $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker",
            "application_path" => $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker/app",
            "framework_path" => $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker/framework",
        );

        $app["production"] = array(
            "application_name" => "Invoice Maker",
            //"domain_name" => "http://ec2-52-53-212-9.us-west-1.compute.amazonaws.com/invoicemaker",
            "domain_name" => "https://easyinvoice.herokuapp.com",
            "root_path" => $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker",
            "application_path" => $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker/app",
            "framework_path" => $_SERVER['DOCUMENT_ROOT'] . "/invoicemaker/framework",
        );

        $db['test'] = array(
            "hostname" => "localhost",
            "username" => "root",
            "password" => "",
            "database" => "invoicemaker",
        );

        $db['production'] = array(
            "hostname" => "localhost",
            "username" => "phpmyadmin",
            "password" => "root",
            "database" => "invoicemaker",
        );

        if ($this->config["enviroment"] == "production") {
            $this->config["app"] = $app["production"];
            $this->config["db"] = $db["production"];
        } else if ($this->config["enviroment"] == "test") {
            $this->config["app"] = $app["test"];
            $this->config["db"] = $db["test"];
        }
    }

}
