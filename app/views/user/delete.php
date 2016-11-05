
<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">¿Seguro deseas eliminar este usuario?</h2>
        <div><strong>Usuario:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'username', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'firstname', '') ?></div>
        <div><strong>Apellido:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'lastname', '') ?></div>
        <div><strong>Email:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'email', '') ?></div>
        <div>&nbsp;</div>

        <form action="<?= $data['base_url'] ?>/user/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" method="POST" >
            <input type="hidden" name="id" value="<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" />
            <a href="<?= $data['base_url'] ?>/user/index" class="btn btn-default">No</a>
            <input type="submit" class="btn btn-danger" value="Sí, eliminar este usuario" />
        </form>
    </div>
</div>