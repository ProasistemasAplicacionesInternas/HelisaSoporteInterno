<?php  
//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/consultaActivosFuncionario.php');

$consult = new consultarActivos(); 
$activosAsignados = $consult->matrizActivosFuncionario();

?>