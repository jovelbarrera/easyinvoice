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
    $invoice = $data['data']['invoice'];
    $invoice_detail = $data['data']['invoice_detail'];
    ?>
    <div class="container">
        <div class="col-lg-12">
            <form class="form-signin">
                <h2 class="form-signin-heading">Factura: Nº <?= Helper::getValueSecurely($invoice, 'id', '') ?></h2>
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="text-info"><?= Helper::getValueSecurely($invoice, 'client_name', '') ?></h3>
                        <p>
                            <?= Helper::getValueSecurely($invoice, 'address', '') ?>
                        </p>
                        
                        <p>
                            <strong>Status:</strong><br/>
                            <?php
                            if (Helper::getValueSecurely($invoice, 'cancelled', 0) == 1) {
                                ?>
                                <strong class="text-danger">FACTURA CENCELADA</strong><br/>
                                <?php
                            }
                            if (Helper::getValueSecurely($invoice, 'paid', 0) == 1) {
                                ?>
                                <strong class="text-success">FACTURA PAGADA</strong><br/>
                                <?php
                            } else {
                                ?>
                                <strong class="text-danger">FACTURA PENDIENTE DE PAGO</strong><br/>
                                <?php
                            }
                            ?>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="well">
                            <label for="date">Fecha</label>
                            <input type="text" class="form-control" value="<?= Helper::getValueSecurely($invoice, 'date', '') ?>" disabled="disabled" />

                            <label for="payment">Forma de pago</label>
                            <input type="text" class="form-control" value="<?= Helper::getValueSecurely($invoice, 'payment_name', '') ?>" disabled="disabled" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <strong>Cantidad</strong>
                            </div>
                            <div class="col-md-6">
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
                    <?php
                    $subtotal = 0;
                    $taxes = 0;
                    $total = 0;
                    foreach ($invoice_detail as $detail) {
                        $value = (float) Helper::getValueSecurely($detail, 'value', 0);
                        $taxes_percentage = (float) Helper::getValueSecurely($detail, 'taxes_percentage', 0);
                        $subtotal += $value;
                        $taxes += ($value * $taxes_percentage / 100);
                        ?>
                        <div class = "form-group">
                            <div class = "col-md-12">
                                <div class = "form-group row">
                                    <div class = "col-md-2">
                                        <input type = "text" class = "form-control" value = "<?= Helper::getValueSecurely($detail, 'quantity', '') ?>" disabled = "disabled">
                                    </div>
                                    <div class = "col-md-6">
                                        <input type = "text" class = "form-control" value = "<?= Helper::getValueSecurely($detail, 'description', '') ?>" disabled = "disabled">
                                    </div>
                                    <div class = "col-md-2">
                                        <input type = "text" class = "form-control" value = "<?= Helper::getValueSecurely($detail, 'price', '') ?>" disabled = "disabled">
                                    </div>
                                    <div class = "col-md-2">
                                        <input type = "text" class = "form-control" value = "<?= $value ?>" disabled = "disabled">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    $total = $subtotal + $taxes;
                    ?>
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
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="<?= $subtotal ?>" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-1">
                                    <label for="date">Impuestos</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="<?= $taxes ?>" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-1">
                                    <label for="date">Total</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" value="<?= $total ?>" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>&nbsp;</div>

                <div class="row">
                    <a href="<?= $data['base_url'] ?>/invoice/index" class="btn btn-default">Regresar</a>
                </div>
            </form>
        </div>
    </div>
    <div>&nbsp;</div>
    <?php
}