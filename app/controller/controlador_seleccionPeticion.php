<?php 

require_once('../model/crudPeticionesFuncionarios.php');
require_once('../model/datosPeticion.php');

require_once('../model/crudPeticionesMai.php');
require_once('../model/datosPeticionesmai.php');

require_once('../model/datos_soportemai.php');
require_once('../model/crudSoportemai.php');

require_once('../model/crud_peticionesSg.php');
require_once('../model/datosPeticionesSeguridad.php');

$crud= new CrudPeticiones();
$peticion= new Peticion();

$crudSop = new CrudSoporte();
$soporte = new Datostiposoporte();


$crudMai= new CrudPeticionesMai();
$peticionMai= new PeticionMai();

$crudSeg = new CrudpeticionesSg();
$peticionSg= new peticionSg();
//*******************************************************************************//
//**** CONTROLADOR PARA CAMBIAR EL ESTADO CUANDO LO SELECCIONA EL ASESOR ********//
//*******************************************************************************//
if (isset($_POST['seleccionar'])){

    $peticion->setP_nropeticion($_POST['p_nropeticion']);
    $peticion->setP_estado('8');
    date_default_timezone_set('America/Bogota');
    $peticion->setP_fechaatendido(date('Y-m-d H:i:s'));
    $peticion->setP_usuarioatiende($_SESSION['usuario']);
    $crud->cambiaEstado($peticion);

}

if (isset($_POST['seleccionar_peticionmai'])){

    $peticionMai->setId_peticionMai($_POST['p_nropeticion']);
    $peticionMai->setEstado_peticionMai('8');
    date_default_timezone_set('America/Bogota');
    $peticionMai->setFecha_atendidoMai(date('Y-m-d H:i:s'));
    $peticionMai->setUsuario_atencionMai($_SESSION['usuario']);     
    $crudMai->cambiaEstadoMai($peticionMai);

}

if (isset($_POST['seleccionarPeticionSeguridad'])){

    $peticionSg->setId_peticionSg($_POST['p_nropeticion']);
    date_default_timezone_set('America/Bogota');
    $peticionSg->setFecha_atendidoSg(date('Y-m-d H:i:s'));
    $peticionSg->setUsuario_atencionSg($_SESSION['usuario']);     
    $crudSeg->cambiaEstadoSg($peticionSg);

}
?>