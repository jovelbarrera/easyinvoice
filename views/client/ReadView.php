<?php
require_once '/../../framework/config.php';
require_once FRAMEWORK_PATH . '/base/mvc/View.php';
require_once ROOT_PATH . '/utils/UIBuilder.php';
require_once ROOT_PATH . '/utils/utils.inc.php';

class ReadView extends View {

    protected $data = array();
    protected $message = array();

    public function __construct($data) {
        if (isset($data['error'])) {
            $this->message = $data;
        } else {
            $this->data = $data;
        }
    }

    public function getTitle() {
        return "Listado de Clientes";
    }

    public function getContent() {
        ob_start();
        ?>
        <div class="container">
            <div class="">
                <h2 class="form-signin-heading">Listado de clientes</h2>
                <a href="edit.php" class="btn btn-info" >Agregar</a>
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>NIT</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->data as $key => $value) {
                            ?>
                            <tr>
                                <td><?= secure_value($value, "id", "") ?></td>
                                <td><?= secure_value($value, "name", "") ?></td>
                                <td><?= secure_value($value, "nit", "") ?></td>
                                <td><?= secure_value($value, "address", "") ?></td>
                                <td><?= secure_value($value, "phone", "") ?></td>
                                <td>
                                    <a href="edit.php?id=<?= secure_value($value, "id", "") ?>" class="btn btn-info" >Editar</a>
                                    <a href="delete.php?id=<?= secure_value($value, "id", "") ?>" class="btn btn-danger" >Eliminar</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
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
            <div >
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
