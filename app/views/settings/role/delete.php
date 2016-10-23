
<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">¿Seguro deseas eliminar este rol?</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'name', '') ?></div>
        <div>&nbsp;</div>

        <form action="<?= $data['base_url'] ?>/role/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" method="POST" >
            <input type="hidden" name="id" value="<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" />
            <a href="<?= $data['base_url'] ?>/role/index" class="btn btn-default">No</a>
            <input type="submit" class="btn btn-danger" value="Sí, eliminar este rol" />
        </form>
    </div>
</div>