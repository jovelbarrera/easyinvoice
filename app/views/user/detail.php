<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">Detalle Usuario</h2>
        <div><strong>Usuario:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'username', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'firstname', '') ?></div>
        <div><strong>Apellido</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'lastname', '') ?></div>
        <div><strong>Email:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'email', '') ?></div>
        <div>&nbsp;</div>
        <a href="<?= $data['base_url'] ?>/user/index" class="btn btn-default">Regresar</a>
        <a href="<?= $data['base_url'] ?>/user/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" class="btn btn-primary">Eliminar</a>

    </div>
</div>