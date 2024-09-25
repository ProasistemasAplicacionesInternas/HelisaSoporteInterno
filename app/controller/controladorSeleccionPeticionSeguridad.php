<?php 

require_once('../model/crudPeticionesSg.php');
require_once('../model/datosPeticionesSeguridad.php');

$crudSeg = new CrudpeticionesSg();
$peticionSg= new peticionSg();
//*******************************************************************************//
//**** CONTROLADOR PARA CAMBIAR EL ESTADO CUANDO LO SELECCIONA EL ASESOR ********//
//*******************************************************************************//

if (isset($_POST['seleccionarPeticionSeguridad'])){

    $peticionSg->setIdPeticionSg($_POST['pNropeticion']);
    date_default_timezone_set('America/Bogota');
    $peticionSg->setEstadoPeticionSg('3');
    $peticionSg->setFechaAtendidoSg(date('Y-m-d H:i:s'));
    $peticionSg->setUsuarioAtencionSg($_SESSION['usuario']);     
    $crudSeg->cambiaEstadoSg($peticionSg);

}
?>