<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="<?= $data['base_url'] ?>" class="navbar-brand">Easy Invoice</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clientes <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $data['base_url'] ?>/client">Clientes</a></li>
                        <li><a href="<?= $data['base_url'] ?>/client/create">Registrar Cliente</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Configuración <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $data['base_url'] ?>/role">Roles</a></li>
                        <li><a href="<?= $data['base_url'] ?>/role/create">Nuevo Rol</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= $data['base_url'] ?>/permission">Permisos</a></li>
                        <li><a href="<?= $data['base_url'] ?>/permission/create">Nuevo Permiso</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= $data['base_url'] ?>/user">Usuarios</a></li>
                        <li><a href="<?= $data['base_url'] ?>/user/create">Nuevo Usuario</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Payment <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $data['base_url'] ?>/payment">Payment</a></li>
                        <li><a href="<?= $data['base_url'] ?>/payment/create">Nuevo payment</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Impuestos <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $data['base_url'] ?>/tax">Impuestos</a></li>
                        <li><a href="<?= $data['base_url'] ?>/tax/create">Nuevo impuesto</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Produtos <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $data['base_url'] ?>/product">Productos</a></li>
                        <li><a href="<?= $data['base_url'] ?>/product/create">Nuevo producto</a></li>
                    </ul>
                </li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Facturas <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= $data['base_url'] ?>/invoice">Facturas</a></li>
                        <li><a href="<?= $data['base_url'] ?>/invoice/create">Nueva factura</a></li>
                    </ul>
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
