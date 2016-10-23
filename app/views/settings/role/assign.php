<div class="container">
    <h2 class="form-signin-heading">Permisos de <?= Helper::getValueSecurely($data['data'], 'role_name', '') ?></h2>
    <?php
    if (isset($data['error'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissible alert-danger">
                    <!--                    <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong><?= Helper::getValueSecurely($data, 'error', '') ?></strong>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <form action="<?= $data['base_url'] ?>/role/assign" method="POST">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Concedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['data']['permissions'] as $permission_key => $permission) {
                        $permission_name = Helper::getValueSecurely($permission, 'permission_name', '');
                        $permission_id = Helper::getValueSecurely($permission, 'permission_id', '');
                        $is_granted = FALSE;
                        foreach ($data['data']['granted_permissions'] as $granted_permission_key => $granted_permission) {
                            if (Helper::getValueSecurely($permission, 'permission_id', '') == Helper::getValueSecurely($granted_permission, 'id', '')) {
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