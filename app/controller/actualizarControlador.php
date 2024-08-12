<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set("session.cookie_lifetime", "18000");
ini_set("session.gc_maxlifetime", "18000");
session_start();

require_once('../model/crud_peticionesSg.php');
require_once('../model/datosPeticionesSeguridad.php');



$crudSg = new CrudPeticionesSg();
$peticionesSg = new PeticionSg();

if (isset($_POST['btn-enviar_peticionSg'])) {

    $peticionesSg->setcategoriaSg($_POST['caSeguridad']);
    $peticionesSg->setdescripcion_peticionSg(htmlspecialchars($_POST['p_descripcion']));
    $peticionesSg->setimagenPeticionSeguridad1($nombre_imagen[0]);
    $peticionesSg->setimagenPeticionSeguridad2($nombre_imagen[1]);
    $peticionesSg->setimagenPeticionSeguridad3($nombre_imagen[2]);
    $peticionesSg->setimagenPeticionSeguridad4($nombre_imagen[3]);
    $peticionesSg->setimagenPeticionSeguridad5($nombre_imagen[4]);
    $crudSg->crearPeticionesSg($peticionesSg);
}

if (isset($_SESSION['id_roles']) && $_SESSION['id_roles'] == 5) {
    header('Location:../../dashboard.php');
} else if (isset($_SESSION['rol']) && $_SESSION['rol'] == 4 || $_SESSION['rol'] == 2) {
    header('Location:../../dashboard_funcionarios.php');
}
