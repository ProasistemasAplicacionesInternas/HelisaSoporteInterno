<?php


    class Llama_tipo_servidor
    {
        
        private $db;
        
        
        public function __construct(){

            require_once("../model/vinculo.php");
            
            $this->db=Conectar::acceso();
            
        }
        
        public function getTipoServidor(){
            $tipoServidor = array(); ;
            $consulta_tipoServidor=$this->db->query("SELECT id_tipo_servidor, tipo_servidor FROM tipo_servidor  ORDER BY tipo_servidor");
            
            while($filas_tipoServidor=$consulta_tipoServidor->fetch(PDO::FETCH_ASSOC)){
                
                $tipoServidor[]=$filas_tipoServidor;
            }
                return $tipoServidor;
        }
        
        
    }



?>
