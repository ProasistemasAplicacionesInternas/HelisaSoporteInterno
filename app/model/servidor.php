<?php

    class Llama_servidor{
        
        private $db;
        private $servidor;
        
        public function __construct(){

            require_once("../model/vinculo.php");

            
            $this->db=Conectar::acceso();
            $this->servidor=array();           
            
        }
        
        public function get_servidor(){
            
            $consulta_servidor=$this->db->query("SELECT id_servidor, descripcion FROM servidores  ORDER BY descripcion");
            
            while($filas_servidor=$consulta_servidor->fetch(PDO::FETCH_ASSOC)){
                
                $this->servidor[]=$filas_servidor;
            }
                return $this->servidor;
        }
        
        
    }



?>
