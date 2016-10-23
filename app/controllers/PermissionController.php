<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Permission;
use app\helpers\UIHelper;

class PermissionController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de Permisos";
        $response = Permission::getInstance()->read();
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "settings/permission/index", $data);
    }

    public function detail($id) {
        $response = Permission::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de Permiso";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "settings/permission/detail", $data);
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Crear Permiso";

        if ($this->isPostRequest()) {
            $response = Permission::getInstance()->create($this->post);
            if (isset($response['id'])) {
                $this->detail($response['id']);
            }
            return;
        }

        UIHelper::layout($this, "settings/permission/create", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar Permiso";

        if ($this->isPostRequest()) {
            $response = Permission::getInstance()->update($this->post);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/permission/");
            }
            return;
        }

        $response = Permission::getInstance()->read(NULL, array("id" => $id));

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "settings/permission/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de Permiso";

        if ($this->isPostRequest()) {
            $response = Permission::getInstance()->delete($id);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/permission/");
            }
            return;
        }

        $response = Permission::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "settings/permission/delete", $data);
    }

}
