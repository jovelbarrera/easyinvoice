<?php
$product = $data['data']['product'];
$taxes = $data['data']['taxes'];
$applied_taxes = $data['data']['applied_taxes'];
?>
<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/product/edit/<?= Helper::getValueSecurely($product, 'id', '') ?>" method="POST">
            <h2 class="form-signin-heading">Editar Impuesto</h2>
            <input type="hidden" id="id" name="id" value="<?= Helper::getValueSecurely($product, 'id', '') ?>">

            <label for="sku">SKU</label>
            <input type="text" id="sku" name="sku" class="form-control" placeholder="SKU" required="" value="<?= Helper::getValueSecurely($product, 'sku', '') ?>">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" value="<?= Helper::getValueSecurely($product, 'name', '') ?>">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" class="form-control" rows="3" ><?= Helper::getValueSecurely($product, 'description', '') ?></textarea>
            <label for="price">Precio</label>
            <div class="input-group">
                <input type="text" id="price" name="price" class="form-control" placeholder="Precio" required="" value="<?= Helper::getValueSecurely($product, 'price', '') ?>">
                <span class="input-group-addon">$</span>
            </div>
            <label for="provider">Proveedor</label>
            <input type="text" id="provider" name="provider" class="form-control" placeholder="Proveedor" required="" value="<?= Helper::getValueSecurely($product, 'provider', '') ?>">
            <label for="purchase_price">Precio de compra</label>
            <div class="input-group">
                <input type="text" id="purchase_price" name="purchase_price" class="form-control" placeholder="Precio de compra" required="" value="<?= Helper::getValueSecurely($product, 'purchase_price', '') ?>">
                <span class="input-group-addon">$</span>
            </div>
            <div>&nbsp;</div>
            <h3>Impuestos aplicables</h3>
            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Aplica</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($taxes as $key => $tax) {
                        $tax_name = Helper::getValueSecurely($tax, 'name', '');
                        $tax_id = Helper::getValueSecurely($tax, 'id', '');
                        $is_applied = FALSE;
                        foreach ($applied_taxes as $applied_tax_key => $applied_tax) {
                            if (Helper::getValueSecurely($tax, 'id', '') == Helper::getValueSecurely($applied_tax, 'tax', '')) {
                                $is_applied = TRUE;
                            }
                        }
                        ?>
                        <tr>
                            <td><?= $tax_name ?></td>
                            <td><input type="checkbox" name="tax_<?= $tax_id ?>" <?= $is_applied ? "checked" : "" ?> /></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/product/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit"><?= isset($data['data']['id']) ? "Actualizar" : "Registrar" ?></button>
        </form>
    </div>
</div>
<div>&nbsp;</div>
<?php
if (isset($data['error'])) {
    ?>
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?= Helper::getValueSecurely($data['error'], 'message', '') ?></strong>
            </div>
        </div>
    </div>
    <?php
}