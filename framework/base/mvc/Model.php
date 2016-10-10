<?php

require_once FRAMEWORK_PATH . '/base/interfaces/IModel.php';

abstract class Model implements IModel {

    protected $link;

    public function open_connection() {
        $this->link = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if ($this->link->connect_error) {
            die("Connection failed: " . $this->link->connect_error);
        }
    }

    public function close_conection() {
        $this->link->close();
    }

    abstract public function getCreateQuery($fields, $values);

    abstract public function getReadQuery($where);

    abstract public function getUpdateQuery($set, $where);

    abstract public function getDeleteQuery($where);

    public function create($data) {
        $this->open_connection();
        $sql_data = array_to_mysql($this->link, $data);
        $query = $this->getCreateQuery($sql_data['fields'], $sql_data['values']);

        if ($this->link->query($query) === TRUE) {
            $response = array(
                "success" => "Creado"
            );
        } else {
            $response = array(
                "error" => "Ocurrio un error"
            );
        }
        $this->close_conection();
        return $response;
    }

    public function readAll() {
        $this->open_connection();
        $query = $this->getReadQuery(NULL);
        $result = $this->link->query($query);

        $response = array();
        while ($row = $result->fetch_assoc()) {
            array_push($response, $row);
        }
        $this->close_conection();

        if (count($response) < 1) {
            $response = array(
                "error" => "Sin resultados"
            );
        }
        return $response;
    }

    public function read($where) {
        $this->open_connection();
        $query = $this->getReadQuery(mysqli_real_escape_string($this->link, $where));
        $result = $this->link->query($query);

        $response = array();

        while ($row = $result->fetch_assoc()) {
            array_push($response, $row);
        }
        $this->close_conection();

        if (count($response) < 1) {
            $response = array(
                "error" => "Sin resultados"
            );
        }
        return $response;
    }

    public function update($data) {
        //$query = $this->getUpdateQuery(mysqli_real_escape_string($this->link, $set), mysqli_real_escape_string($this->link, $where));

        $this->open_connection();
        $sql_data = array_to_mysql($this->link, $data);
        $query = $this->getUpdateQuery($sql_data['fields'], $sql_data['values']);

        if ($this->link->query($query) === TRUE) {
            $response = array(
                "success" => "Actualizado"
            );
        } else {
            $response = array(
                "error" => "Ocurrio un error"
            );
        }
    }

    public function delete($where) {
        $this->open_connection();
        $query = $this->getDeleteQuery(mysqli_real_escape_string($this->link, $where));

        if ($this->link->query($query) === TRUE) {
            $response = array(
                "success" => "Eliminado"
            );
        } else {
            $response = array(
                "error" => "Ocurrio un error"
            );
        }
        $this->close_conection();
        return $response;
    }

}
