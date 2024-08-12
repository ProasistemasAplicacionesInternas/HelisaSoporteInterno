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

if (isset($_POST['marcarRevisado']) && ($_POST['marcarRevisado'] == 1)) {
    $peticionesSg->setId_peticionSg($_POST['nro_solicitud']);
    print($crudSg->marcarRevisado($peticionesSg));
}