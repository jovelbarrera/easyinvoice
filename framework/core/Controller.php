<?php

namespace framework\core;

use framework\Config;
use framework\core\IController;

/* require_once (__DIR__ . '/../Config.php');
  require_once ('IController.php');
 */

abstract class Controller implements IController {

    var $config = array();
    var $get = array();
    var $post = array();
    private $helpers = array();

    function __construct() {
        $config = new Config();
        $this->config = $config->config;
        $this->get = isset($_GET['parameters']) ? $_GET['parameters'] : array();
        $this->post = isset($_POST) ? $_POST : array();
    }

    abstract function index();

    function view($view, $data = NULL) {
        foreach ($this->helpers as $helper) {
            require_once ($this->config['app']['application_path'] . '/helpers/' . $helper . ".php");
        }
        require_once ($this->config['app']['application_path'] . '/views/' . $view . ".php");
    }

    function loadHelper($helper) {
        array_push($this->helpers, $helper);
    }

    function isPostRequest() {
        return count($this->post) > 0;
    }

}
