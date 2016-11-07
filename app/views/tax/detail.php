<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">Detalle Impuesto</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'name', '') ?></div>
        <div><strong>Valor:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'percentage', '') ?></div>
        <div>&nbsp;</div>
        <a href="<?= $data['base_url'] ?>/tax/index" class="btn btn-default">Regresar</a>
        <a href="<?= $data['base_url'] ?>/tax/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" class="btn btn-primary">Eliminar</a>

    </div>
</div>