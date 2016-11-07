<?php

namespace app\controllers;

use framework\core\Controller;
use app\models\Product;
use \app\models\Tax;
use \app\models\ProductTax;
use app\helpers\UIHelper;

class ProductController extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadHelper("Helper");
    }

    public function index() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Productos";
        $response = Product::getInstance()->read();

        if (isset($response['error'])) {
            $data['error'] = $response['error'];
        } else {
            $data['data'] = $response;
        }
        UIHelper::layout($this, "product/index", $data);
    }

    public function detail($id) {
        $response = Product::getInstance()->read(NULL, array("id" => $id));

        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data ['title'] = "Detalle de producto";

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = array();
            $data['data']['product'] = $response[0];
            $query = "SELECT  tax.name AS tax_name, tax.percentage " .
                    "FROM product, product_tax, tax " .
                    "WHERE product.id = product_tax.product AND tax.id = product_tax.tax " .
                    "AND product_tax.product = " . $id;
            $aplied_taxes = ProductTax::getInstance()->readQuery($query);
            if (isset($aplied_taxes['error'])) {
                $data['data']['aplied_taxes'] = array();
            } else {
                $data['data']['aplied_taxes'] = $aplied_taxes;
            }
        }

        UIHelper::layout($this, "product/detail", $data);
    }

    public function create() {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Nuevo producto";

        if ($this->isPostRequest()) {
            $product = array(
                "sku" => $this->post['sku'],
                "name" => $this->post['name'],
                "description" => $this->post['description'],
                "price" => $this->post['price'],
                "provider" => $this->post['provider'],
                "purchase_price" => $this->post['purchase_price'],
            );
            $response = Product::getInstance()->create($product);
            if (isset($response['id'])) {
                $product_id = $response['id'];
                $delete_response = ProductTax::getInstance()->delete(array('product' => $product_id));
                foreach ($this->post as $key => $value) {
                    if (substr($key, 0, 4) === "tax_") {
                        $product_tax = array(
                            'product' => $product_id,
                            'tax' => substr($key, 4, strlen($key))
                        );
                        $product_tax_response = ProductTax::getInstance()->create($product_tax);
                    }
                }
                $this->detail($response['id']);
            }
            return;
        }

        $data['data'] = array();
        $data['data']['taxes'] = Tax::getInstance()->read();

        UIHelper::layout($this, "product/create", $data);
    }

    public function edit($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Editar producto";

        if ($this->isPostRequest()) {
            $product = array(
                "id" => $this->post['id'],
                "sku" => $this->post['sku'],
                "name" => $this->post['name'],
                "description" => $this->post['description'],
                "price" => $this->post['price'],
                "provider" => $this->post['provider'],
                "purchase_price" => $this->post['purchase_price'],
            );
            $response = Product::getInstance()->update($product);

            $product_id = $id;
            $delete_response = ProductTax::getInstance()->delete(array('product' => $product_id));
            foreach ($this->post as $key => $value) {
                if (substr($key, 0, 4) === "tax_") {
                    $product_tax = array(
                        'product' => $product_id,
                        'tax' => substr($key, 4, strlen($key))
                    );
                    $product_tax_response = ProductTax::getInstance()->create($product_tax);
                }
            }
            header("Location: " . $data['base_url'] . "/product/");

            return;
        }

        $response = Product::getInstance()->read(NULL, array("id" => $id));

        if (isset($response["error"])) {
            $data['message'] = $response['error'];
        } else {
            $taxes = Tax::getInstance()->read();
            $applied_taxes = ProductTax::getInstance()->read(NULL, array("product" => (int) $id));

            $data['data']['taxes'] = $taxes;
            $data['data']['applied_taxes'] = $applied_taxes;
            $data['data']['product'] = $response[0];
        }

        UIHelper::layout($this, "product/edit", $data);
    }

    public function delete($id) {
        $data = array();
        $data['base_url'] = $this->config['app']['domain_name'];
        $data['title'] = "Eliminar de producto";

        if ($this->isPostRequest()) {
            $response = Product::getInstance()->delete(array('id' => $id));
            if (isset($response['success'])) {
                header("Location: " . $data['base_url'] . "/product/");
            }
            return;
        }

        $response = Product::getInstance()->read(NULL, array("id" => $id));

        if (isset($response['error'])) {
            $data['message'] = $response['error'];
        } else {
            $data['data'] = $response[0];
        }

        UIHelper::layout($this, "product/delete", $data);
    }

}
