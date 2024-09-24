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

if (isset($_POST['btn-enviarPeticionSsg'])) {

    $peticionesSg->setCategoriaSg($_POST['caSeguridad']);
    $peticionesSg->setDescripcionPeticionSg(htmlspecialchars($_POST['p_descripcion']));
    $peticionesSg->setImagenPeticionSeguridad1($nombreImagen[0]);
    $peticionesSg->setImagenPeticionSeguridad2($nombreImagen[1]);
    $peticionesSg->setImagenPeticionSeguridad3($nombreImagen[2]);
    $peticionesSg->setImagenPeticionSeguridad4($nombreImagen[3]);
    $peticionesSg->setImagenPeticionSeguridad5($nombreImagen[4]);
    $crudSg->crearPeticionesSg($peticionesSg);
}

if (isset($_SESSION['id_roles']) && $_SESSION['id_roles'] == 5) {
    header('Location:../../dashboard.php');
} else if (isset($_SESSION['rol']) && $_SESSION['rol'] == 4 || $_SESSION['rol'] == 2) {
    header('Location:../../dashboard_funcionarios.php');
}
