<?php


     class Ciudad{
        
        private $db;
        private $ciudad;
        
        public function __construct(){
            
            require_once("../model/vinculo.php");
            $this->db=Conectar::acceso();
            $this->ciudad=array();           
            
        }
        
        public function getCiudad(){
            
            $consulta_ciudades=$this->db->query("SELECT codigo_ciudad, ciudad, departamentos.departamento as departamento  FROM ciudades LEFT JOIN departamentos ON departamentos.codigo_departamento=ciudades.codigo_departamento ORDER BY ciudad");
            
        while($listado_ciudades=$consulta_ciudades->fetch(PDO::FETCH_ASSOC)){

             $this->ciudad[]=$listado_ciudades;
        }
        return $this->ciudad;
       }


  }



?>
