<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

ini_set("session.cookie_lifetime", "18000");
ini_set("session.gc_maxlifetime", "18000");
session_start();

require_once('../model/crud_peticionesSg.php');
require_once('../model/datosPeticionesSeguridad.php');

$crudSg = new CrudPeticionesSg();
$peticionesSg = new PeticionSg();

//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//
if (isset($_POST['aceptar'])) {

    $estado = $_POST['pEstado'];
    if ($estado == 2) {

        $peticionesSg->setIdPeticionSg($_POST['pNropeticion']);
        $peticionesSg->setEstadoPeticionSg($_POST['pEstado']);
        $peticionesSg->setConclusionesPeticionSg($_POST['pConclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setFechaAtendidoSg(date("Y-m-d H:i:s"));
        $peticionesSg->setUsuarioAtencionSg($_SESSION['usuario']);
        $peticionesSg->setEmailFuncionario($_POST['pCorreo']);
        $peticionesSg->setUsuarioCreacionSg($_POST['pUsuario']);
        $peticionesSg->setCategoriaSg($_POST['pCategoria']);
        $peticionesSg->setDescripcionPeticionSg($_POST['pDescripcion']);
        $crudSg->modificarPeticionesSgResuelto($peticionesSg);

        header("location: ../../dashboard.php");
    } elseif ($estado == 3) {
        $peticionesSg->setIdPeticionSg($_POST['pNropeticion']);
        $peticionesSg->setEstadoPeticionSg($_POST['pEstado']);
        $peticionesSg->setConclusionesPeticionSg($_POST['pConclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setFechaAtendidoSg(date("Y-m-d H:i:s"));
        $peticionesSg->setUsuarioAtencionSg($_SESSION['usuario']);
        $peticionesSg->setEmailFuncionario($_POST['pCorreo']);
        $peticionesSg->setUsuarioCreacionSg($_POST['pUsuario']);
        $peticionesSg->setCategoriaSg($_POST['pCategoria']);
        $peticionesSg->setDescripcionPeticionSg($_POST['pDescripcion']);
        $crudSg->modificarPeticionesSgPendiente($peticionesSg);

        header("location: ../../dashboard.php");
    }elseif ($estado == 22) {
        $peticionesSg->setIdPeticionSg($_POST['pNropeticion']);
        $peticionesSg->setEstadoPeticionSg($_POST['pEstado']);
        $peticionesSg->setConclusionesPeticionSg($_POST['pConclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setFechaAtendidoSg(date("Y-m-d H:i:s"));
        $peticionesSg->setUsuarioAtencionSg($_SESSION['usuario']);
        $peticionesSg->setEmailFuncionario($_POST['pCorreo']);
        $peticionesSg->setUsuarioCreacionSg($_POST['pUsuario']);
        $peticionesSg->setCategoriaSg($_POST['pCategoria']);
        $peticionesSg->setDescripcionPeticionSg($_POST['pDescripcion']);
        $crudSg->modificarPeticionesSgEnProceso($peticionesSg);

        header("location: ../../dashboard.php");
    }
}


?>