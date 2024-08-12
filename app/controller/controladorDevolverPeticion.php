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

$codigo = $_POST['p_nropeticion'];
$fechapeticion = $_POST['p_fechapeticion'];
$usuario = $_POST['p_usuario'];
$correo = $_POST['p_correo'];
$categoria = $_POST['p_categoria'];
$descripcion = $_POST['p_descripcion'];
$estado = $_POST['p_estado'];
$conclusiones = $_POST['p_conclusiones'];



if (isset($_POST['btn-reenviar_peticionsg'])) {
    if ($estado == 22) {
        $peticionesSg->setId_peticionSg($_POST['p_nropeticion']);
        $peticionesSg->setestado_peticionSg(3);
        $peticionesSg->setconclusiones_PeticionSg($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setusuario_creacionSg($_SESSION['usuario']);
        $peticionesSg->setfecha_atendidoSg(date("Y-m-d H:i:s"));
        $crudSg->redireccionaSeguridad($peticionesSg);
    }

    header('Location:../../dashboard_funcionarios.php');
              
}


?>