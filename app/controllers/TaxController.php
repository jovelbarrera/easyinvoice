<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Tax;
use app\helpers\UIHelper;

class TaxController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Impuestos";
        $response = Tax::getInstance()->read();
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "tax/index", $data);
    }

    public function detail($id) {
        $response = Tax::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de impuesto";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "tax/detail", $data);
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Nuevo impuesto";

        if ($this->isPostRequest()) {
            $response = Tax::getInstance()->create($this->post);
            if (isset($response['id'])) {
                //header("Location: " . $data['base_url'] . "/tax/detail/" . $response['id']);
                $this->detail($response['id']);
            }
            return;
        }

        UIHelper::layout($this, "tax/create", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar impuesto";

        if ($this->isPostRequest()) {
            $response = Tax::getInstance()->update($this->post);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/tax/");
            }
            return;
        }

        $response = Tax::getInstance()->read(NULL, array("id" => $id));

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "tax/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de impuesto";

        if ($this->isPostRequest()) {
            $response = Tax::getInstance()->delete(array('id' => $id));
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/tax/");
            }
            return;
        }

        $response = Tax::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "tax/delete", $data);
    }

}
