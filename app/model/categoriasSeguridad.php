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

    $consultaCategorias = $this->db->query("SELECT id_categoria, nombre_categoria FROM categorias WHERE id_categoria IN (23, 24, 25, 26, 27, 28, 29, 30, 31) AND uso=1 ORDER BY nombre_categoria");
    
    while ($listadoCategorias = $consultaCategorias -> fetch(PDO::FETCH_ASSOC)){
    
        $this->categoriaSg[]=$listadoCategorias;
    }
    return $this->categoriaSg;
}

}

?>