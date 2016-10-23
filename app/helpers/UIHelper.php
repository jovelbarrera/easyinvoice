<?php

namespace app\helpers;

use framework\core\Controller;

final class UIHelper {

    final static function layout(Controller $controller, $view, $data) {
        $controller->view("layout/header", $data);
        $controller->view("layout/menu", $data);
        $controller->view($view, $data);
        $controller->view("layout/footer", $data);
    }

}
