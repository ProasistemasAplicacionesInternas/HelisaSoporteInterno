<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set("session.cookie_lifetime", "18000");
ini_set("session.gc_maxlifetime", "18000");
session_start();

require_once('../model/crudPeticionesFuncionarios.php');
require_once('../model/datosPeticion.php');


require_once('../model/datos_soportemai.php');

require_once('../model/crudPeticionesMai.php');
require_once('../model/datosPeticionesmai.php');

$crud = new CrudPeticiones();
$peticion = new Peticion();


$crudMai = new CrudPeticionesMai();
$peticionMai = new PeticionMai();


//*******************************************************************************//
//************************** PARA EL CARGUE DE LA IMAGEN ************************//
//*******************************************************************************//

define('DOCROOT', $_SERVER['DOCUMENT_ROOT'] . '/HelisaSoporteInterno'); /* MODIFCAR AL CAMBIAR A PRODUCCION */ /* /carpeta_principal_proyecto */

$nombreImagen = array(0 => 2, 1 => 2, 2 => 2);
$numImagenes = count($_FILES['imagen']['name']);/* cuenta el numero de elemntos en el array(sino hay ninguno el resultado sera 1) */


for ($x = 0; $x < $numImagenes; $x++) {
    $random = rand(100, 1000);
    $nombreArchivo = $_FILES['imagen']['name'];
    $nombreArchivo = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nombreArchivo);
    $tipoImagen = $_FILES['imagen']['type'][$x];
    $tamanoImagen = $_FILES['imagen']['size'][$x];
    $extensionArchivo = pathinfo($_FILES['imagen']['name'][$x], PATHINFO_EXTENSION);
    if ($tamanoImagen != 0) {
        $nombreImagen[$x] = 'imagen' . $random . time() . "." .  $extensionArchivo;
    } else {

        $nombreImagen[$x] = '2';
    }
    echo $tipoImagen;
    if ($tamanoImagen <= 10000000000) {
        if ($tipoImagen == "image/jpeg" || $tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/gif" || $tipoImagen == "image/jpg" || $tipoImagen == "application/pdf") {
            move_uploaded_file($_FILES['imagen']['tmp_name'][$x], DOCROOT . '/cartas/' . $nombreImagen[$x]);
        }
    }
}
echo "<br>", $nombreImagen[0], "<br>", $nombreImagen[1], "<br>", $nombreImagen[2], "<br>";


//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('America/Bogota');

    if (isset($_POST['btn-enviarPeticionInfra'])) {
        $equipos = $_POST['Categoria'];
        $areaPeticion = 1;

        if ($equipos == 16) {

            $peticion->setCategoria($_POST['Categoria']);
            $peticion->setdescripcion(htmlspecialchars($_POST['pDescripcion']));
            $peticion->setCargarimagen($nombreImagen[0]);
            $peticion->setCargarimagen2($nombreImagen[1]);
            $peticion->setCargarimagen3($nombreImagen[2]);
            $peticion->setActivo($_POST['pActivo']);
            $peticion->setCodigoactivo(NULL);
            $peticion->setUsuario($_SESSION['usuario']);
            $peticion->setEstado(1);
            $peticion->setFechapeticion(date('Y-m-d H:i:s'));
            $crud->crearPeticiones($peticion);
        } else {

            $peticion->setCategoria($_POST['Categoria']);
            $peticion->setdescripcion(htmlspecialchars($_POST['pDescripcion']));
            $peticion->setCargarimagen($nombreImagen[0]);
            $peticion->setCargarimagen2($nombreImagen[1]);
            $peticion->setCargarimagen3($nombreImagen[2]);
            $peticion->setActivo($_POST['pActivo']);
            $peticion->setCodigoactivo(NULL);
            $peticion->setUsuario($_SESSION['usuario']);
            $peticion->setEstado(1);
            $peticion->setFechapeticion(date('Y-m-d H:i:s'));
            $crud->crearPeticiones($peticion);
            
        }    } elseif (isset($_POST['btn-enviarPeticionMai'])) {
            $areaPeticion = 2;
            $peticionMai->setProductoPeticionMai($_POST['productoMai']);
            $peticionMai->setReqJustification($_POST['reqJustification']);
            $peticionMai->setReqName($_POST['reqName']);
            $peticionMai->setUsuarioCreacionMai($_SESSION['usuario']);
            $peticionMai->setDescripcionPeticionMai(htmlspecialchars($_POST['pDescripcion']));
            $peticionMai->setFechaPeticionMai(date('Y-m-d H:i:s'));
            $peticionMai->setEstadoPeticionMai(1);
            $peticionMai->setImagenPeticionMai($nombreImagen[0]);
            $peticionMai->setImagenPeticionMai2($nombreImagen[1]);
            $peticionMai->setImagenPeticionMai3($nombreImagen[2]);
            $peticionMai->setName($_POST['soporteMai']);
            $crudMai->crearPeticionesMai($peticionMai);
    
        }

    if (isset($_SESSION['id_roles']) && $_SESSION['id_roles'] == 5) {
        header('Location:../../dashboard.php');
    } else if (isset($_SESSION['rol']) && $_SESSION['rol'] == 4 || $_SESSION['rol'] == 2) {
        header('Location:../../dashboard_funcionarios.php');
    }

    
}
