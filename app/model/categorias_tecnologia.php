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
            
            $consulta_categorias=$this->db->query("SELECT id_categoria, nombre_categoria FROM categorias WHERE id_categoria!=3 AND id_categoria!=10 AND id_categoria!=11 AND id_categoria!=14 AND uso=1 ORDER BY nombre_categoria");
            
        while($listado_categorias=$consulta_categorias->fetch(PDO::FETCH_ASSOC)){

             $this->categoria[]=$listado_categorias;
        }
        return $this->categoria;
       }


  }



?>