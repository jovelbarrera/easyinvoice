<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Product;
use app\models\Client;
use app\models\ProductTax;
use app\models\Payment;
use app\models\Invoice;
use app\models\InvoiceDetail;
use app\helpers\UIHelper;

class InvoiceController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Listado de usuarios";
        $response = Client::getInstance()->read();
        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "invoice/index", $data);
    }

    public function detail($id) {
        $response = Client::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de cliente";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "invoice/detail", $data);
    }

    public function create($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Crear usuario";

        $data['data'] = array();

        $invoice_number = count(Invoice::getInstance()->read()) + 1;
        $data['data']['invoice_number'] = $invoice_number;

        $client = Client::getInstance()->read(NULL, array('id' => $id));
        $data['data']['client'] = $client[0];

        $payments = Payment::getInstance()->read();
        $data['data']['payments'] = $payments;

        $products = Product::getInstance()->read();
        $data['data']['products'] = $products;

        $product_tax_query = "SELECT product.id AS product_id, " .
                "sku, " .
                "product.name AS product_name, " .
                "product.description AS product_description, " .
                "price, provider, purchase_price, " .
                "tax.id AS tax_id, " .
                "tax.name AS tax_name, " .
                "percentage " .
                "FROM product, tax, product_tax " .
                "WHERE product_tax.product = product.id AND product_tax.tax = tax.id";
        $product_taxes = ProductTax::getInstance()->readQuery($product_tax_query);
        $data['data']['product_tax'] = json_encode($product_taxes);

        if ($this->isPostRequest()) {
//            echo '<pre>';
//            print_r($this->post);
//            echo '</pre>';
            $invoice_data = $this->post;
            foreach ($payments as $payment) {
                if ($payment['id'] == $invoice_data['payment']) {
                    $payment_name = $payment['name'];
                }
            }
            $invoice = array(
                'date' => $invoice_data['date'],
                'client_id' => $id,
                'client_name' => $client[0]['name'],
                'payment_id' => $invoice_data['payment'],
                'payment_name' => $payment_name,
            );
            $response_invoice = Invoice::getInstance()->create($invoice);
            if (isset($response_invoice['id'])) {
                $invoice_id = $response_invoice['id'];
//            echo '<pre>';
//            print_r($invoice);
//            echo '</pre>';

                $invoice_detail = array();
                $product_id = "";
                $product_quantity = 0;
                $product_description = "";
                $product_price = 0;
                $taxes = 0;

                foreach ($invoice_data as $key => $detail) {
                    if (substr($key, 0, 11) == "product_id_") {
                        $product_id = $detail;
                    } else if (substr($key, 0, 17) == "product_quantity_") {
                        $product_quantity = $detail;

                        foreach ($products as $product) {
                            if ($product['id'] == $product_id) {
                                $product_description = $product['name'];
                                $product_price = $product['price'];
                            }
                        }

                        foreach ($product_taxes as $product_tax) {
                            if ($product_tax['product_id'] == $product_id) {
                                $taxes += $product_tax['percentage'];
                            }
                        }

                        $invoice_detail['invoice'] = $invoice_id;
                        $invoice_detail['quantity'] = (int) $product_quantity;
                        $invoice_detail['description'] = $product_description;
                        $invoice_detail['price'] = (float) $product_price;
                        $invoice_detail['value'] = (float) $product_price * $product_quantity;
                        $invoice_detail['taxes_percentage'] = (float) $taxes;
                        $invoice_detail['product'] = $product_id;


                        $response_invoice_detail = InvoiceDetail::getInstance()->create($invoice_detail);
//                        print_r($response_invoice_detail);
//                        echo '<pre>';
//                        print_r($invoice_detail);
//                        echo '</pre>';

                        $product_id = "";
                        $product_quantity = 0;
                        $product_description = "";
                        $product_price = 0;
                        $taxes = 0;
                    }
                }
            }
            return;
        }

        UIHelper::layout($this, "invoice/create", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar usuario";

        if ($this->isPostRequest()) {
            $response = Client::getInstance()->update($this->post);
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/invoice/");
            }
            return;
        }

        $response = Client::getInstance()->read(NULL, array("id" => $id));

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "invoice/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de usuario";

        if ($this->isPostRequest()) {
            $response = Client::getInstance()->delete(array('id' => $id));
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/invoice/");
            }
            return;
        }

        $response = Client::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "invoice/delete", $data);
    }

}
