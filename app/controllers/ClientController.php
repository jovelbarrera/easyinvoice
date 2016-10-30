<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Client;
use app\helpers\UIHelper;

class ClientController extends Controller {

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

    public function detail($id) {
        $response = Client::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de usuario";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "client/detail", $data);
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Crear usuario";

        if ($this->isPostRequest()) {
            $response = Client::getInstance()->create($this->post);
            if (isset($response['id'])) {
                //header("Location: " . $data['base_url'] . "/client/detail/" . $response['id']);
                $this->detail($response['id']);
            }
            return;
        }

        UIHelper::layout($this, "client/create", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar usuario";

        if ($this->isPostRequest()) {
            $response = Client::getInstance()->update($this->post);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/client/");
            }
            return;
        }

        $response = Client::getInstance()->read(NULL, array("id" => $id));

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "client/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de usuario";

        if ($this->isPostRequest()) {
            $response = Client::getInstance()->delete(array('id' => $id));
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/client/");
            }
            return;
        }

        $response = Client::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "client/delete", $data);
    }

}
