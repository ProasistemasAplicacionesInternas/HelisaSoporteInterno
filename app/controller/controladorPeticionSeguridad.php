<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php

ini_set("session.cookie_lifetime", "18000");
ini_set("session.gc_maxlifetime", "18000");
session_start();

require_once('../model/crudPeticionesSg.php');
require_once('../model/datosPeticionesSeguridad.php');

$crudSg = new CrudPeticionesSg();
$peticionesSg = new PeticionSg();

if (isset($_POST['marcaRevisado']) && ($_POST['marcaRevisado'] == 1)) {
    $peticionesSg->setIdPeticionSg($_POST['nroSolicitud']);
    print($crudSg->marcarRevisado($peticionesSg));
}