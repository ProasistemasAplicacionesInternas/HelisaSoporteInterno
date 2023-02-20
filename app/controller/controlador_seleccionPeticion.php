<?php 

require_once('../model/crud_peticiones.php');
require_once('../model/datos_peticion.php');

require_once('../model/crud_peticionesmai.php');
require_once('../model/datos_peticionesmai.php');

require_once('../model/datos_soportemai.php');
require_once('../model/crud_soportemai.php');

$crud= new CrudPeticiones();
$peticion= new Peticion();

$crudSop = new CrudSoporte();
$soporte = new Datostiposoporte();


$crudMai= new CrudPeticionesMai();
$peticionMai= new PeticionMai();
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
?>