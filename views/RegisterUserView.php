<?php
require_once '/../framework/config.php';
require_once FRAMEWORK_PATH . '/base/mvc/View.php';
require_once ROOT_PATH . '/utils/UIBuilder.php';
require_once ROOT_PATH . '/utils/utils.inc.php';

class RegisterUserView extends View {

    protected $data = array();
    protected $response = array();

    public function __construct($post_data, $response) {
        if (isset($post_data)) {
            $this->data["email"] = secure_value($post_data, 'email', '');
            $this->data["firstname"] = secure_value($post_data, 'firstname', '');
            $this->data["lastname"] = secure_value($post_data, 'lastname', '');
        }
        if (isset($response)) {
            $this->response = $response;
        }
    }

    public function getRootPath() {
        return ROOT_PATH;
    }

    public function getTitle() {
        return "Iniciar sesión";
    }

    public function getContent() {
        ob_start();
        ?>
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3">
                <form class="form-signin" action="register_user.php" method="POST">
                    <h2 class="form-signin-heading">Registrar usuario</h2>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" value="<?= $this->data['email'] ?>">
                    <label for="firstname">Nombres</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Nombres" required="" value="<?= $this->data['firstname'] ?>">
                    <label for="lastname">Apellidos</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellidos" required="" value="<?= $this->data['lastname'] ?>">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required="">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
                </form>
            </div>
        </div>
        <?php
        if (isset($this->response['error'])) {
            echo $this->errorMessage($this->response['error']);
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
        UIBuilder::getInstance()->buildUI($this->getRootPath(), $this->getTitle(), $this->getContent());
    }

}
