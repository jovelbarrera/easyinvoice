<?php

namespace framework;

class routes {

    var $routes = array();

    function __construct() {
        $this->routes["client/index"] = array();
        $this->routes["client/create"] = array();
        $this->routes["client/edit"] = array("id");
        $this->routes["client/detail"] = array("id");
        $this->routes["client/delete"] = array();
    }

}
