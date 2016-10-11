<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
//require_once FRAMEWORK_PATH . '/utils/utils.inc.php';
require_once FRAMEWORK_PATH . '/base/mvc/Model.php';

final class Client extends Model {

    const TABLE = "client";

    private static $instance;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
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
    }

    public function create($data) {
        print_r($data);
    }
}

?>
