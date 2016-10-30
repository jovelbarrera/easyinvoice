<?php

namespace framework;

class Routes {

    var $routes = array();

    function __construct() {
        $this->routes["client/index"] = array();
        $this->routes["client/create"] = array();
        $this->routes["client/edit"] = array("id");
        $this->routes["client/detail"] = array("id");
        $this->routes["client/delete"] = array();
        
        
        $this->routes["permission/index"] = array();
        $this->routes["permission/create"] = array();
        $this->routes["permission/edit"] = array("id");
        $this->routes["permission/detail"] = array("id");
        $this->routes["permission/delete"] = array();
        
        $this->routes["role/index"] = array();
        $this->routes["role/create"] = array();
        $this->routes["role/edit"] = array("id");
        $this->routes["role/detail"] = array("id");
        $this->routes["role/delete"] = array();        
        $this->routes["role/assign"] = array("role_id");
        
        $this->routes["user/index"] = array();
        $this->routes["user/login"] = array();
        $this->routes["user/create"] = array();
    }

}
