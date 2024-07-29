<?php


     class Categoria{
        
        private $db;
        private $categoria;
        
        public function __construct(){
            
            require_once("../model/vinculo.php");
            $this->db=Conectar::acceso();
            $this->categoria=array();           
            
        }
        
        public function getCategoria(){
            
            $consulta_categorias = $this->db->query("SELECT id_categoria, nombre_categoria FROM categorias WHERE id_categoria NOT IN (3, 10, 11, 14, 23, 24, 25, 26, 27, 28, 29, 30, 31) AND uso=1 ORDER BY nombre_categoria");

            
        while($listado_categorias=$consulta_categorias->fetch(PDO::FETCH_ASSOC)){

             $this->categoria[]=$listado_categorias;
        }
        return $this->categoria;
       }


  }



?>