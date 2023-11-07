<?php
require_once './app/models/config.php';

class categoriaModel {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
    
    function getCategorias() {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    function insertCategoria($nombre) {
        // Obtén el ID más alto actualmente en la tabla
        $query = $this->db->prepare('SELECT MAX(id_categoria) AS max_id FROM categorias');
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $max_id = $result['max_id'];
    
        // Incrementa el ID
        $new_id = $max_id + 1;
    
        // Inserta la nueva categoría en el id mas alto
        $query = $this->db->prepare('INSERT INTO categorias (id_categoria, nombre) VALUES (?, ?)');
        return $query->execute([$new_id, $nombre]);
    }
    
    public function deleteCategoria($id_categoria) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }
    

    function getCategoriaByName($nombre) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE nombre = ?');
        $query->execute([$nombre]);
    
        $categoria = $query->fetch(PDO::FETCH_OBJ);
    
        return $categoria;
    }
    
    function updateCategoria($id_categoria, $nombre) {
        $query = $this->db->prepare('UPDATE categorias SET nombre = ? WHERE id_categoria = ?');
        return $query->execute([$nombre, $id_categoria]);
    }
}