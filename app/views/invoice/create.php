<?php
$products = $data['data']['products'];
$client = $data['data']['client'];
$product_tax = $data['data']['product_tax'];
$payments = $data['data']['payments'];
$invoice_number = $data['data']['invoice_number'];
?>
<div class="container">
    <div class="col-lg-12">
        <form class="form-signin" action="<?= $data['base_url'] ?>/invoice/create/<?= Helper::getValueSecurely($client, 'id', '') ?>" method="POST">
            <h2 class="form-signin-heading">Factura: Nº <?= $invoice_number ?></h2>
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="text-info"><?= Helper::getValueSecurely($client, 'name', '') ?></h3>
                    <p>
                        <?= Helper::getValueSecurely($client, 'address', '') ?>
                    </p>
                    <p>
                        <strong>Registrado por:</strong> XXX
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="well">
                        <label for="date">Fecha</label>
                        <input type="text" id="datepicker" name="date" class="form-control" />

                        <label for="payment">Forma de pago</label>
                        <select class="form-control" id ="payment" name="payment">
                            <?php
                            foreach ($payments as $payment) {
                                ?>
                                <option value="<?= Helper::getValueSecurely($payment, 'id', '') ?>"
                                        ><?= Helper::getValueSecurely($payment, 'name', '') ?></option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <strong>Cantidad</strong>
                        </div>
                        <div class="col-md-5">
                            <strong>Descripción</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>Precio</strong>
                        </div>
                        <div class="col-md-2">
                            <strong>Valor</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div>&nbsp;</div>

            <div class="row col-md-12">
                <div id="invoice_detail_area">
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-1">
                                <label for="date">Subtotal</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="subtotal" placeholder="Subtotal" value="0" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-1">
                                <label for="date">Impuestos</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="taxes" placeholder="Impuestos" value="0" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-7">
                            </div>
                            <div class="col-md-1">
                                <label for="date">Total</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="total" placeholder="Total" value="0" readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Agregar item</label>
                        <div class="input-group">
                            <span class="input-group-addon">Productos</span>
                            <select id="products_list" class="form-control">
                                <?php
                                foreach ($products as $product) {
                                    ?>
                                    <option value="<?= Helper::getValueSecurely($product, 'id', '') ?>"
                                            data-price="<?= Helper::getValueSecurely($product, 'price', '') ?>"
                                            ><?= Helper::getValueSecurely($product, 'name', '') ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                            <span class="input-group-btn">
                                <button id="add_product_button" class="btn btn-default" type="button">Agregar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div>&nbsp;</div>

            <div class="row">
                <a href="<?= $data['base_url'] ?>/invoice/index" class="btn btn-default">Regresar</a>
                <button class="btn btn-primary" type="submit">Registrar</button>
            </div>
        </form>
    </div>
</div>
<div>&nbsp;</div>

<script>
    var dataSectionCount = 0;
    var product_tax;

    $(function () {
        product_tax = <?= $product_tax ?>;
        var arr = $.map(product_tax, function (el) {
            return el
        });

        $("#datepicker").datepicker({dateFormat: 'dd/mm/yy'});//'setDate', new Date());
        var now = new Date();
        var prettyDate = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
        $("#datepicker").val(prettyDate);
    });

    class Product {
        constructor(id, sku, name, description, price, provider, purchasePrice) {
            this.id = id;
            this.sku = sku;
            this.name = name;
            this.description = description;
            this.price = price;
            this.provider = provider;
            this.purchasePrice = purchasePrice;
        }
    }

    $('#add_product_button').click(function (event) {
        event.preventDefault();

        dataSectionCount++;

        alreadyAdded = false;
        for (section = 1; section <= dataSectionCount; section++) {
            productValue = '#product_id_' + section;
            if ($(productValue).val() === $('#products_list').val()) {
                alreadyAdded = true;
                break;
            }
        }
        if (alreadyAdded) {
            alert("Already added");
        } else {
            detailSection = generateDetailSection(
                    dataSectionCount,
                    $('#products_list').val(),
                    $('#products_list option:selected').text(),
                    $('#products_list option:selected').data('price'));
            $('#invoice_detail_area').append(detailSection);

            defineValue(dataSectionCount);
        }
    });

    $('#invoice_detail_area').on('click', '.remove_product_button', function (event) {
        event.preventDefault();
        detailSection = '#data-section-' + $(this).data('section');
        $(detailSection).remove();
        defineTotals();
    });

    $('#invoice_detail_area').on('change', '.product_quantity', function (event) {
        event.preventDefault();
        defineValue($(this).data('section'));
    });

    function defineValue(section) {
        productQantity = '#product_quantity_' + section;
        productPrice = '#product_price_' + section;
        productValue = '#product_value_' + section;
        $(productValue).val($(productQantity).val() * $(productPrice).val());
        defineTotals();
    }

    function defineTotals() {
        subtotal = 0;
        for (section = 1; section <= dataSectionCount; section++) {
            productValue = '#product_value_' + section;
            if ($(productValue).val() !== undefined) {
                subtotal += parseFloat($(productValue).val());
            }
        }

        taxes = calculateTaxes();

        total = subtotal + taxes;

        $('#subtotal').val(subtotal);
        $('#taxes').val(taxes);
        $('#total').val(total);
    }

    function calculateTaxes() {
        taxes = 0;
        for (section = 1; section <= dataSectionCount; section++) {
            productValue = '#product_id_' + section;
            productQuantity = '#product_quantity_' + section;
            percentage = 0;
            price = 0;
            product_tax.forEach(function (item) {
                if ($(productValue).val() === item['product_id']) {
                    price = parseFloat(item['price']);
                    percentage += parseFloat(item['percentage']);
                }
            });
            taxes += (parseFloat(price * percentage / 100) * parseFloat($(productQuantity).val()));

            console.log($(productQuantity).val());
        }
        console.log('****');
        return taxes;
    }

    function generateDetailSection(dataSectionCount, productId, productName, productPrice) {
        detailSection =
                '<div id="data-section-' + dataSectionCount + '" class="form-group">' +
                '<input type="hidden" id="product_id_' + dataSectionCount + '" name="product_id_' + dataSectionCount + '" value="' + productId + '">' +
                '<div class="col-md-12">' +
                '<div class="form-group row">' +
                '<div class="col-md-2">' +
                '<input type="text" id="product_quantity_' + dataSectionCount + '" class="product_quantity form-control" data-section="' + dataSectionCount + '" name="product_quantity_' + dataSectionCount + '" value="1" placeholder="Cantidad">' +
                '</div>' +
                '<div class="col-md-5">' +
                '<input type="text" id="product_description_' + dataSectionCount + '" class="product_description form-control" data-section="' + dataSectionCount + '" value="' + productName + '" placeholder="Descripción" readonly="readonly">' +
                '</div>' +
                '<div class="col-md-2">' +
                '<input type="text" id="product_price_' + dataSectionCount + '" class="product_price form-control" data-section="' + dataSectionCount + '" value="' + productPrice + '" placeholder="Precio" readonly="readonly">' +
                '</div>' +
                '<div class="col-md-2">' +
                '<input type="text" id="product_value_' + dataSectionCount + '" class="product_value form-control" data-section="' + dataSectionCount + '" placeholder="Valor" readonly="readonly">' +
                '</div>' +
                '<div class="col-md-1">' +
                '<button type="button" class="remove_product_button btn btn-danger" data-section="' + dataSectionCount + '" >Remover</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        return detailSection;

    }

</script>