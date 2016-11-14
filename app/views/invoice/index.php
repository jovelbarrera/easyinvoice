<div class="container">
    <h2 class="form-signin-heading">Facturas</h2>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?= $data['base_url'] ?>/invoice/create" class="btn btn-info" >Agregar</a>
        </div>
        <div>&nbsp;</div>
    </div>
    <?php
    if (isset($data['error'])) {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-dismissible alert-danger">
                    <!--                    <button type="button" class="close" data-dismiss="alert">&times;</button>-->
                    <strong><?= Helper::getValueSecurely($data, 'error', '') ?></strong>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th> 
                    <th>Fecha</th>                    
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['data'] as $key => $invoice) {
                    ?>
                    <tr>
                        <td><?= Helper::getValueSecurely($invoice, 'id', '') ?></td>
                        <td><?= Helper::getValueSecurely($invoice, 'client_name', '') ?></td>
                        <td><?= Helper::getValueSecurely($invoice, 'date', '') ?></td>
                        <td>$ <?= Helper::getValueSecurely($invoice, 'total', '') ?></td>
                        <td><?= Helper::getValueSecurely($invoice, 'paid', '') == 1 ? 'Pagado' : 'Pendiente' ?></td>
                        <td>
                            <a href="<?= $data['base_url'] ?>/invoice/detail/<?= Helper::getValueSecurely($invoice, 'id', '') ?>" class="btn btn-success" >Ver</a>
                            <a href="<?= $data['base_url'] ?>/invoice/edit/<?= Helper::getValueSecurely($invoice, 'id', '') ?>" class="btn btn-primary" >Editar</a>
                            <a href="<?= $data['base_url'] ?>/invoice/delete/<?= Helper::getValueSecurely($invoice, 'id', '') ?>" class="btn btn-danger" >Eliminar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    ?>
</div>