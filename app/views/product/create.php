<div class="container">
    <div class="col-lg-6 col-lg-offset-3">
        <form class="form-signin" action="<?= $data['base_url'] ?>/product/create" method="POST">
            <h2 class="form-signin-heading">Nuevo Producto</h2>
            <label for="sku">SKU</label>
            <input type="text" id="sku" name="sku" class="form-control" placeholder="SKU" required="" >
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required="" >
            <label for="description">Descripción</label>
            <textarea id="description" name="description" class="form-control" rows="3" id="textArea"></textarea>
            <label for="price">Precio</label>
            <div class="input-group">
                <input type="text" id="price" name="price" class="form-control" placeholder="Precio" required="" >
                <span class="input-group-addon">$</span>
            </div>
            <label for="provider">Proveedor</label>
            <input type="text" id="provider" name="provider" class="form-control" placeholder="Proveedor" required="" >
            <label for="purchase_price">Precio de compra</label>
            <div class="input-group">
                <input type="text" id="purchase_price" name="purchase_price" class="form-control" placeholder="Precio de compra" required="" >
                <span class="input-group-addon">$</span>
            </div>
            <?php
            if (isset($data['data']['taxes'])) {
                $taxes = $data['data']['taxes'];
                ?>
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
                        foreach ($taxes as $tax) {
                            ?>
                            <tr>
                                <td><?= $tax['name'] . " (" . $tax['percentage'] . " %)" ?></td>
                                <td><input type="checkbox" name="tax_<?= $tax['id'] ?>"/></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
            <div>&nbsp;</div>
            <a href="<?= $data['base_url'] ?>/product/index" class="btn btn-default">Regresar</a>
            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</div>
<div>&nbsp;</div>