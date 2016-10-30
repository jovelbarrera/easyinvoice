<?php

namespace app\models;

use \framework\core\Model;

final class User extends Model {

    private static $instance;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    protected function __construct() {
        parent::__construct();
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }

    function getTable() {
        return "user";
    }

    function get_user_by_credentials($data) {
        $fields = array(
            "username",
            "email",
            "firstname",
            "lastname",
            "created_at",
            "updated_at"
        );
        $where = array(
            "username" => $data['username'],
            "password" => md5($data['password'])
        );
        $result = $this->read($fields, $where);

        return $result;
    }

    function user_already_exist($username) {
        $result = parent::read(NULL, array('username' => $username));
        return (boolean) !isset($result['error']);
    }

    function create($data) {

        $data['username'] = $data['email'];
        if ($this->user_already_exist($data['username'])) {
            return array(
                "error" => "Ya existe un usuario con este correo electrónico."
            );
        }
        $data['password'] = md5($data['password']);
        $response = parent::create($data);
        return $response;
    }

    /* const TABLE = "client";
      const CREATE_QUERY = "INSERT INTO user (username, email, firstname, lastname, password) VALUES ('%s','%s','%s','%s','%s')";
      const READ_QUERY = "SELECT userid, nombres, apellidos, idgrupo, estado FROM usuarios";
      const DELETE_QUERY = "DELETE FROM user WHERE username = '%s'";
      const WHERE_QUERY = "SELECT username, email, firstname, lastname, created_at, updated_at FROM user WHERE %s";
      const UPDATE_QUERY = "SELECT username, email, firstname, lastname, created_at, updated_at FROM user WHERE %s";

      private static $instance;

      public static function getInstance() {
      if (null === self::$instance) {
      self::$instance = new static();
      }

      return self::$instance;
      }

      function get_user_by_credentials($data) {
      $this->openConnection();
      $query = sprintf("SELECT username, email, firstname, lastname, created_at, updated_at FROM user WHERE username ='%s' AND password = '%s'", mysqli_real_escape_string($this->link, $data['username']), md5($data['password']));
      $result = $this->link->query($query);

      $user = array();
      if ($result->num_rows == 1) {
      while ($row = $result->fetch_assoc()) {
      $user = $row;
      }
      session_start();
      $_SESSION['logged'] = TRUE;
      } else {
      $user = array(
      "error" => "El usuario o contraseña no son validos",
      );
      }
      $this->closeConection();
      return $user;
      }

      function user_already_exist($username) {
      $this->openConnection();
      $query = sprintf("SELECT username FROM user WHERE username ='%s'", mysqli_real_escape_string($this->link, $username));

      $result = $this->link->query($query);

      $user_exist = (boolean) $result->num_rows == 1;

      $this->closeConection();
      return $user_exist;
      }

      function create($data) {
      if ($this->user_already_exist($data['username'])) {
      return array(
      "error" => "Ya existe un usuario con este correo electrónico."
      );
      }
      $this->openConnection();
      $query = sprintf(self::CREATE_QUERY, mysqli_real_escape_string($this->link, $data['username']), mysqli_real_escape_string($this->link, $data['email']), mysqli_real_escape_string($this->link, $data['firstname']), mysqli_real_escape_string($this->link, $data['lastname']), md5($data['password']));

      if ($this->link->query($query) === TRUE) {
      $response = array(
      "success" => "Usuario registrado exitosamente"
      );
      } else {
      $response = array(
      "error" => "Ocurrio un error inesperado."
      );
      }
      $this->closeConection();
      return $response;
      }

      public function getCreateQuery($fields, $values) {
      return sprintf("INSERT INTO %s (%s) VALUES (%s)", self::TABLE, $fields, $values);
      }

      public function getReadQuery($where) {
      if ($where == NULL) {
      return sprintf("SELECT * FROM %s", self::TABLE);
      } else {
      return sprintf("SELECT * FROM %s WHERE %s", self::TABLE, $where);
      }
      }

      public function getUpdateQuery($fields, $values) {
      return sprintf("REPLACE INTO %s (%s) VALUES (%s)", self::TABLE, $fields, $values);
      }

      public function getDeleteQuery($where) {
      return sprintf("DELETE FROM %s WHERE %s", self::TABLE, $where);
      } */

    /**
     * Model implementation
     */
    /* function create($data) {
      if ($this->user_already_exist($data['username'])) {
      return array(
      "error" => "Ya existe un usuario con este correo electrónico."
      );
      }
      $this->open_connection();
      $query = sprintf(self::CREATE_QUERY, mysqli_real_escape_string($this->link, $data['username']), mysqli_real_escape_string($this->link, $data['email']), mysqli_real_escape_string($this->link, $data['firstname']), mysqli_real_escape_string($this->link, $data['lastname']), md5($data['password']));

      //$a = array_to_mysql($this->link, $data);
      //$query = sprintf("INSERT INTO user (%s) VALUES (%s)", $a['fields'], $a['values']);

      if ($this->link->query($query) === TRUE) {
      $response = array(
      "success" => "Usuario registrado exitosamente"
      );
      } else {
      $response = array(
      "error" => "Ocurrio un error inesperado."
      );
      }
      $this->close_conection();
      return $response;
      }

      function readAll() {
      $this->connect();
      $query = self::READ_QUERY;
      $result = $this->link->query($query);

      $users = array();
      $user = array();

      while ($row = $result->fetch_assoc()) {
      /* $user["userid"] = $row["userid"];
      $user["nombres"] = $row["nombres"];
      $user["apellidos"] = $row["apellidos"];
      $user["idgrupo"] = $row["idgrupo"];
      $user["estado"] = $row["estado"]; */
    /* array_push($users, $row);
      }

      $this->close_conection();
      return $users;
      }

      public function delete($username) {
      $query = sprintf(self::DELETE_QUERY, $username);

      if ($this->link->query($query) === TRUE) {
      $response = array(
      "success" => "Usuario borrado."
      );
      } else {
      $response = array(
      "error" => "Ocurrio un error."
      );
      }
      }

      public function read($where) {
      $this->open_connection();
      $query = sprintf(self::WHERE_QUERY, mysqli_real_escape_string($this->link, $where));
      $result = $this->link->query($query);

      $user = array();
      if ($result->num_rows == 1) {
      while ($row = $result->fetch_assoc()) {
      $user = $row;
      /* $user["username"] = $row["username"];
      $user["email"] = $row["email"];
      $user["firstname"] = $row["firstname"];
      $user["lastname"] = $row["lastname"];
      $user["created_at"] = $row["created_at"];
      $user["updated_at"] = $row["updated_at"]; */
    /* }
      }
      $this->close_conection();
      return $user;
      }

      public function update($data) {
      $query = sprintf(self::UPDATE_QUERY, $username);
      "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

      if ($this->link->query($query) === TRUE) {
      $response = array(
      "success" => "Usuario actualizado."
      );
      } else {
      $response = array(
      "error" => "Ocurrio un error."
      );
      }
      } */
}

?>
