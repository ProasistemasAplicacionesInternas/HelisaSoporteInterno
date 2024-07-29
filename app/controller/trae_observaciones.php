<?php  
//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/crud_peticionesmai.php');
require_once('../model/crud_peticionesSg.php');

$consult = new CrudPeticionesMai(); 
$observaciones = $consult->traeObservaciones($_POST['p_nropeticion']);

$consult = new CrudPeticionesSg(); 
$observaciones = $consult->traeObservaciones($_POST['p_nropeticion']);

?>