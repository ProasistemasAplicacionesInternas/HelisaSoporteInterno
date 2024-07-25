<?php
require_once('../model/vinculo.php');

class CrudMantenimientos
{

	//***************************************************************************************//
//**************************** SQL PARA CREAR mantenimiento *****************************//
//***************************************************************************************//

	public function crearMantenimiento($create)
	{
		$db = Conectar::acceso();
		$crea_mantenimiento = $db->prepare('INSERT INTO mantenimientos(fecha_mantenimiento, descripcion_mantenimiento, responsable_mantenimiento, 
			costo_mantenimiento, activo_mantenimiento, documentos, repotenciacion, mejora, costo_mejora, condicion )
			VALUES(:m_fecha, :m_descripcion, :m_responsable, :m_costo, :m_activo, :m_documento, :m_repotenciacion, :mejora, :costo_mejora, :condicion)');

		$crea_mantenimiento->bindValue('m_fecha', $create->getFecha_mantenimiento());
		$crea_mantenimiento->bindValue('m_descripcion', $create->getDescripcion_mantenimiento());
		$crea_mantenimiento->bindValue('m_responsable', $create->getResponsable_mantenimiento());
		$crea_mantenimiento->bindValue('m_costo', $create->getCosto_mantenimiento());
		$crea_mantenimiento->bindValue('m_activo', $create->getActivo_mantenimiento());
		$crea_mantenimiento->bindValue('m_documento', $create->getPdfmantenimientos());
		$crea_mantenimiento->bindValue('m_repotenciacion', $create->getRepotenciacion());
		$crea_mantenimiento->bindValue('mejora', $create->getMejora());
		$crea_mantenimiento->bindValue('costo_mejora', $create->getCostoMejora());
		$crea_mantenimiento->bindValue('condicion', $create->getCondicionActual());
		$crea_mantenimiento->execute();

		$updateActivosInternos  = $db->prepare("UPDATE activos_internos SET condicion=:condicion WHERE id_activo=:m_activo");
		$updateActivosInternos->bindValue('condicion', $create->getCondicionActual());
		$updateActivosInternos->bindValue('m_activo', $create->getActivo_mantenimiento());
		$updateActivosInternos->execute();

		$colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
		$colsultar_usuario->bindValue('usuario', $create->getResponsable_mantenimiento());
		$colsultar_usuario->execute();
		$filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
		$id_usuario = $filtro['id_usuario'];
		$funcion_realizada = "El usuario Realizo un mantenimiento de un activo, identificado como : " . $create->getActivo_mantenimiento() . " y costo " . $create->getCosto_mantenimiento();
		$inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
		$inserta_funcion->bindValue('id_usuario', $id_usuario);
		$inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
		$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
		$inserta_funcion->execute();




	}

	//***************************************************************************************//
//**************************** SQL PARA CREAR repotenciacion*****************************//
//***************************************************************************************//
	public function realizaRepotenciacion($create)
	{
		$db = conectar::acceso();
		$modificar_activo = $db->prepare("UPDATE activos_internos SET  ram_activo=:ram_activo, disco_activo=:disco_activo, procesador_activo=:procesador_activo,    licencia_sistema=:licencia_sistema, sistema_operativo=:sistema_operativo WHERE id_activo=:codigo_activo");
		$modificar_activo->bindValue('ram_activo', $create->getRamrepowering());
		$modificar_activo->bindValue('disco_activo', $create->getDiskrepowering());
		$modificar_activo->bindValue('procesador_activo', $create->getCorerepowering());
		$modificar_activo->bindValue('licencia_sistema', $create->getSorepowering());
		$modificar_activo->bindValue('sistema_operativo', $create->getLicenciarepowering());
		$modificar_activo->bindValue('codigo_activo', $create->getActivo_mantenimiento());
		$modificar_activo->execute();
		//historial de movimientos 
		$colsultar_usuario = $db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
		$colsultar_usuario->bindValue('usuario', $create->getResponsable_mantenimiento());
		$colsultar_usuario->execute();
		$filtro = $colsultar_usuario->fetch(PDO::FETCH_ASSOC);
		$id_usuario = $filtro['id_usuario'];
		$funcion_realizada = "El usuario Realizo una la actualizacion del activo fijo " . $create->getActivo_mantenimiento() . ", Ram: " . $create->getRamrepowering() . " , Disco duro: " . $create->getDiskrepowering() . ",   Procesador: " . $create->getCorerepowering() . ", Sistema operativo: " . $create->getSorepowering() . ", Licencia sistema: " . $create->getLicenciarepowering() . " ";
		$inserta_funcion = $db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
		$inserta_funcion->bindValue('id_usuario', $id_usuario);
		$inserta_funcion->bindValue('funcion_realizada', $funcion_realizada);
		$inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);
		$inserta_funcion->execute();
	}


	//****************************************************************************************//
//************************ SQL PARA CONSULTAR mantenimientoS *****************************//
//****************************************************************************************//

	public function consultarMantenimientos()
	{
		$db = conectar::acceso();
		$lista_mantenimientos = [];
		$consultar_mantenimiento = $db->query('SELECT  codigo_mantenimiento, fecha_mantenimiento, descripcion_mantenimiento, responsable_mantenimiento, costo_mantenimiento, activo_mantenimiento FROM mantenimientos');

		foreach ($consultar_mantenimiento->fetchAll() as $listado) {
			$consulta = new mantenimiento();
			$consulta->setCodigo_mantenimiento($listado['codigo_mantenimiento']);
			$consulta->setFecha_mantenimiento($listado['fecha_mantenimiento']);
			$consulta->setDescripcion_mantenimiento($listado['descripcion_mantenimiento']);
			$consulta->setResponsable_mantenimiento($listado['responsable_mantenimiento']);
			$consulta->setCosto_mantenimiento($listado['costo_mantenimiento']);
			$consulta->setActivo_mantenimiento($listado['activo_mantenimiento']);


			$lista_mantenimientos[] = $consulta;
		}
		return $lista_mantenimientos;
	}


	//*******************************************************************************************//
//************************** SQL PARA MODIFICAR mantenimiento *******************************//
//*******************************************************************************************//

	public function modificarMantenimiento($update)
	{
		$db = conectar::acceso();
		$modificar_mantenimiento = $db->prepare('UPDATE mantenimientos SET  fecha_mantenimiento= :m_fecha, descripcion_mantenimiento= :m_descripcion, responsable_mantenimiento= :m_responsable, costo_mantenimiento= :m_costo, activo_mantenimiento=:m_activo WHERE codigo_mantenimiento= :m_codigo');

		$modificar_mantenimiento->bindValue('m_codigo', $update->getCodigo_mantenimiento());
		$modificar_mantenimiento->bindValue('m_fecha', $update->getFecha_mantenimiento());
		$modificar_mantenimiento->bindValue('m_descripcion', $update->getDescripcion_mantenimiento());
		$modificar_mantenimiento->bindValue('m_responsable', $update->getResponsable_mantenimiento());
		$modificar_mantenimiento->bindValue('m_costo', $update->getCosto_mantenimiento());
		$modificar_mantenimiento->bindValue('m_activo', $update->getActivo_mantenimiento());
		$modificar_mantenimiento->execute();
	}



	//**********************************************************************************************//
//******************************** SQL PARA ELIMINAR mantenimientoS ******************************//
//**********************************************************************************************//

	public function eliminarmantenimiento($delete)
	{

		$db = conectar::acceso();
		$eliminar_mantenimiento = $db->prepare('DELETE FROM mantenimientos WHERE codigo_mantenimiento=:cod_mantenimiento');

		$eliminar_mantenimiento->bindValue('cod_mantenimiento', $delete->getCodigo_mantenimiento());

		$eliminar_mantenimiento->execute();
	}


	//**********************************************************************************************//
//************************* SQL PARA CONSULTAR CARCOS Y AREAS ********************************//
//********************************************************************************************//

	public function consultaModificar()
	{

		$db = conectar::acceso();
		$consultaModificar = $db->prepare('SELECT fecha_mantenimiento, descripcion_mantenimiento, responsable_mantenimiento, 
		costo_mantenimiento, activo_mantenimiento WHERE codigo_mantenimiento=:cod_mantenimiento');
		$consultaModificar->bindValue('cod_mantenimiento', $_POST['cod_mantenimiento']);
		$consultaModificar->execute();
		$datosConsulta = $consultaModificar->fetch(PDO::FETCH_ASSOC);
		return $datosConsulta;

	}

	public function consultAllMaintenance($asset)
    {
        $db = Conectar::acceso();

        $consulta = $db->prepare('SELECT fecha_mantenimiento, descripcion_mantenimiento, responsable_mantenimiento,
		costo_mantenimiento, repotenciacion, mejora
		FROM mantenimientos 
		WHERE activo_mantenimiento=:id ORDER BY fecha_mantenimiento DESC');
		$consulta->bindValue("id",$asset);
        $consulta->execute();

        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }
}
?>