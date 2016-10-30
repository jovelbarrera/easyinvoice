<?php

namespace framework;

final class Config {

    var $config = array();

    function __construct() {
        $this->config["enviroment"] = "test";

        $app["test"] = array(
            "application_name" => "Invoice Maker",
            "domain_name" => "http://localhost/easyinvoice",
            "root_path" => $_SERVER['DOCUMENT_ROOT'] . "/easyinvoice",
            "application_path" => $_SERVER['DOCUMENT_ROOT'] . "/easyinvoice/app",
            "framework_path" => $_SERVER['DOCUMENT_ROOT'] . "/easyinvoice/framework",
        );

        $app["production"] = array(
            "application_name" => "Invoice Maker",
            "domain_name" => "http://ec2-52-53-212-9.us-west-1.compute.amazonaws.com/easyinvoice",
            "root_path" => $_SERVER['DOCUMENT_ROOT'] . "/easyinvoice",
            "application_path" => $_SERVER['DOCUMENT_ROOT'] . "/easyinvoice/app",
            "framework_path" => $_SERVER['DOCUMENT_ROOT'] . "/easyinvoice/framework",
        );

        $db['test'] = array(
            "hostname" => "localhost",
            "username" => "phpmyadmin",
            "password" => "root",
            "database" => "easyinvoice",
        );

        $db['production'] = array(
            "hostname" => "localhost",
            "username" => "phpmyadmin",
            "password" => "root",
            "database" => "easyinvoice",
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
