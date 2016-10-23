<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/permission/create" method="POST">
            <h2 class="form-signin-heading">Registrar permiso</h2>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" >
            <label for="controller">Controller</label>
            <input type="text" id="controller" name="controller" class="form-control" placeholder="Controlador" required="" >
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/permission/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</div>
<div>&nbsp;</div>