<?php
require_once '/../framework/config.php';
require_once FRAMEWORK_PATH . '/base/mvc/View.php';
require_once ROOT_PATH . '/utils/UIBuilder.php';

class LoginView extends View {

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
                <form class="form-signin">
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function buildUI() {
        UIBuilder::getInstance()->buildUI($this->getRootPath(), $this->getTitle(), $this->getContent());
    }

}
