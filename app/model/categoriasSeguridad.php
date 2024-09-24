<?php

class categoriaSg{

private $db;
private $categoriaSg;

public function __construct(){

    require_once("../model/vinculo.php");
    $this->db=conectar::acceso();
    $this->categoriaSg=array();
}

public function getcategoriaSg(){

    $consultaCategorias = $this->db->query("SELECT id_categoria, nombre_categoria FROM categorias_sg WHERE id_categoria IN (1, 2, 3, 4, 5, 6, 7, 8, 9) AND uso=1 ORDER BY nombre_categoria");
    
    while ($listadoCategorias = $consultaCategorias -> fetch(PDO::FETCH_ASSOC)){
    
        $this->categoriaSg[]=$listadoCategorias;
    }
    return $this->categoriaSg;
}

}

?>