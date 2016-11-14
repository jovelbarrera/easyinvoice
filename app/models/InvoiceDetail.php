<?php

namespace app\models;

use framework\core\Model;

final class InvoiceDetail extends Model {

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
        return "invoice_detail";
    }

}
