<?php  
//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/consulta_activosFuncionario.php');

$consult = new consultarActivos(); 
$activosAsignados = $consult->matrizActivosFuncionario();

?>