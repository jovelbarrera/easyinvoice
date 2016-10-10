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

    abstract public function create($data);

    abstract public function readAll();

    abstract public function read($where);

    abstract public function update($data);

    abstract public function delete($data);
}
