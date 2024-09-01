<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php 
//*****************************************************************************************//
//******* ESTE CONTROLADOR PASARA LOS DATOS DE LA VISTA AL MODELO DE LOS TRASLADOS ********//
//*****************************************************************************************//

require_once('../model/datos_traslados.php');
require_once('../model/crud_traslados.php');

$crud = new CrudTraslados();
$traslado = new traslados();

//********************************************************************************************//
//***************************** CONTROLADOR PARA CREAR TRASLADOS *****************************//
//********************************************************************************************//

	if (isset($_POST['crear_traslado'])) {
		
		
		$traslado->setFuncionario_inicial($_POST['funcionario_inicial']);
		$traslado->setFecha_inicial($_POST['fecha_inicial']);
		$traslado->setFuncionario_final($_POST['funcionario_final']);
		$traslado->setFecha_traslado($_POST['fecha_traslado']);
		$traslado->setActivo_traslado($_POST['activo_traslado']);
		$traslado->setDescripcion_traslado($_POST['descripcion_traslado']);
		$traslado->setNombre($_POST['usu_name']);
		$crud->crearTraslado($traslado);
		$crud->anulaTraslado($traslado);

		header('Location: ../../dashboard.php');
	}
	if (isset($_POST['aceptaActivo']) &&($_POST['aceptaActivo']) == 1 ) {
		$traslado->setId_traslado($_POST['activo']);
		$traslado->setFecha_traslado($_POST['fecha_traslado']);
		$crud->aceptaTraslado($traslado);
	}
	if (isset($_POST['consulta']) &&($_POST['consulta']) == 1 ) {
		$traslado->setId_traslado($_POST['activo']);
		$crud->consultarActivosPendientesFuncionario($traslado);
	}
	if(isset($_POST['consultarPendientes']) && ($_POST['consultarPendientes']) == 1){
		$crud->existenTrasladosPorEstado($_POST['af_idB']);
	}
?>