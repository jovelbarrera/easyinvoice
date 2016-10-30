<div class="container">
    <div class="col-lg-4 col-lg-offset-4">
        <form class="form-signin" action="<?= $data['base_url'] ?>/user/login" method="POST">
            <h2 class="form-signin-heading">Iniciar sesion</h2>
            <label for="username">Email</label>
            <input type="email" id="username" name="username" class="form-control" placeholder="Email" required="" autofocus="">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required="">
            <div>&nbsp;</div>
            <p>
                Psst.. usuario: admin@mail.com clave: 12345678
            </p>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesion</button>
        </form>
    </div>
</div>
<?php
if (isset($data['error'])) {
    ?>
    <div class="col-lg-4 col-lg-offset-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissible alert-danger">
                    <strong><?= Helper::getValueSecurely($data, 'error', '') ?></strong>
                </div>
            </div>
        </div>
    </div>
    <?php
}