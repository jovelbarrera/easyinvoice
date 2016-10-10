<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootswatch: Flatly</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="./assets/flatly/css/bootstrap.min.css">
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="../" class="navbar-brand">Invoice Maker</a>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">                        
                        <li>
                            <a href="controllers/client/read.php">Clientes</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <?php
                        session_start();
                        if (!isset($_SESSION['logged'])) {
                            ?>
                            <li><a href="controllers/user/login.php" >Iniciar sesión</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="controllers/user/logout.php" >Cerrar sesión</a></li>
                            <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </div>
    </body>
</html>
