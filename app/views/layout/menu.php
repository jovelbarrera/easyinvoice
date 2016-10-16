<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="<?= $data['base_url'] ?>" class="navbar-brand">Invoice Maker</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">                        
                <li>
                    <a href="<?= $data['base_url'] ?>/client">Clientes</a>
                </li>
                <li>
                    <a href="<?= $data['base_url'] ?>/user/create">Agregar usuario</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <?php
                if (!isset($_SESSION['logged'])) {
                    ?>
                    <li><a href="<?= $data['base_url'] ?>/user/login" >Iniciar sesión</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="<?= $data['base_url'] ?>/user/logout" >Cerrar sesión</a></li>
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