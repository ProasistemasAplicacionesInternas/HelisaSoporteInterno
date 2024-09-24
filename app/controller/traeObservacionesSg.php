<?php  
//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/crud_peticionesSg.php');

$consult = new CrudPeticionesSg(); 
$observaciones = $consult->traeObservaciones($_POST['pNropeticion']);

?>