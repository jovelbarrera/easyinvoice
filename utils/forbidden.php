<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/invoicemaker/framework/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>No autorizado</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= DOMAIN_NAME ?>/assets/bootstrap/css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="<?= DOMAIN_NAME ?>/assets/flatly/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h2>Debe iniciar sesion</h2>
            <p>
                Para acceder a este contenido debe iniciar sesion.
            </p>
            <a href="<?= DOMAIN_NAME ?>" class="btn btn-primary">Iniciar sesion</a>
        </div>
    </body>
</html>
