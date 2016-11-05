<?php
$user_data = Helper::getValueSecurely($data, 'data', '');
if ($user_data == '') {
    $data['error'] = "Ocurrió un error";
}
?>
<?php
if (isset($data['error'])) {
    ?>
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= Helper::getValueSecurely($data['error'], 'message', '') ?></strong>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <form class="form-signin" action="<?= $data['base_url'] ?>/user/edit/<?= Helper::getValueSecurely($user_data, 'id', '') ?>" method="POST">
                <h2 class="form-signin-heading">Editar usuario</h2>
                <input type="hidden" name="id" value="<?= Helper::getValueSecurely($user_data, 'id', '') ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" value="<?= Helper::getValueSecurely($user_data, 'email', '') ?>">
                <label for="firstname">Nombres</label>
                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Nombres" required="" value="<?= Helper::getValueSecurely($user_data, 'firstname', '') ?>">
                <label for="lastname">Apellidos</label>
                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Apellidos" required="" value="<?= Helper::getValueSecurely($user_data, 'lastname', '') ?>">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
                <label for="password">Rol</label>
                <select class="form-control" name="role">
                    <?php
                    $roles = isset($data['roles']) ? $data['roles'] : array();
                    foreach ($roles as $role) {
                        $role_id = Helper::getValueSecurely($role, 'id', '');
                        $role_name = Helper::getValueSecurely($role, 'name', '');
                        ?>
                        <option <?= ($role_id == $data['data']['role_id']) ? "selected='selected'" : '' ?> value="<?= $role_id ?>"><?= $role_name ?></option>
                        <?php
                    }
                    ?>
                </select>
                <div>&nbsp;</div>
                <a href="<?= $data['base_url'] ?>/user/index" class="btn btn-default">Regresar</a>
                <button class="btn btn-primary" type="submit"><?= isset($data['data']['id']) ? "Actualizar" : "Registrar" ?></button>
            </form>
        </div>
    </div>
    <div>&nbsp;</div>
    <?php
}