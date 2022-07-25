<?php 
//**********************************************************************************************//
//************ SQL*PARA*CONSULTAR*ACTIVOS*PARA*PETICIONES*INTERNAS*DEL*FUNCIONARIO *************//
/* CREAR*MATRIZ*DE*ACTIVOS*ASOCIADOS*AL*FUNCIONARIO*Y*SE*MUESTRA*AL*MOMENTO*DE*GENERAR*LA*PETICION */
//**********************************************************************************************//
class consultar_activos{
	public function matrizActivosFuncionario(){

			$db=conectar::acceso();
			$buscarIdentidad1=$db->prepare("SELECT identificacion FROM funcionarios WHERE usuario=:usuarioS");
				$buscarIdentidad1->bindValue('usuarioS',$_SESSION['usuario']);
				$buscarIdentidad1->execute();
				$resultado1=$buscarIdentidad1->fetch();
				
				if ($resultado1!=0) {
						$db=conectar::acceso();	
						$activosResponsable=[];
						$consultar_activo=$db->prepare("SELECT id_activo, serial_activo, codigo_activo, nombre_activo, fecha_asignacion FROM activos_internos WHERE responsable_activo=:identidad");
							$consultar_activo->bindValue('identidad',$resultado1['identificacion']);
							$consultar_activo->execute();
							
							while ($listado_activos=$consultar_activo->fetch(PDO::FETCH_ASSOC)) {
										$activosResponsable[]=$listado_activos;
							}
							return $activosResponsable;
				} else {echo "<option value='" . $identificacionResponsable="800042928". "'>". $nombreResponsable="AREA INFRAESTRUCTURA". "    </option>";}
	}
}?>