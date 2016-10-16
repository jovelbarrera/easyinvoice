<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/client/create" method="POST">
            <h2 class="form-signin-heading">Registrar cliente</h2>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" >
            <label for="nit">NIT</label>
            <input type="text" id="nit" name="nit" class="form-control" placeholder="NIT" required="" >
            <label for="address">Direccion</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Direccion" required="" >
            <label for="phone">Telefono</label>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Telefono" required="" >
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/client/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</div>
<div>&nbsp;</div>