<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">Detalle rol</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'name', '') ?></div>
        <div>&nbsp;</div>
        <a href="<?= $data['base_url'] ?>/role/index" class="btn btn-default">Volver al listado</a>
        <a href="<?= $data['base_url'] ?>/role/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" class="btn btn-primary">Eliminar</a>

    </div>
</div>