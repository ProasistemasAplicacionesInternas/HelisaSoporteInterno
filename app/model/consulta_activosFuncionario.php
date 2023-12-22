<?php 
//**********************************************************************************************//
//************ SQL*PARA*CONSULTAR*ACTIVOS*PARA*PETICIONES*INTERNAS*DEL*FUNCIONARIO *************//
/* CREAR*MATRIZ*DE*ACTIVOS*ASOCIADOS*AL*FUNCIONARIO*Y*SE*MUESTRA*AL*MOMENTO*DE*GENERAR*LA*PETICION */
//**********************************************************************************************//
class consultarActivos{
	public function matrizActivosFuncionario(){

			$db=conectar::acceso();
			$buscarIdentidad1=$db->prepare("SELECT identificacion FROM funcionarios WHERE usuario=:usuarioS");
				$buscarIdentidad1->bindValue('usuarioS',$_SESSION['usuario']);
				$buscarIdentidad1->execute();
				$resultado1=$buscarIdentidad1->fetch();
				
				if ($resultado1!=0) {
						$db=conectar::acceso();	
						$activosResponsable=[];
						$consultarActivo=$db->prepare("SELECT id_activo, serial_activo, codigo_activo, nombre_activo, fecha_asignacion FROM activos_internos WHERE responsable_activo=:identidad");
							$consultarActivo->bindValue('identidad',$resultado1['identificacion']);
							$consultarActivo->execute();
							
							while ($listadoActivos=$consultarActivo->fetch(PDO::FETCH_ASSOC)) {
										$activosResponsable[]=$listadoActivos;
							}
							return $activosResponsable;
				} 
	}
}?>