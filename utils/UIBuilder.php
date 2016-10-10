<?php
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