<?php
require_once './app/models/config.php';
require_once './app/models/model.php';

class productModel extends Model {

    function getProducts() {
        $query = $this->db->prepare('SELECT productos.*, categorias.nombre AS categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria');
        $query->execute();
    
        $products = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $products;
    }
    
    function getProductByID($id) {
        $query = $this->db->prepare('SELECT productos.*, categorias.nombre AS categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria WHERE productos.id_producto = ?');
        $query->execute([$id]);
    
        $product = $query->fetch(PDO::FETCH_OBJ);
    
        return $product;
    }
    
    public function getProductsByCategoria($categoria) {
        $query = $this->db->prepare('SELECT productos.*, categorias.nombre as categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id_categoria WHERE categorias.nombre = ?');
        $query->execute([$categoria]);
    
        $products = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $products;
    }

    function insertProduct($nombre, $precio, $categoria) {
        $query = $this->db->prepare('INSERT INTO productos (nombre, precio, id_categoria) VALUES(?,?,?)');
        $query->execute([$nombre, $precio, $categoria]);

        return $this->db->lastInsertId();
    }

    function deleteProduct($id_producto) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id_producto]);
        
        return $query->rowCount();
    }

    function updateProduct($id_producto, $nombre, $precio, $categoria) {
        $query = $this->db->prepare('UPDATE productos SET nombre = ?, precio = ?, id_categoria = ? WHERE id_producto = ?');

        return $query->execute([$nombre, $precio, $categoria, $id_producto]);
    }

    public function getProductosEnOfertaPorCategoria($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE oferta = true AND id_categoria = ?');
        $query->execute([$id_categoria]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
}