<?php

namespace framework\core;

use framework\core\IView;

//require_once ('IView.php');

abstract class View implements IView {

    abstract public function getTitle();

    abstract public function getContent();
}
