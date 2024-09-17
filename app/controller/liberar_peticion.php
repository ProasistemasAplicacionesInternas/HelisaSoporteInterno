<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set("session.cookie_lifetime","18000");
ini_set("session.gc_maxlifetime","18000");
session_start();

require_once('../model/crudPeticionesFuncionarios.php');
require_once('../model/datosPeticion.php');

$crud= new CrudPeticiones();
$modifica= new Peticion();
//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//

if (isset($_POST['liberar'])) {
    $modifica->setP_nropeticion($_POST['nro_peticion']);
    $modifica->setP_estado('1');
    $modifica->setP_usuarioatiende($_SESSION['usuario']);
    
    $crud->liberar($modifica);
    header('Location: ../../dashboard.php');
    
}
 ?>