<?php
require_once('../model/vinculo.php');

class Crudsoporte{
    
public function mostrartipoSoporte(){

        $db=conectar::acceso();
        $tipoSoporte=[];
        
        $consultar_soportemai=$db->prepare("SELECT id, nombre FROM tipo_soportemai WHERE usos=:uses ORDER BY nombre");
        $consultar_soportemai->bindValue('uses', 1);
        $consultar_soportemai->execute();
    
			while ($listado_soporte=$consultar_soportemai->fetch(PDO::FETCH_ASSOC)) {
					$tipoSoporte[]=$listado_soporte;	
			}
			return $tipoSoporte;
        }

       
		}






?>