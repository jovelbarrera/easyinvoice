<?php

namespace framework\core;

use framework\Config;
use framework\core\IModel;
use framework\utils\Utils;
use framework\utils\Singleton;

/* require_once (__DIR__ . '/../utils/Utils.php');
  require_once (__DIR__ . '/../utils/Singleton.php');
  require_once (__DIR__ . '/../Config.php');
  require_once (__DIR__ . '/IModel.php');
  require_once (__DIR__ . '/IDBService.php');
 */

abstract class Model extends Singleton implements IModel {

    private $link;
    private $config;

    protected function __construct() {
        parent::__construct();
        $this->config = (new Config())->config;
    }

    public function openConnection() {
        $this->link = new \mysqli($this->config["db"]["hostname"], $this->config["db"]["username"], $this->config["db"]["password"], $this->config["db"]["database"]);

        if ($this->link->connect_error) {
            die("Connection failed: " . $this->link->connect_error);
        }
    }

    public function closeConection() {
        $this->link->close();
    }

    abstract function getTable();

    public function getCreateQuery($table, $fields, $values) {
        return sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $fields, $values);
    }

    public function getReadQuery($table, $where) {
        if ($where == NULL) {
            return sprintf("SELECT * FROM %s", $table);
        } else {
            return sprintf("SELECT * FROM %s WHERE %s", $table, $where);
        }
    }

    public function getUpdateQuery($table, $fields, $values) {
        return sprintf("REPLACE INTO %s (%s) VALUES (%s)", $table, $fields, $values);
    }

    public function getDeleteQuery($table, $where) {
        return sprintf("DELETE FROM %s WHERE %s", $table, $where);
    }

    // IDBService implementation

    public function create($data) {
        $this->openConnection();
        $sql_data = Utils::arrayToMysql($this->link, $data);

        $query = $this->getCreateQuery($this->getTable(), $sql_data['fields'], $sql_data['values']);

        if ($this->link->query($query) === TRUE) {
            $response = array(
                "id" => $this->link->insert_id
            );
        } else {
            $response = array(
                "error" => "Ocurrio un error"
            );
        }
        $this->closeConection();
        return $response;
    }

    public function readAll() {
        $this->openConnection();
        $query = $this->getReadQuery($this->getTable(), NULL);
        $result = $this->link->query($query);

        $response = array();
        while ($row = $result->fetch_assoc()) {
            array_push($response, $row);
        }
        $this->closeConection();

        if (count($response) < 1) {
            $response = array(
                "error" => "Sin resultados"
            );
        }
        return $response;
    }

    public function read($where) {
        $this->openConnection();
        $query = $this->getReadQuery($this->getTable(), mysqli_real_escape_string($this->link, $where));
        $result = $this->link->query($query);

        $response = array();

        while ($row = $result->fetch_assoc()) {
            array_push($response, $row);
        }
        $this->closeConection();

        if (count($response) < 1) {
            $response = array(
                "error" => "Sin resultados"
            );
        }
        return $response;
    }

    public function update($data) {
        $this->openConnection();
        $sql_data = Utils::arrayToMysql($this->link, $data);
        $query = $this->getUpdateQuery($this->getTable(), $sql_data['fields'], $sql_data['values']);

        if ($this->link->query($query) === TRUE) {
            $response = array(
                "success" => "Actualizado"
            );
        } else {
            $response = array(
                "error" => "Ocurrio un error"
            );
        }
        $this->closeConection();
        return $response;
    }

    public function delete($id) {
        $where = " id = " . $id;

        $this->openConnection();
        $query = $this->getDeleteQuery($this->getTable(), mysqli_real_escape_string($this->link, $where));

        if ($this->link->query($query) === TRUE) {
            $response = array(
                "success" => "Eliminado"
            );
        } else {
            $response = array(
                "error" => "Ocurrio un error"
            );
        }
        $this->closeConection();
        return $response;
    }

}
