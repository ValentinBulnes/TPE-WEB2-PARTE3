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

    public function create($params = null) {
        $body = $this->getData();
    
        if (!isset($body->nombre) || !isset($body->precio) || !isset($body->id_categoria)) {
 
            $this->view->response('Datos enviados inválidos', 400);
            return;
        }
    
        $nombre = $body->nombre;
        $precio = $body->precio;
        $id_categoria = $body->id_categoria;
    
        $id = $this->model->insertProduct($nombre, $precio, $id_categoria);
    
        $this->view->response('La tarea fue insertada con el id='.$id, 201);
    }
    
    public function updateProduct($params = null) {
        $id_producto = $params[':ID'];
        $product = $this->model->getProductByID($id_producto);
    
        if ($product) {
            $body = $this->getData();
    
            if (!isset($body->nombre) || !isset($body->precio) || !isset($body->id_categoria)) {

                $this->view->response('Datos enviados inválidos', 400);
                return;
            }
    
            $nombre = $body->nombre;
            $precio = $body->precio;
            $id_categoria = $body->id_categoria;
            $this->model->updateProduct($id_producto, $nombre, $precio, $id_categoria);
            $this->view->response("Producto id=".$id_producto." actualizado con éxito", 200);
        }
        else 
            $this->view->response("Producto id=".$id_producto." not found", 404);
    }

}