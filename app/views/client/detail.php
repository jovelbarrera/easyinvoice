
<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">Detalle cliente</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'name', '') ?></div>
        <div><strong>NIT:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'nit', '') ?></div>
        <div><strong>Direccion:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'address', '') ?></div>
        <div><strong>Telefono:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'phone', '') ?></div>
        <div>&nbsp;</div>
        <a href="<?= $data['base_url'] ?>/client/index" class="btn btn-default">Regresar</a>
        <a href="<?= $data['base_url'] ?>/client/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" class="btn btn-danger">Eliminar</a>

    </div>
</div>