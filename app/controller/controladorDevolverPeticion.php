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

$codigo = $_POST['pNropeticion'];
$fechapeticion = $_POST['pFechapeticion'];
$usuario = $_POST['pUsuario'];
$correo = $_POST['pCorreo'];
$categoria = $_POST['pCategoria'];
$descripcion = $_POST['pDescripcion'];
$estado = $_POST['pEstado'];
$conclusiones = $_POST['pConclusiones'];



if (isset($_POST['btn-reenviarPeticionsg'])) {
    if ($estado == 22) {
        $peticionesSg->setIdPeticionSg($_POST['pNropeticion']);
        $peticionesSg->setEstadoPeticionSg(3);
        $peticionesSg->setConclusionesPeticionSg($_POST['pConclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setUsuarioCreacionSg($_SESSION['usuario']);
        $peticionesSg->setFechaAtendidoSg(date("Y-m-d H:i:s"));
        $crudSg->redireccionaSeguridad($peticionesSg);
    }

    header('Location:../../dashboard_funcionarios.php');
              
}


?>