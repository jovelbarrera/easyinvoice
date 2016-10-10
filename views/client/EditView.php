<?php
require_once '/../../framework/config.php';
require_once FRAMEWORK_PATH . '/base/mvc/View.php';
require_once ROOT_PATH . '/utils/UIBuilder.php';
require_once ROOT_PATH . '/utils/utils.inc.php';

class EditView extends View {

    protected $data = array();
    protected $message = array();

    public function __construct($data, $message) {
        $this->data = $data;
        if (isset($message)) {
            $this->message = $message;
        }
    }

    public function getTitle() {
        return "Editar Cliente";
    }

    public function getContent() {
        ob_start();
        ?>
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3">
                <form class="form-signin" action="edit.php" method="POST">
                    <h2 class="form-signin-heading"><?= isset($this->data['id']) ? "Actualizar cliente" : "Registrar cliente" ?></h2>
                    <input type="hidden" id="id" name="id" value="<?= secure_value($this->data, 'id', '') ?>">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" value="<?= secure_value($this->data, 'name', '') ?>">
                    <label for="nit">NIT</label>
                    <input type="text" id="nit" name="nit" class="form-control" placeholder="NIT" required="" value="<?= secure_value($this->data, 'nit', '') ?>">
                    <label for="address">Direccion</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Direccion" required="" value="<?= secure_value($this->data, 'address', '') ?>">
                    <label for="phone">Telefono</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefono" required="" value="<?= secure_value($this->data, 'phone', '') ?>">
                    <div>&nbsp;</div>
                    <a href="read.php" class="btn btn-default">Regresar</a>
                    <button class="btn btn-primary" type="submit"><?= isset($this->data['id']) ? "Actualizar" : "Registrar" ?></button>
                </form>
            </div>
        </div>
        <?php
        if (isset($this->message['error'])) {
            echo $this->errorMessage($this->message['error']);
        }
        return ob_get_clean();
    }

    public function errorMessage($message) {
        ob_start();
        ?>
        <div>&nbsp;</div>
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><?= $message ?></strong>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function buildUI() {
        UIBuilder::getInstance()->buildUI($this->getTitle(), $this->getContent());
    }

}
