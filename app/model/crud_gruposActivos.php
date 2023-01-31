<?php 
require_once('../model/vinculo.php');

class crudGrupos{
	
//*********************************************************************************************************//
//*********** Crud para crear la matriz que muestra las grupos al crear un activo *********************//
//*********************************************************************************************************//	

public function mostrarGrupos(){

			$db=conectar::acceso();
			$grupos=[];

			$consultar_grupos=$db->query('SELECT  id_grupo,nombre_grupo,area_grupo FROM grupos_activos ORDER BY nombre_grupo');

			while ($listado_grupos=$consultar_grupos->fetch(PDO::FETCH_ASSOC)) {
					$grupos[]=$listado_grupos;	
			}
			return $grupos;
		}
}
?>