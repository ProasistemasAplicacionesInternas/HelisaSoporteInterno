<?php  
//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/crud_peticionesmai.php');

$consult = new CrudPeticionesMai(); 
$observaciones = $consult->traeObservaciones($_POST['p_nropeticion']);

?>