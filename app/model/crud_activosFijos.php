<?php 
require_once('../model/vinculo.php');
require_once('../model/datos_acceso.php');

class crudActivos{

//**********************************************************************************************//
//*********************************SQL PARA CREAR ACTIVOS***************************************//
//**********************************************************************************************//
	
	public function crearActivos($create){
		$db=conectar::acceso();
		$validacion_activo=$db->prepare('SELECT codigo_activo,serial_activo FROM activos_internos WHERE codigo_activo=:codigo');
		// OR serial_activo=:seriales
		$validacion_activo->bindValue('codigo',$create->getAf_codigo());
		//$validacion_activo->bindValue('seriales',$create->getAf_serial());
		$validacion_activo->execute();
		$resultadoVal=$validacion_activo->rowCount();
		if ($resultadoVal!=0) {
			echo 3;
		}else if ($resultadoVal==0){

				$db=conectar::acceso();
						$crear_activo=$db->prepare("INSERT INTO activos_internos(codigo_activo,serial_activo,nombre_activo,estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, imagen, valor, tipo_activo, vida_util, condicion, Id_categoria ) VALUES(:codigo_activo, :serial_activo, :nombre_activo, :estado_activo, :marca_activo, :modelo_activo, :fecha_compra, :grupo_activo, :area_activo, :ubicacion_activo,:responsable_activo, :fecha_asignacion, :observaciones_activo, :ram_activo, :disco_activo, :procesador_activo, :licencia_office, :licencia_antivirus, :aplicaciones_activo, :licencia_sistema, :dominio, :sistema_operativo, :imagen, :valor, :tipo_activo, :vida_util, :condicion, :Id_categoria)");						$crear_activo->bindValue('codigo_activo',$create->getAf_codigo());
						$crear_activo->bindValue('codigo_activo',$create->getAf_codigo());
						$crear_activo->bindValue('serial_activo',$create->getAf_serial());
						$crear_activo->bindValue('nombre_activo',$create->getAf_nombre());
						$crear_activo->bindValue('estado_activo',$create->getAf_estado());
						$crear_activo->bindValue('marca_activo',$create->getAf_marca());
						$crear_activo->bindValue('modelo_activo',$create->getAf_modelo());
						$crear_activo->bindValue('fecha_compra',$create->getAf_fechaCompra());
						$crear_activo->bindValue('grupo_activo',$create->getAf_grupo());
						$crear_activo->bindValue('area_activo',$create->getAf_area());
						$crear_activo->bindValue('ubicacion_activo',$create->getAf_ubicacion());
						$crear_activo->bindValue('responsable_activo',$create->getAf_funcionario());
						$crear_activo->bindValue('fecha_asignacion',$create->getAf_fechaAsignacion()); 
						$crear_activo->bindValue('observaciones_activo',$create->getAf_observaciones());
						$crear_activo->bindValue('ram_activo',$create->getAf_ram());
						$crear_activo->bindValue('disco_activo',$create->getAf_disco());
						$crear_activo->bindValue('procesador_activo',$create->getAf_procesador());
						$crear_activo->bindValue('licencia_office',$create->getAf_licenciaOffice());
						$crear_activo->bindValue('licencia_antivirus',$create->getAf_licenciaAntivirus());
						$crear_activo->bindValue('aplicaciones_activo',$create->getAf_aplicaciones());
						$crear_activo->bindValue('licencia_sistema',$create->getAf_licenciaSO());
						$crear_activo->bindValue('dominio',$create->getAf_dominio());
						$crear_activo->bindValue('sistema_operativo',$create->getAf_sistemaOperativo());
						$crear_activo->bindValue('imagen',$create->getImagenactivo());
						$crear_activo->bindValue('valor',$create->getcostoCompra());
						$crear_activo->bindValue('tipo_activo',$create->gettipoAct());
						$crear_activo->bindValue('vida_util',$create->getvidaUtil());
						$crear_activo->bindValue('condicion',$create->getestadoAct());
						$crear_activo->bindValue('Id_categoria',$create->gettraCategoria());
						$crear_activo->execute();
						$ultimo_id = $db->lastInsertId();

				if ($crear_activo) {
					echo 1;
					$colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
						$colsultar_usuario->bindValue('usuario', $create->getNombre());
						$colsultar_usuario->execute();
						$filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
						$id_usuario=$filtro['id_usuario'];
						$funcion_realizada = "El usuario Realizo una insercion de un nuevo activo";
						$inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
						$inserta_funcion->bindValue('id_usuario',$id_usuario);
						$inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
						$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
						$inserta_funcion->execute();
							$descripcion = "Se realiza asignacion al momento de registrar el activo";	
							$crea_traslado=$db->prepare('INSERT INTO traslados(funcionario_inicial, fecha_asignado, funcionario_final, fecha_traslado, activo_traslado, descripcion_traslado, estado_traslado )VALUES(:t_funcionarioI, :t_fechaA, :t_funcionarioF, :t_fechaT, :t_activo, :t_descripcion, :estado)');
							$crea_traslado->bindValue('t_funcionarioI',$create->getAf_funcionario());
							$crea_traslado->bindValue('t_fechaA',$create->getAf_fechaCompra());
							$crea_traslado->bindValue('t_funcionarioF',$create->getAf_funcionario());
							$crea_traslado->bindValue('t_fechaT',$create->getAf_fechaAsignacion());
							$crea_traslado->bindValue('t_activo',$ultimo_id);
							$crea_traslado->bindValue('t_descripcion',$descripcion);            
							$crea_traslado->bindValue('estado',3);            
							$crea_traslado->execute();
				}else{
					echo 0;
				}
			}
			
	}

//**********************************************************************************************//
//******************************** SQL PARA MODIFICAR ACTIVOS **********************************//
//**********************************************************************************************//

	public function modificarActivos($update){

					$db=conectar::acceso();
					$modificar_activo=$db->prepare("UPDATE activos_internos SET serial_activo=:serial_activo, nombre_activo=:nombre_activo, estado_activo=:estado_activo, marca_activo=:marca_activo, modelo_activo=:modelo_activo, fecha_compra=:fecha_compra, grupo_activo=:grupo_activo, area_activo=:area_activo, ubicacion_activo=:ubicacion_activo, observaciones_activo=:observaciones_activo, ram_activo=:ram_activo, disco_activo=:disco_activo, procesador_activo=:procesador_activo, licencia_office=:licencia_office, licencia_antivirus=:licencia_antivirus, aplicaciones_activo=:aplicaciones_activo, licencia_sistema=:licencia_sistema, dominio=:dominio, sistema_operativo=:sistema_operativo, imagen=:imagen, valor=:valor, tipo_activo=:tipo_activo, vida_util=:vida_util, condicion=:condicion, Id_categoria=:Id_categoria WHERE codigo_activo=:codigo_activo");

					$modificar_activo->bindValue('codigo_activo',$update->getAf_codigo());
					$modificar_activo->bindValue('serial_activo',$update->getAf_serial());
					$modificar_activo->bindValue('nombre_activo',$update->getAf_nombre());
					$modificar_activo->bindValue('estado_activo',$update->getAf_estado());
					$modificar_activo->bindValue('marca_activo',$update->getAf_marca());
					$modificar_activo->bindValue('modelo_activo',$update->getAf_modelo());
					$modificar_activo->bindValue('fecha_compra',$update->getAf_fechaCompra());
					$modificar_activo->bindValue('grupo_activo',$update->getAf_grupo());
					$modificar_activo->bindValue('area_activo',$update->getAf_area());
					$modificar_activo->bindValue('ubicacion_activo',$update->getAf_ubicacion());
					$modificar_activo->bindValue('observaciones_activo',$update->getAf_observaciones());
					$modificar_activo->bindValue('ram_activo',$update->getAf_ram());
					$modificar_activo->bindValue('disco_activo',$update->getAf_disco());
					$modificar_activo->bindValue('procesador_activo',$update->getAf_procesador());
					$modificar_activo->bindValue('licencia_office',$update->getAf_licenciaOffice());
					$modificar_activo->bindValue('licencia_antivirus',$update->getAf_licenciaAntivirus());
					$modificar_activo->bindValue('aplicaciones_activo',$update->getAf_aplicaciones());
					$modificar_activo->bindValue('licencia_sistema',$update->getAf_licenciaSO());
					$modificar_activo->bindValue('dominio',$update->getAf_dominio());
					$modificar_activo->bindValue('sistema_operativo',$update->getAf_sistemaOperativo());
					$modificar_activo->bindValue('imagen',$update->getImagenactivo());
					$modificar_activo->bindValue('valor',$update->getcostoCompra());
					$modificar_activo->bindValue('tipo_activo',$update->gettipoAct());
					$modificar_activo->bindValue('vida_util',$update->getvidaUtil());
					$modificar_activo->bindValue('condicion',$update->getestadoAct());
					$modificar_activo->bindValue('Id_categoria',$update->gettraCategoria());
					$modificar_activo->execute();
					//historial de movimientos 
					if ($modificar_activo) {
							echo 1;
							$colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
							$colsultar_usuario->bindValue('usuario', $update->getNombre());
							$colsultar_usuario->execute();
							$filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
							$id_usuario=$filtro['id_usuario'];
							$funcion_realizada = "El usuario Realizo una Actualizacion de un  activo";
							$inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
							$inserta_funcion->bindValue('id_usuario',$id_usuario);
							$inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
							$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
							$inserta_funcion->execute();
					}else{
						echo 0;
					}
					
	}
	
//**********************************************************************************************//
//*********************************SQL PARA CONSULTAR ACTIVOS***********************************//
//**********************************************************************************************//

	public function consultarActivos(){
					$db=conectar::acceso();
					$lista_activos=[];
					$consultar_activo=$db->query("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, imagen, valor, tipo_activo, vida_util, condicion, Id_categoria FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo");
					//$i = 0;
					foreach ($consultar_activo->fetchALL() as $listado) {
						
						/*echo $i." ".$listado['responsable'];*/
						$consulta = new activosFijos();
						$consulta->setAf_id($listado['id_activo']);
						$consulta->setAf_codigo($listado['codigo_activo']);
						$consulta->setAf_serial($listado['serial_activo']);
						$consulta->setAf_nombre($listado['nombre_activo']);
						$consulta->setAf_estado($listado['estado']);
						$consulta->setAf_marca($listado['marca_activo']);
						$consulta->setAf_modelo($listado['modelo_activo']);
						$consulta->setAf_fechaCompra($listado['fecha_compra']);
						$consulta->setAf_grupo($listado['grupo_activo']);
						$consulta->setAf_area($listado['area_activo']);
						$consulta->setAf_ubicacion($listado['ubicacion_activo']);
						$consulta->setAf_funcionario($listado['responsable']);
						$consulta->setIdentidad_funcionario($listado['responsable_activo']);
						$consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
						$consulta->setAf_observaciones($listado['observaciones_activo']);
						$consulta->setAf_ram($listado['ram_activo']);
						$consulta->setAf_disco($listado['disco_activo']);
						$consulta->setAf_procesador($listado['procesador_activo']);
						$consulta->setAf_licenciaOffice($listado['licencia_office']);
						$consulta->setAf_licenciaAntivirus($listado['licencia_antivirus']);
						$consulta->setAf_dominio($listado['dominio']);
						$consulta->setAf_aplicaciones($listado['aplicaciones_activo']);
						$consulta->setAf_licenciaSO($listado['licencia_sistema']);
						$consulta->setAf_sistemaOperativo($listado['sistema_operativo']);
						$consulta->setImagenactivo($listado['imagen']);
						$consulta->setcostoCompra($listado['valor']);
						$consulta->settipoAct($listado['tipo_activo']);
						$consulta->setvidaUtil($listado['vida_util']);
						$consulta->setestadoAct($listado['condicion']);
						$consulta->settraCategoria($listado['Id_categoria']);
						$lista_activos[]=$consulta;
					}
					return $lista_activos;
	}

//**********************************************************************************************//
//******************* CONSULTA EL AREA,RESPONSABLE Y GRUPO DEL ACTIVO **************************//
//**************** PARA QUE AL MODIFICARLO TRAIGA LOS CORRESPONDIENTES *************************//
//**********************************************************************************************//

public function consultaModificarActivo(){

		$db=conectar::acceso();
		$consultaModificarActivo=$db->prepare('SELECT funcionarios.identificacion, funcionarios.nombre, areas.id_area, areas.descripcion AS descripcion1, grupos_activos.id_grupo, grupos_activos.nombre_grupo, estado.id_estado, estado.descripcion AS nombre_estado  FROM activos_internos LEFT JOIN funcionarios ON funcionarios.identificacion=responsable_activo LEFT JOIN areas ON areas.id_area=activos_internos.area_activo LEFT JOIN grupos_activos ON grupos_activos.id_grupo=grupo_activo LEFT JOIN estado ON estado.id_estado=estado_activo WHERE codigo_activo=:af_codigo');

		$consultaModificarActivo->bindValue('af_codigo',$_POST['af_codigo']);
		$consultaModificarActivo->execute();
		$datosConsulta=$consultaModificarActivo->fetch(PDO::FETCH_ASSOC);
		return $datosConsulta;
	}

//**********************************************************************************************//
//****************** SQL PARA CONSULTAR ACTIVOS DESDE EL LOGIN DEL FUNCIONARIO *****************//
//***************** SOLO CONSULTA LOS ACTIVOS QUE TIENE EL USUARIO DE LA SESSION ***************//
//**********************************************************************************************//

public function consultarActivosfuncionario(){
	$db=conectar::acceso();
	$lista_activos=[];
	$buscarIdentidad=$db->prepare("SELECT identificacion FROM funcionarios WHERE usuario=:usuarioS");
	$buscarIdentidad->bindValue('usuarioS',$_SESSION['usuario']);
	$buscarIdentidad->execute();
	$resultado=$buscarIdentidad->fetch();
		if ($resultado!=0) {
	 		$db=conectar::acceso();
	 		$consultar_activo=$db->prepare("SELECT codigo_activo, serial_activo, nombre_activo, fecha_asignacion, grupos_activos.area_grupo FROM activos_internos LEFT JOIN grupos_activos ON grupo_activo = id_grupo WHERE responsable_activo=:identidad");
	 		$consultar_activo->bindValue('identidad',$resultado['identificacion']);
	 		$consultar_activo->execute();
	 	foreach ($consultar_activo->fetchALL() as $listado) {
	 		$consulta = new activosFijos();
	 		$consulta->setAf_codigo($listado['codigo_activo']);
	 		$consulta->setAf_serial($listado['serial_activo']);
	 		$consulta->setAf_nombre($listado['nombre_activo']);
	 		$consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
	 		$consulta->setAf_areaCreacion($listado['area_grupo']);
	 		$lista_activos[]=$consulta;
	 	}
	 return $lista_activos;
	 }
}
		
	

//**********************************************************************************************//
//****************** SQL PARA CONSULTAR ACCESOS DESDE EL LOGIN DEL FUNCIONARIO *****************//
//***************** SOLO CONSULTA LOS ACCESOS QUE TIENE EL USUARIO DE LA SESSION ***************//
//**********************************************************************************************//

	public function consultarAccesosfuncionario(){

		$db=conectar::acceso();
		$listaAccesos=[];
		$buscarIdentidadA=$db->prepare("SELECT identificacion FROM funcionarios WHERE usuario=:usuarioA");
				$buscarIdentidadA->bindValue('usuarioA',$_SESSION['usuario']);
				$buscarIdentidadA->execute();
				$identificacion=$buscarIdentidadA->fetch();

				if($identificacion!=0){
					$db=conectar::acceso();
						$consultarAccesos=$db->prepare("SELECT tipo_acceso,estado,id_usuario,fecha_registro, usuario AS nombreUsuario, tipos_accesos.descripcion AS tiposAccesos, estado.descripcion as estadosA FROM accesos LEFT JOIN tipos_accesos ON id_accesos=tipo_acceso LEFT JOIN estado ON id_estado=estado WHERE id_usuario=:identidadA");		
						$consultarAccesos->bindValue('identidadA',$identificacion['identificacion']);
						$consultarAccesos->execute();

						foreach ($consultarAccesos->fetchAll() as $lista) {
							$consulta = new Accesos();
							$consulta->setId_usuario($lista['id_usuario']);
							$consulta->setUsuario($lista['nombreUsuario']);
							$consulta->setFechaRegistro($lista['fecha_registro']);
							$consulta->setTipoAcceso($lista['tipo_acceso']);
							$consulta->setDescripcionAcceso($lista['tiposAccesos']);
							$consulta->setEstadoA($lista['estado']);
							$consulta->setDescripcionEstado($lista['estadosA']);

							$listaAccesos[]=$consulta;

						}

						return $listaAccesos;

				}

	}




//**********************************************************************************************//
//****************** SQL*PARA*CONSULTAR*PETICIONES,MANTENIMIENTOS*Y*TRASLADOS ******************//
//***************** PARA EL BOTON DE VER ACTIVIDADES DE LA CARTILLA DE ACTIVOS ******************//
//**********************************************************************************************//

	public function peticionesActivo(){

			$db=conectar::acceso();
			$lista_peticiones=[];
			$consultar_peticion=$db->prepare('SELECT  numero_peticion, fecha_peticion, peticiones.usuario, fecha_atendido, peticiones.estado, peticiones.categoria, peticiones.descripcion, peticiones.imagen, activos_internos.nombre_activo, funcionarios.extension, funcionarios.area,funcionarios.mail, areas.descripcion AS descripcion1, categorias.nombre_categoria, estado.descripcion AS nombreestado, conclusiones, usuario_atiende FROM peticiones LEFT JOIN funcionarios ON funcionarios.usuario=peticiones.usuario LEFT JOIN areas ON id_area=area LEFT JOIN categorias ON id_categoria=categoria LEFT JOIN estado ON id_estado=peticiones.estado LEFT JOIN activos_internos ON id_activo=activo WHERE activo=:idActivo');
				$consultar_peticion->bindValue('idActivo',$_POST['af_id']);
				$consultar_peticion->execute();

						foreach ($consultar_peticion->fetchAll() as $listado) {
							$consulta = new Peticion();
							$consulta->setP_nropeticion($listado['numero_peticion']);
							$consulta->setP_fechapeticion($listado['fecha_peticion']);	
							$consulta->setP_usuario($listado['usuario']);	
			                $consulta->setP_fechaatendido($listado['fecha_atendido']);
			                $consulta->setP_usuarioatiende($listado['usuario_atiende']);
							$consulta->setP_estado($listado['nombreestado']);	
							$consulta->setP_categoria($listado['nombre_categoria']);
							$consulta->setP_descripcion($listado['descripcion']);	
							$consulta->setP_cargarimagen($listado['imagen']);	
							$consulta->setP_activo($listado['nombre_activo']);	
							$consulta->setP_area($listado['descripcion1']);
							$consulta->setP_Extension($listado['extension']);
							$consulta->setP_correo($listado['mail']);
							$consulta->setP_conclusiones($listado['conclusiones']);	
							
							$lista_peticiones[]=$consulta;	
						}
						return $lista_peticiones;
		}

	public function mantenimientosActivo(){
					$db=conectar::acceso();
					$lista_mantenimientos=[];
					$consultar_mantenimiento=$db->prepare('SELECT codigo_mantenimiento, fecha_mantenimiento, descripcion_mantenimiento, responsable_mantenimiento, costo_mantenimiento, activo_mantenimiento, documentos FROM mantenimientos WHERE activo_mantenimiento=:idActivo');
						$consultar_mantenimiento->bindValue('idActivo',$_POST['af_id']);
						$consultar_mantenimiento->execute();

						foreach ($consultar_mantenimiento->fetchAll() as $listadoM) {
							$consulta = new mantenimientos();
							$consulta->setCodigo_mantenimiento($listadoM['codigo_mantenimiento']);
							$consulta->setFecha_mantenimiento($listadoM['fecha_mantenimiento']);	
							$consulta->setDescripcion_mantenimiento($listadoM['descripcion_mantenimiento']);	
                			$consulta->setResponsable_mantenimiento($listadoM['responsable_mantenimiento']);
							$consulta->setCosto_mantenimiento($listadoM['costo_mantenimiento']);	
							$consulta->setActivo_mantenimiento($listadoM['activo_mantenimiento']);	
							$consulta->setPdfmantenimientos($listadoM['documentos']);	
				
							$lista_mantenimientos[]=$consulta;	
						}
						return $lista_mantenimientos;
			}

	public function trasladosActivo(){
					
					$db=conectar::acceso();
					$lista_traslados=[];
					$consultar_traslado=$db->prepare('SELECT id_traslado, funcionario_inicial AS inicial, fecha_asignado, funcionario_final as final, fecha_traslado, activo_traslado, descripcion_traslado, final.nombre AS nombre_final, inicial.nombre AS nombre_inicial FROM traslados LEFT JOIN funcionarios final ON final.identificacion=funcionario_final LEFT JOIN funcionarios inicial ON inicial.identificacion= funcionario_inicial WHERE activo_traslado=:idActivo');
						$consultar_traslado->bindValue('idActivo',$_POST['af_id']);
						$consultar_traslado->execute();

							foreach ($consultar_traslado->fetchAll() as $listadoT) {
								$consulta = new traslados();
								$consulta->setId_traslado($listadoT['id_traslado']);
								$consulta->setFuncionario_inicial($listadoT['nombre_inicial']);	
								$consulta->setFecha_inicial($listadoT['fecha_asignado']);	
				                $consulta->setFuncionario_final($listadoT['nombre_final']);
								$consulta->setFecha_traslado($listadoT['fecha_traslado']);	
								$consulta->setActivo_traslado($listadoT['activo_traslado']);
								$consulta->setDescripcion_traslado($listadoT['descripcion_traslado']);	
								
								$lista_traslados[]=$consulta;	
							}
							return $lista_traslados;
			}
}
?>