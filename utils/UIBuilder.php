<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
require_once 'Singleton.php';

final class UIBuilder extends Singleton {

    function buildUI($title, $body) {
        echo $this->build($title, $body);
    }

    private function build($title, $body) {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <?= $this->head($title); ?>
            <body>
                <?= $this->scripts(); ?>
                <div class="navbar navbar-default navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="<?= DOMAIN_NAME ?>/index.php" class="navbar-brand">Invoice Maker</a>
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="navbar-main">
                            <ul class="nav navbar-nav">                        
                                <li>
                                    <a href="<?= DOMAIN_NAME ?>/controllers/client/read.php">Clientes</a>
                                </li>
                                <li>
                                    <a href="<?= DOMAIN_NAME ?>/controllers/user/register.php">Agregar usuario</a>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right">

                                <?php
                                if (!isset($_SESSION['logged'])) {
                                    ?>
                                    <li><a href="<?= DOMAIN_NAME ?>/controllers/user/login.php" >Iniciar sesión</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="<?= DOMAIN_NAME ?>/controllers/user/logout.php" >Cerrar sesión</a></li>
                                    <?php
                                }
                                ?>

                            </ul>

                        </div>
                    </div>
                </div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <?= $body; ?>
            </body>
        </html>
        <?php
        return ob_get_clean();
    }

    private function head($title) {
        ob_start();
        ?>
        <head>
            <meta charset="utf-8">
            <title><?= $title ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="<?= DOMAIN_NAME ?>/assets/bootstrap/css/bootstrap.min.css" media="screen">
            <link rel="stylesheet" href="<?= DOMAIN_NAME ?>/assets/flatly/css/bootstrap.min.css">
        </head>
        <?php
        return ob_get_clean();
    }

    private function scripts() {
        ob_start();
        ?>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="<?= DOMAIN_NAME ?>/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= DOMAIN_NAME ?>/assets/flatly/js/custom.js"></script>
        <?php
        return ob_get_clean();
    }

}
?>