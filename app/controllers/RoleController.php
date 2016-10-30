<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Role;
use app\models\Permission;
use app\models\RolePermission;
use app\helpers\UIHelper;

class RoleController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de Roles";
        $response = Role::getInstance()->read();
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "settings/role/index", $data);
    }

    public function detail($id) {
        $response = Role::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de Rol";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "settings/role/detail", $data);
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Crear Rol";

        if ($this->isPostRequest()) {
            $response = Role::getInstance()->create($this->post);
            if (isset($response['id'])) {
                $this->detail($response['id']);
            }
            return;
        }

        UIHelper::layout($this, "settings/role/create", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar Rol";

        if ($this->isPostRequest()) {
            $response = Role::getInstance()->update($this->post);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/role/");
            }
            return;
        }

        $response = Role::getInstance()->read(NULL, array("id" => $id));

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "settings/role/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de Rol";

        if ($this->isPostRequest()) {
            $response = Role::getInstance()->delete(array('id' => $id));
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/role/");
            }
            return;
        }

        $response = Role::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "settings/role/delete", $data);
    }

    public function assign($role_id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Permisos";

        if ($this->isPostRequest()) {
            RolePermission::getInstance()->delete(array('role' => $role_id));
            foreach ($this->post as $permission => $value) {
                $role_permission = array(
                    "role" => $role_id,
                    "permission" => $permission
                );
                RolePermission::getInstance()->create($role_permission);
            }
//            $granted_permissions = RolePermission::getInstance()->read(NULL, array("role" => (int) $role_id));
//            echo '<pre>';
//            print_r($this->post);
//            print_r($granted_permissions);
//            echo '</pre>';
            //$response = Role::getInstance()->update($this->post);
//            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/role/");
//            }
            return;
        }

        $role = Role::getInstance()->read(NULL, array('id' => $role_id));

        $data['data'] = array();
        if (isset($role['error'])) {
            $data['error'] = 'Rol no existe';
        } else {
            $query = "SELECT role.id AS role_id, role.name AS role_name, permission.id AS permission_id, permission.name AS permission_name "
                    . "FROM role_permission, role, permission "
                    . "WHERE role = role.id and permission = permission.id";
            $permissions = Permission::getInstance()->read();
            $granted_permissions = RolePermission::getInstance()->read(NULL, array("role" => (int) $role_id));

            $data['data']['role'] = $role[0];
            $data['data']['permissions'] = $permissions;
            $data['data']['granted_permissions'] = $granted_permissions;
        }
        UIHelper::layout($this, "settings/role/assign", $data);
//        echo '<pre>';
//        print_r($role);
//        print_r($permissions);
//        print_r($granted_permissions);
//        echo '</pre>';
    }

}
