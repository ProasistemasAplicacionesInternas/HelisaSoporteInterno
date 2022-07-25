<?php
    
  

    class Llama_estados{
        
        private $db;
        private $estados;
        
        public function __construct(){

            require_once("../model/vinculo.php");
            
            $this->db=Conectar::acceso();
            $this->estados=array();           
            
        }
        
        public function get_estados(){
            
            $consulta_estados=$this->db->query("SELECT id_estado, descripcion FROM estado WHERE id_estado=5 OR id_estado=6 OR id_estado=7  ORDER BY descripcion");
            
            while($filas_estados=$consulta_estados->fetch(PDO::FETCH_ASSOC)){
                
                $this->estados[]=$filas_estados;
            }
                return $this->estados;
        }



         public function get_estado(){
            
            $consulta_estado=$this->db->query("SELECT id_estado, descripcion FROM estado WHERE id_estado=5 OR id_estado=6  ORDER BY descripcion");
            
            while($filas_estado=$consulta_estado->fetch(PDO::FETCH_ASSOC)){
                
                $this->estado[]=$filas_estado;
            }
                return $this->estado;
        }



        
        
    }



?>
