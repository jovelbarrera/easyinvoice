<?php
require_once '/../framework/config.php';
require_once FRAMEWORK_PATH . '/base/mvc/View.php';
require_once '/../helpers/UIBuilder.php';

class RegisterUserView extends View {

    protected $data = array();

    public function __construct($get_data, $post_data) {
        if (isset($get_data))
            array_push($this->data, array("GET" => $get_data));
        if (isset($post_data))
            array_push($this->data, array("POST" => $post_data));
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
            <div class="col-lg-3">
                <form class="form-signin" action="../register_user.php">
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
                    <label for="firstname" class="sr-only">Nombres</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Email address" required="" autofocus="">
                    <label for="lastname" class="sr-only">Apellidos</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Email address" required="" autofocus="">
                    <label for="password" class="sr-only">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
            </div>
        </div>
        <?php print_r($this->data) ?>
        <?php
        return ob_get_clean();
    }

    public function buildUI() {
        UIBuilder::getInstance()->buildUI($this->getRootPath(), $this->getTitle(), $this->getContent());
    }

}
