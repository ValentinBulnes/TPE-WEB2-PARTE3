<?php
require_once './app/models/config.php';
require_once './app/models/model.php';

class categoriaModel extends Model {

    public function categoriaExiste($id_categoria) {
        $query = $this->db->prepare('SELECT 1 FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    
        return $query->fetch() !== false;
    }
    
}