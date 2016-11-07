<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <h2 class="form-signin-heading">¿Seguro deseas eliminar este producto?</h2>
        <div><strong>Id:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'id', '') ?></div>
        <div><strong>SKU:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'sku', '') ?></div>
        <div><strong>Nombre:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'name', '') ?></div>
        <div><strong>Descripción:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'description', '') ?></div>
        <div><strong>Precio:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'price', '') ?></div>
        <div><strong>Proveedor:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'provider', '') ?></div>
        <div><strong>Precio de compra:</strong></div>
        <div><?= Helper::getValueSecurely($data['data'], 'purchase_price', '') ?></div>
        <div>&nbsp;</div>

        <form action="<?= $data['base_url'] ?>/product/delete/<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" method="POST" >
            <input type="hidden" name="id" value="<?= Helper::getValueSecurely($data['data'], 'id', '') ?>" />
            <a href="<?= $data['base_url'] ?>/product/index" class="btn btn-default">No</a>
            <input type="submit" class="btn btn-danger" value="Sí, eliminar este producto" />
        </form>
    </div>
</div>