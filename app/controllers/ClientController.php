<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Client;

/* require_once (__DIR__ . '/../../framework/core/Controller.php');
  require_once (__DIR__ . '/../models/Client.php');
  require_once (__DIR__ . '/../services/ClientService.php');
  require_once (__DIR__ . '/../views/client/Read.php');
  require_once (__DIR__ . '/../views/client/Create.php');
 */

class ClientController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de usuarios";
        $response = Client::getInstance()->readAll();
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        }  else {
            $data['data'] = $response;
        }
        $this->layout("client/index", $data);
    }

    public function detail($id) {
        $response = Client::getInstance()->read("id = " . $id);

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de usuario";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        $this->layout("client/detail", $data);
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

        $this->layout("client/create", $data);
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

        $response = Client::getInstance()->read("id = " . $id);

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        $this->layout("client/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de usuario";

        if ($this->isPostRequest()) {
            $response = Client::getInstance()->delete($id);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/client/");
            }
            return;
        }

        $response = Client::getInstance()->read("id = " . $id);

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        $this->layout("client/delete", $data);
    }

    private function layout($view, $data) {
        $this->view("layout/header", $data);
        $this->view("layout/menu", $data);
        $this->view($view, $data);
        $this->view("layout/footer", $data);
    }

}
