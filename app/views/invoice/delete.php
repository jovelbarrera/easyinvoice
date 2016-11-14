<?php
if (isset($data['error'])) {
    ?>
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="alert alert-danger">
                <strong><?= $data['error'] ?></strong>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">

            <h2 class="form-signin-heading">¿Seguro deseas eliminar esta factura?</h2>
            <div><strong>Id:</strong></div>
            <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
            <div><strong>Cliente:</strong></div>
            <div><?= Helper::getValueSecurely($data['data'], 'client_name', '') ?></div>
            <div><strong>Fecha:</strong></div>
            <div><?= Helper::getValueSecurely($data['data'], 'date', '') ?></div>
            <div><strong>Total:</strong></div>
            <div><?= Helper::getValueSecurely($data['data'], 'total', '') ?></div>
            <div><strong>Estado:</strong></div>
            <div><?= Helper::getValueSecurely($invoice, 'paid', '') == 1 ? 'Pagado' : 'Pendiente' ?></div>
            <div>&nbsp;</div>

            <form action="<?= $data['base_url'] ?>/invoice/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" method="POST" >
                <input type="hidden" name="id" value="<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" />
                <a href="<?= $data['base_url'] ?>/invoice/index" class="btn btn-default">No</a>
                <input type="submit" class="btn btn-danger" value="Sí, eliminar esta factura" />
            </form>
        </div>
    </div>
    <?php
}