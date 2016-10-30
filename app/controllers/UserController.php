<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\User;
use app\helpers\UIHelper;

class UserController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de usuarios";
        $response = Client::getInstance()->read();
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "client/index", $data);
    }

    public function login() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de usuarios";

        if ($this->isPostRequest()) {
            $response = User::getInstance()->get_user_by_credentials($this->post);
            print_r($response);
            if (isset($response['error'])) {
                $data['error'] = $response['error'];
                UIHelper::layout($this, "user/login", $data);
            } else {
                header('Location: ' . $data['base_url']);
            }
        } else {
            UIHelper::layout($this, "user/login", $data);
        }
    }

    public function logout() {
        
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de usuarios";

        if ($this->isPostRequest()) {
            $response = User::getInstance()->create($this->post);
            if (isset($response['error'])) {
                $data['data']= $this->post;
                $data['error'] = $response['error'];
                UIHelper::layout($this, "user/create", $data);
            } else {
                header('Location: ' . $data['base_url']);
            }
        } else {
            UIHelper::layout($this, "user/create", $data);
        }
    }

}
