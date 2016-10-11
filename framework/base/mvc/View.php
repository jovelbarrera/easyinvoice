<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
require_once FRAMEWORK_PATH . '/base/interfaces/IView.php';

abstract class View implements IView {

    abstract public function getTitle();

    abstract public function getContent();

    abstract public function buildUI();
}
