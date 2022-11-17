<?php 
//*****************************************************************************************//
//**** ESTE CONTROLADOR PASARA LOS DATOS DE LA VISTA AL MODELO DE LOS MANTENIMIENTOS ******//
//*****************************************************************************************//
ini_set("session.cookie_lifetime","18000");
ini_set("session.gc_maxlifetime","18000");
session_start();

require_once('../model/datos_mantenimientos.php');
require_once('../model/crud_mantenimientos.php');

$crud = new CrudMantenimientos();
$mantenimiento = new mantenimientos();

//********************************************************************************************//
//*************************** CONTROLADOR PARA CREAR MANTENIMIENTO ***************************//
//********************************************************************************************//
	if (isset($_POST['crear_mantenimiento'])){

		$mantenimiento->setFecha_mantenimiento($_POST['m_fecha']);
		$mantenimiento->setDescripcion_mantenimiento($_POST['m_descripcion']);
		$mantenimiento->setResponsable_mantenimiento($_SESSION['usuario']);
		$mantenimiento->setCosto_mantenimiento($_POST['m_costo']);
		$mantenimiento->setActivo_mantenimiento($_POST['m_idActivo']);
		$mantenimiento->setActivo_documentos($_POST['m_idActivo']);
		
		$crud->crearMantenimiento($mantenimiento);

		header('Location: ../../dashboard.php');
	}


//********************************************************************************************//
//*************************** CONTROLADOR PARA MODIFICAR MANTENIMIENTO ***********************//
//********************************************************************************************//
	if (isset($_POST['guardar_cambios'])){

		$mantenimiento->setId_mantenimiento($_POST['m_id']);
		$mantenimiento->setFecha_mantenimiento($_POST['m_fecha']);
		$mantenimiento->setDescripcion_mantenimiento($_POST['m_descripcion']);
		$mantenimiento->setResponsable_mantenimiento($_POST['m_responsable']);
		$mantenimiento->setCosto_mantenimiento($_POST['m_costo']);
		$mantenimiento->setActivo_mantenimiento($_POST['m_activo']);
		
		$crud->modificarMantenimiento($mantenimiento);

		header('Location: ../../dashboard.php');
	}


//********************************************************************************************//
//*************************** CONTROLADOR PARA MODIFICAR MANTENIMIENTO ***********************//
//********************************************************************************************//
	/*if (isset($_POST['guardar_cambios'])){

		$mantenimiento->setId_mantenimiento($_POST['m_id']);
		$mantenimiento->setFecha_mantenimiento($_POST['m_fecha']);
		$mantenimiento->setDescripcion_mantenimiento($_POST['m_descripcion']);
		$mantenimiento->setResponsable_mantenimiento($_POST['m_responsable']);
		$mantenimiento->setCosto_mantenimiento($_POST['m_costo']);
		$mantenimiento->setActivo_mantenimiento($_POST['m_activo']);
		
		$crud->modificarMantenimiento($mantenimiento);

		header('Location: ../../dashboard.php');
	}*/

 ?>