<?php

namespace framework\core;

use framework\Config;
use framework\core\IModel;
use framework\utils\Utils;

/* require_once (__DIR__ . '/../utils/Utils.php');
  require_once (__DIR__ . '/../utils/Singleton.php');
  require_once (__DIR__ . '/../Config.php');
  require_once (__DIR__ . '/IModel.php');
  require_once (__DIR__ . '/IDBService.php');
 */

abstract class Model implements IModel {

    private $link;
    private $config;

    protected function __construct() {
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

    public function getCreateQuery($table, $data) {
        $sql_data = Utils::arrayToInsertQuery($this->link, $data);
        $fields = $sql_data['fields'];
        $values = $sql_data['values'];
        return sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $fields, $values);
    }

    public function getReadQuery($table, $fields, $where) {
        $fields_string = "*";
        if ($fields != NULL) {
            $fields_string = Utils::arrayValuesToString($this->link, $fields);
        }

        if ($where == NULL) {
            return sprintf("SELECT %s FROM %s", $fields_string, $table);
        } else {
            $where_string = str_replace(","," and ", Utils::arrayToString($this->link, $where));
            return sprintf("SELECT %s FROM %s WHERE %s", $fields_string, $table, $where_string);
        }
    }

    public function getUpdateQuery($table, $id, $values) {
        //return sprintf("REPLACE INTO %s (%s) VALUES (%s)", $table, $fields, $values);
        return sprintf("UPDATE %s SET %s WHERE id = %s", $table, $values, $id);
    }

    public function getDeleteQuery($table, $where) {
        $where_string = Utils::arrayToString($this->link, $where);
        return sprintf("DELETE FROM %s WHERE %s", $table, $where_string);
    }

    // IModel implementation

    public function create($data) {
        $this->openConnection();
        $query = $this->getCreateQuery($this->getTable(), $data);

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

    public function read($fields = NULL, $where = NULL) {
        $this->openConnection();
        $query = $this->getReadQuery($this->getTable(), $fields, $where);

        $result = $this->link->query($query);

        $response = array();
//        print_r($query);
//        print_r($this->link->error_list);
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
        $sql_data = Utils::arrayToUpdateQuery($this->link, $data);

        $query = $this->getUpdateQuery($this->getTable(), $sql_data['id'], $sql_data['values']);

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

    public function delete($where) {
        $this->openConnection();
        $query = $this->getDeleteQuery($this->getTable(), $where);

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

    function readQuery($query) {
        $this->openConnection();

        $result = $this->link->query(mysqli_real_escape_string($this->link, $query));

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

}
