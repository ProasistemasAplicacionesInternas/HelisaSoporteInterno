<?php

    class Llama_maquina{
        
        private $db;
        private $maquina;
        
        public function __construct(){

            require_once("../model/vinculo.php");

            
            $this->db=Conectar::acceso();
            $this->maquina=array();           
            
        }
        
        public function get_maquina(){
            
            $consulta_maquina=$this->db->query("SELECT id_maquina, descripcion, topes  FROM maquinas  ORDER BY descripcion");
            
            while($filas_maquina=$consulta_maquina->fetch(PDO::FETCH_ASSOC)){
                
                $this->maquina[]=$filas_maquina;
            }
                return $this->maquina;
        }
        
        
    }



?>
