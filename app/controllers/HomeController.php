<?php

namespace app\controllers;

use framework\core\Controller;
use app\helpers\UIHelper;

class HomeController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Easy invoice";
        
        UIHelper::layout($this, "home/index", $data);
    }
}
