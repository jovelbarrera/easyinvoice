<?php
require_once '/../../framework/config.php';
require_once FRAMEWORK_PATH . '/base/mvc/View.php';
require_once ROOT_PATH . '/utils/UIBuilder.php';

class LoginView extends View {

    protected $data = array();

    public function __construct($data) {
        if (isset($data['error'])) {
            $this->message = $data;
        } else {
            $this->data = $data;
        }
    }

    public function getTitle() {
        return "Iniciar sesión";
    }

    public function getContent() {
        ob_start();
        ?>
        <div class="container">
            <div class="col-lg-4 col-lg-offset-4">
                <form class="form-signin" action="login.php" method="POST">
                    <h2 class="form-signin-heading">Iniciar sesion</h2>
                    <label for="username">Email</label>
                    <input type="email" id="username" name="username" class="form-control" placeholder="Email" required="" autofocus="">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required="">
                    <div>&nbsp;</div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
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
