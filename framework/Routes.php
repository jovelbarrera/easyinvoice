<?php

namespace framework;

class Routes {

    var $routes = array();

    function __construct() {
        $this->routes["home/index"] = array();

        $this->routes["client/index"] = array();
        $this->routes["client/create"] = array();
        $this->routes["client/edit"] = array("id");
        $this->routes["client/detail"] = array("id");
        $this->routes["client/delete"] = array("id");

        $this->routes["permission/index"] = array();
        $this->routes["permission/create"] = array();
        $this->routes["permission/edit"] = array("id");
        $this->routes["permission/detail"] = array("id");
        $this->routes["permission/delete"] = array();

        $this->routes["role/index"] = array();
        $this->routes["role/create"] = array();
        $this->routes["role/edit"] = array("id");
        $this->routes["role/detail"] = array("id");
        $this->routes["role/delete"] = array("id");
        $this->routes["role/assign"] = array("role_id");

        $this->routes["user/index"] = array();
        $this->routes["user/create"] = array();
        $this->routes["user/edit"] = array("id");
        $this->routes["user/detail"] = array("id");
        $this->routes["user/delete"] = array("id");
        $this->routes["user/login"] = array();

        $this->routes["tax/index"] = array();
        $this->routes["tax/create"] = array();
        $this->routes["tax/edit"] = array("id");
        $this->routes["tax/detail"] = array("id");
        $this->routes["tax/delete"] = array("id");

        $this->routes["product/index"] = array();
        $this->routes["product/create"] = array();
        $this->routes["product/edit"] = array("id");
        $this->routes["product/detail"] = array("id");
        $this->routes["product/delete"] = array("id");

        $this->routes["payment/index"] = array();
        $this->routes["payment/create"] = array();
        $this->routes["payment/edit"] = array("id");
        $this->routes["payment/detail"] = array("id");
        $this->routes["payment/delete"] = array("id");

        $this->routes["invoice/index"] = array();
        $this->routes["invoice/create"] = array();
        $this->routes["invoice/edit"] = array("id");
        $this->routes["invoice/detail"] = array("id");
        $this->routes["invoice/delete"] = array("id");
    }

}
