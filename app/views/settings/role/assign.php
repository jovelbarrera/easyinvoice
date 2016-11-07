<div class="container">
    <?php
    $role = Helper::getValueSecurely($data['data'], 'role', '');
    $permissions = Helper::getValueSecurely($data['data'], 'permissions', '');
    $granted_permissions = Helper::getValueSecurely($data['data'], 'granted_permissions', '');
    ?>
    <h2 class="form-signin-heading">Permisos: <?= Helper::getValueSecurely($role, 'name', '') ?></h2>
    <?php
    if ($permissions == '' or $granted_permissions == '') {
        $data['error'] = "Ocurrió un error";
    }
    if (isset($data['error'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissible alert-danger">
                    <strong><?= Helper::getValueSecurely($data, 'error', '') ?></strong>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger">
            <strong>¡IMPORTANTE!</strong> Cualquier cambio a esta configuración afectará a los usuarios vinculados.
        </div>
        <form action="<?= $data['base_url'] ?>/role/assign/<?= Helper::getValueSecurely($role, 'id', '') ?>" method="POST">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Concedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($permissions as $key => $permission) {
                        $permission_name = Helper::getValueSecurely($permission, 'name', '');
                        $permission_id = Helper::getValueSecurely($permission, 'id', '');
                        $is_granted = FALSE;
                        foreach ($granted_permissions as $granted_permission_key => $granted_permission) {
                            if (Helper::getValueSecurely($permission, 'id', '') == Helper::getValueSecurely($granted_permission, 'permission', '')) {
                                $is_granted = TRUE;
                            }
                        }
                        ?>
                        <tr>
                            <td><?= $permission_name ?></td>
                            <td><input type="checkbox" name="<?= $permission_id ?>" <?= $is_granted ? "checked" : "" ?> /></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="<?= $data['base_url'] ?>/role/index" class="btn btn-default">Volver al listado</a>
            <input type="submit" class="btn btn-primary" value="Guardar" />
        </form>
        <?php
    }
    ?>
</div>