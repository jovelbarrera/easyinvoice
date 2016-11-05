<?php
$user_data = isset($data['data']) ? $data['data'] : array();
?>
<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/user/create" method="POST">
            <h2 class="form-signin-heading">Registrar usuario</h2>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" value="<?= Helper::getValueSecurely($user_data, 'email', '') ?>">
            <label for="firstname">Nombres</label>
            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Nombres" required="" value="<?= Helper::getValueSecurely($user_data, 'firstname', '') ?>">
            <label for="lastname">Apellidos</label>
            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellidos" required="" value="<?= Helper::getValueSecurely($user_data, 'lastname', '') ?>">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required="">
            <label for="password">Rol</label>
            <select class="form-control" name="role">
                <?php
                $roles = isset($data['roles']) ? $data['roles'] : array();
                print_r($roles);
                foreach ($roles as $role) {
                    ?>
                    <option value="<?= Helper::getValueSecurely($role, 'id', '') ?>"><?= Helper::getValueSecurely($role, 'name', '') ?></option>
                    <?php
                }
                ?>
            </select>
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/user/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</div>
<?php
if (isset($data['error'])) {
    ?>
    <div class="col-lg-6 col-lg-offset-3">
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