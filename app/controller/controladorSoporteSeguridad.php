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

    $estado = $_POST['p_estado'];
    if ($estado == 2) {

        $peticionesSg->setId_peticionSg($_POST['p_nropeticion']);
        $peticionesSg->setestado_peticionSg($_POST['p_estado']);
        $peticionesSg->setconclusiones_PeticionSg($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setfecha_atendidoSg(date("Y-m-d H:i:s"));
        $peticionesSg->setusuario_atencionSg($_SESSION['usuario']);
        $peticionesSg->setemail_funcionario($_POST['p_correo']);
        $peticionesSg->setusuario_creacionSg($_POST['p_usuario']);
        $peticionesSg->setcategoriaSg($_POST['p_categoria']);
        $peticionesSg->setdescripcion_peticionSg($_POST['p_descripcion']);
        $crudSg->modificarPeticionesSg($peticionesSg);

        header("location: ../../dashboard.php");
    } else {
        $peticionesSg->setId_peticionSg($_POST['p_nropeticion']);
        $peticionesSg->setestado_peticionSg($_POST['p_estado']);
        $peticionesSg->setconclusiones_PeticionSg($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setfecha_atendidoSg(date("Y-m-d H:i:s"));
        $peticionesSg->setusuario_atencionSg($_SESSION['usuario']);
        $peticionesSg->setemail_funcionario($_POST['p_correo']);
        $peticionesSg->setusuario_creacionSg($_POST['p_usuario']);
        $peticionesSg->setcategoriaSg($_POST['p_categoria']);
        $peticionesSg->setdescripcion_peticionSg($_POST['p_descripcion']);
        $crudSg->modificarPeticionesSg($peticionesSg);

        header("location: ../../dashboard.php");
    }
}


?>