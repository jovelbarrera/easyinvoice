<div class="container">
    <h2 class="form-signin-heading">Roles</h2>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= $data['base_url'] ?>/role/create" class="btn btn-info" >Agregar</a>
        </div>
        <div>&nbsp;</div>
    </div>
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
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Creación</th>
                    <th>Último cambio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['data'] as $permission_key => $permission) {
                    ?>
                    <tr>
                        <td><?= Helper::getValueSecurely($permission, 'id', '') ?></td>
                        <td><?= Helper::getValueSecurely($permission, 'name', '') ?></td>
                        <td><?= Helper::getValueSecurely($permission, 'created_at', '') ?></td>
                        <td><?= Helper::getValueSecurely($permission, 'updated_at', '') ?></td>
                        <td>
                            <a href="<?= $data['base_url'] ?>/role/assign/<?= Helper::getValueSecurely($permission, 'id', '') ?>" class="btn btn-success" >Permisos</a>
                            <a href="<?= $data['base_url'] ?>/role/edit/<?= Helper::getValueSecurely($permission, 'id', '') ?>" class="btn btn-primary" >Editar</a>
                            <a href="<?= $data['base_url'] ?>/role/delete/<?= Helper::getValueSecurely($permission, 'id', '') ?>" class="btn btn-danger" >Eliminar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>