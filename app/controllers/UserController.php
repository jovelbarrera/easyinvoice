<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\User;
use app\models\Role;
use app\models\UserRole;
use app\helpers\UIHelper;

class UserController extends Controller {

    const USER_INFO_QUERY = "SELECT username, email, firstname, lastname, user.id AS id, role.id AS role_id, role.name AS role_name FROM user, user_role, role WHERE user.id = user_role.user and user_role.role = role.id";

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Usuarios";
        $response = User::getInstance()->readQuery(self::USER_INFO_QUERY);
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "user/index", $data);
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de usuarios";

        $data['roles'] = Role::getInstance()->read();

        if ($this->isPostRequest()) {
            $user_data = array();
            foreach ($this->post as $key => $value) {
                if ($key == "role") {
                    $role = $value;
                } else {
                    $user_data[$key] = $value;
                }
            }
            $response = User::getInstance()->create($user_data);
            if (isset($response['error'])) {
                $data['data'] = $this->post;
                $data['error'] = $response['error'];
                UIHelper::layout($this, "user/create", $data);
            } else {
                $id = $response['id'];
                UserRole::getInstance()->delete(array('id' => $id));
                $user_role_data = array(
                    'user' => $id,
                    'role' => $role,
                );
                UserRole::getInstance()->create($user_role_data);
                header('Location: ' . $data['base_url'] . '/user');
            }
        } else {
            UIHelper::layout($this, "user/create", $data);
        }
    }

    public function detail($id) {
        $response = User::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de usuario";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "user/detail", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar usuario";

        $data['roles'] = Role::getInstance()->read();

        if ($this->isPostRequest()) {
            $user_data = array();
            foreach ($this->post as $key => $value) {
                if ($key == "role") {
                    $role = $value;
                } else {
                    $user_data[$key] = $value;
                }
            }

            $response = User::getInstance()->update($user_data);
            if (isset($response['error'])) {
                $data['data'] = $this->post;
                $data['error'] = $response['error'];
                //UIHelper::layout($this, "user/edit", $data);
            } else {
                $delete_response = UserRole::getInstance()->delete(array('user' => $id));
                if (isset($delete_response['error'])) {
                    print_r($delete_response['error']);
                } else {
                    $user_role_data = array(
                        'user' => $id,
                        'role' => $role,
                    );
                    UserRole::getInstance()->create($user_role_data);
                    header('Location: ' . $data['base_url'] . "/user");
                }
            }
        } else {
            $response = User::getInstance()->readQuery(self::USER_INFO_QUERY . " and user.id = " . $id);

            if (isset($response["error"])) {
                $data['message'] = $response['error'];
            } else {
                $data['data'] = $response[0];
            }

            UIHelper::layout($this, "user/edit", $data);
        }
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar usuario";

        if ($this->isPostRequest()) {
            $response = User::getInstance()->delete(array('id' => $id));
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/user/");
            }
            return;
        }

        $response = User::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "user/delete", $data);
    }

    public function login() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Iniciar sesión";

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

}
