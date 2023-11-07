<?php
require_once './app/models/product.model.php';
require_once './app/api/api.view.php';

class ApiProductController {

    private $model;
    private $view;

    function __construct() {
        $this->model = new productModel();
        $this->view = new APIView();
    }

    public function getAll($params = null) {
        $products = $this->model->getProducts();
        $this->view->response($products, 200);
    }

    public function get($params = null) {
        // $params es un array asociativo con los parametros de la ruta
        
        $idProduct = $params[':ID'];
        $product = $this->model->getProductByID($idProduct);
        if ($product)
            $this->view->response($product, 200);
        else
            $this->view->response("El producto con el id=$idProduct no existe", 404);

    }

    public function delete($params = null) {
        $idProduct = $params[':ID'];
        $success = $this->model->deleteProduct($idProduct);
        if ($success) {
            $this->view->response("El producto con el id=$idProduct se borro exitosamente", 200);
        }
        else {
            $this->view->response("El producto con el id=$idProduct no existe", 404);
        } 
    
    }
}