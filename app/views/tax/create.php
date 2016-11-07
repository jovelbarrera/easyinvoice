<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/tax/create" method="POST">
            <h2 class="form-signin-heading">Nuevo Impuesto</h2>
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" >
            <label for="percentage">Valor</label>
            <div class="input-group">
                <input type="text" id="percentage" name="percentage" class="form-control" placeholder="Valor" required="" >
                <span class="input-group-addon">%</span>
            </div>
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/tax/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</div>
<div>&nbsp;</div>