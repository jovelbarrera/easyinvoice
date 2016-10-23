<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">Detalle permiso</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'name', '') ?></div>
        <div><strong>Controlador:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'controller', '') ?></div>
        <div>&nbsp;</div>
        <a href="<?= $data['base_url'] ?>/permission/index" class="btn btn-default">Volver al listado</a>
        <a href="<?= $data['base_url'] ?>/permission/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" class="btn btn-primary">Eliminar</a>

    </div>
</div>