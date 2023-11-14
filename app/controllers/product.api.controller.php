<?php
require_once './app/controllers/api.controller.php';
require_once './app/models/product.model.php';
require_once './app/models/categoria.model.php';

class ProductApiController extends ApiController {
    private $productModel;
    private $categoriaModel;

    public function __construct() {
        parent::__construct();
          $this->productModel = new productModel();
          $this->categoriaModel = new categoriaModel();
       }

       public function getAll($params = null) {
    
        if (isset($_GET['sort'])) {
            $orderBy = $_GET['sort'];
        } else {
            $orderBy = 'id_producto';
        }
        
        if (isset($_GET['order'])) {
            $orderDir = $_GET['order'];
        } else {
            $orderDir = 'ASC';
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        
        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
        } else {
            $limit = 50;
        }
        
        $categoria = null;
        if (isset($_GET['categoria'])) {
            $categoria = $_GET['categoria'];
        }

        if ($orderBy !== 'id_producto' && $orderBy !== 'nombre' && $orderBy !== 'precio' && $orderBy !== 'id_categoria' && $orderBy !== 'oferta') {
            $this->view->response("Campo incorrecto", 400);
            return;
        }

        if ($orderDir !== 'ASC' && $orderDir !== 'DESC' && $orderDir !== 'asc' && $orderDir !== 'desc') {
            $this->view->response("Direccion de orden incorrecta", 400);
            return;
        }

        if (!is_numeric($page) || $page < 1) {
            $this->view->response("Número de página inválido", 400);
            return;
        }
    
        if (!is_numeric($limit) || $limit < 1) {
            $this->view->response("Límite inválido", 400);
            return;
        }
        
        if ($categoria !== null && $categoria !== 'Procesadores' && $categoria !== 'Motherboards' && $categoria !== 'Placas de video') {
            $this->view->response("Categoría no válida", 400);
            return;
        }
    
        $products = $this->productModel->getProducts($orderBy, $orderDir, $page, $limit);

        if ($categoria !== null) {
            $products = array_filter($products, function($product) use ($categoria) {
                return $product->categoria === $categoria;
            });
        }

        if (empty($products)) {
            $this->view->response("No hay más productos para mostrar", 200);
        } else {
            $this->view->response($products, 200);
        }
    }

    public function get($params = null) {
        $idProduct = $params[':ID'];

        if (!is_numeric($idProduct) || $idProduct <= 0) {
            $this->view->response("ID de producto no válido", 400);
            return;
        }

        $product = $this->productModel->getProductByID($idProduct);

        if ($product)
            
            $this->view->response($product, 200);
        else
            $this->view->response("El producto con el id=$idProduct no existe", 404);

    }

    public function delete($params = null) {
        $idProduct = $params[':ID'];

        if (!is_numeric($idProduct) || $idProduct <= 0) {
            $this->view->response("ID de producto no válido", 400);
            return;
        }
        
        $success = $this->productModel->deleteProduct($idProduct);

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
    
        $id = $this->productModel->insertProduct($nombre, $precio, $id_categoria);
    
        $this->view->response('El producto fue insertado con el id='.$id, 201);
    }
    
    public function updateProduct($params = null) {
        $id_producto = $params[':ID'];
        $product = $this->productModel->getProductByID($id_producto);
    
        if ($product) {
            $body = $this->getData();
    
            if (!isset($body->nombre) || !isset($body->precio) || !isset($body->id_categoria)) {

                $this->view->response('Datos enviados inválidos', 400);
                return;
            }
    
            $nombre = $body->nombre;
            $precio = $body->precio;
            $id_categoria = $body->id_categoria;
            $this->productModel->updateProduct($id_producto, $nombre, $precio, $id_categoria);
            $this->view->response("Producto id=".$id_producto." actualizado con éxito", 200);
        }
        else 
            $this->view->response("Producto id=".$id_producto." not found", 404);
    }

    public function getOfertas($params = null) {
        $products = $this->productModel->getOfertas();
        $this->view->response($products, 200);
    }
    
    public function getOfertasPorCategoria($params = null) {
        $id_categoria = $params[':ID'];
    
        if (!is_numeric($id_categoria) || $id_categoria <= 0) {
            $this->view->response("ID de categoria no válido", 400);
            return;
        }
    
        if (!$this->categoriaModel->categoriaExiste($id_categoria)) {
            $this->view->response("La categoría con id=$id_categoria no existe", 404);
            return;
        }
    
        $productos = $this->productModel->getProductosEnOfertaPorCategoria($id_categoria);
        
        if ($productos)
            $this->view->response($productos, 200);
        else
            $this->view->response("No hay productos en oferta para la categoría con id=$id_categoria", 404);
    }
    
    
}