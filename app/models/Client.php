<?php

namespace app\models;

use framework\core\Model;

//require_once (__DIR__ . '/../../framework/utils/Singleton.php');
//require_once (__DIR__ . '/../../framework/core/DBService.php');

final class Client extends Model {

    function getTable() {
        return "client";
    }

}
