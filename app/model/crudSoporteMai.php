<?php
require_once('../model/vinculo.php');

class Crudsoporte{
    
public function mostrarTipoSoporte(){

        $db=conectar::acceso();
        $tipoSoporte=[];
        
        $consultarSoportemai=$db->prepare("SELECT id, nombre FROM tipo_soportemai WHERE usos=:uses ORDER BY nombre");
        $consultarSoportemai->bindValue('uses', 1);
        $consultarSoportemai->execute();
    
			while ($listadoSoporte=$consultarSoportemai->fetch(PDO::FETCH_ASSOC)) {
					$tipoSoporte[]=$listadoSoporte;	
			}
			return $tipoSoporte;
        }

       
		}

?>