<?php
$product = $data['data']['product'];
$aplied_taxes = $data['data']['aplied_taxes'];
?>
<div class="container">
    <div class="col-lg-6 col-lg-offset-3">

        <h2 class="form-signin-heading">Detalle Producto</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($product, 'id', '') ?></div>
        <div><strong>SKU:</strong></div>
        <div><?= Helper::getValueSecurely($product, 'sku', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($product, 'name', '') ?></div>
        <div><strong>Descripción:</strong></div>
        <div><?= Helper::getValueSecurely($product, 'description', '') ?></div>
        <div><strong>Precio:</strong></div>
        <div>$ <?= money_format('%i', Helper::getValueSecurely($product, 'price', '')) ?></div>
        <div><strong>Proveedor:</strong></div>
        <div><?= Helper::getValueSecurely($product, 'provider', '') ?></div>
        <div><strong>Precio de compra:</strong></div>
        <div>$ <?= money_format('%i', Helper::getValueSecurely($product, 'purchase_price', '')) ?></div>
        <div>&nbsp;</div>
        <h3>Impuestos</h3>
        <?php
        if (count($aplied_taxes) == 0) {
            ?>
            <div><strong class="text-danger">Ningún impuesto asociado a este producto.</strong></div>
            <?php
        }
        foreach ($aplied_taxes as $key => $tax) {
            ?>
            <div><strong><?= $tax['tax_name'] ?></strong> (<?= $tax['percentage'] ?> %)</div>
            <?php
        }
        ?>
        <div>&nbsp;</div>
        <a href="<?= $data['base_url'] ?>/product/index" class="btn btn-default">Regresar</a>
        <a href="<?= $data['base_url'] ?>/product/delete/<?= Helper::getValueSecurely($product, 'id', '') ?>" class="btn btn-primary">Eliminar</a>

    </div>
</div>