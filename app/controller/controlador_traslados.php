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
echo $_POST['fecha_traslado'];
		
		$traslado->setFuncionario_inicial($_POST['funcionario_inicial']);
		$traslado->setFecha_inicial($_POST['fecha_inicial']);
		$traslado->setFuncionario_final($_POST['funcionario_final']);
		$traslado->setFecha_traslado($_POST['fecha_traslado']);
		$traslado->setActivo_traslado($_POST['activo_traslado']);
		$traslado->setDescripcion_traslado($_POST['descripcion_traslado']);
		$traslado->setNombre($_POST['usu_name']);

		$crud->crearTraslado($traslado);

		header('Location: ../../dashboard.php');
	}
?>