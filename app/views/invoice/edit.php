<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/client/edit/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" method="POST">
            <h2 class="form-signin-heading">Editar cliente</h2>
            <input type="hidden" id="id" name="id" value="<?= Helper::getValueSecurely($data['data'], 'id', '') ?>">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" value="<?= Helper::getValueSecurely($data['data'], 'name', '') ?>">
            <label for="nit">NIT</label>
            <input type="text" id="nit" name="nit" class="form-control" placeholder="NIT" required="" value="<?= Helper::getValueSecurely($data['data'], 'nit', '') ?>">
            <label for="address">Direccion</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Direccion" required="" value="<?= Helper::getValueSecurely($data['data'], 'address', '') ?>">
            <label for="phone">Telefono</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefono" required="" value="<?= Helper::getValueSecurely($data['data'], 'phone', '') ?>">
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/client/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit"><?= isset($data['data']['id']) ? "Actualizar" : "Registrar" ?></button>
        </form>
    </div>
</div>
<div>&nbsp;</div>
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
}