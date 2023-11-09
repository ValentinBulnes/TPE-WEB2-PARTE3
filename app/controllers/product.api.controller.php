<?php
require_once './app/controllers/api.controller.php';
require_once './app/models/product.model.php';

class ProductApiController extends ApiController {
    private $model;

    public function __construct() {
        parent::__construct();
          $this->model = new productModel();
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

    function create($params = null) {
        $body = $this->getData();

        $nombre = $body->nombre;
        $precio = $body->precio;
        $categoria = $body->categoria;

        $id = $this->model->insertProduct($nombre, $precio, $categoria);

        $this->view->response('La tarea fue insertada con el id='.$id, 201);
    }
}