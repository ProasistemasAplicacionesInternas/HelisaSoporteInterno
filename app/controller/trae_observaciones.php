<?php  
//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/crudPeticionesMai.php');

$consult = new CrudPeticionesMai(); 
$observaciones = $consult->traeObservaciones($_POST['p_nropeticion']);

?>