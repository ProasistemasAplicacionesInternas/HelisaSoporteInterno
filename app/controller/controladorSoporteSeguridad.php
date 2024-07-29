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
$peticionSg = new PeticionSg();

//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//
if (isset($_POST['aceptar'])) {

    $estado = $_POST['p_estado'];
    if ($estado == 4) {
        $peticionesSg->setP_nropeticion($_POST['p_nropeticion']);
        $peticionesSg->setP_estado($_POST['p_estado']);
        $peticionesSg->setP_fechapeticion($_POST['p_fechapeticion']);
        $peticionesSg->setP_conclusiones($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setP_fechaatendido(date("Y-m-d H:i:s"));
        $peticionesSg->setP_usuarioatiende($_SESSION['usuario']);
        $peticionesSg->setP_correo($_POST['p_correo']);
        $peticionesSg->setP_usuario($_POST['p_usuario']);
        $peticionesSg->setcategoriaSg($_POST['p_categoria']);
        $peticionesSg->setP_descripcion(htmlspecialchars($_POST['p_descripcion']));
        $peticionesSg->setP_cargarimagen($_POST['imagenCa']);
        $peticionesSg->setP_cargarimagen2($_POST['imagen2']);
        $peticionesSg->setP_cargarimagen3($_POST['imagen3']);
        $crud->redireccionaPeticiones($peticion);

        header("location: ../../dashboard.php");
    }
    if ($estado == 2) {
        define('DOCROOT', $_SERVER['DOCUMENT_ROOT'] . '/infraestructura'); /* MODIFCAR AL CAMBIAR A PRODUCCION */ /* /carpeta_principal_proyecto */
        $nombre_imagen = array(0 => 2, 1 => 2, 2 => 2);
        $numImagenes = count($_FILES['imagen']['name']);/* cuenta el numero de elemntos en el array(sino hay ninguno el resultado sera 1) */
        for ($x = 0; $x < $numImagenes; $x++) {
            $random = rand(100, 1000);
            $nombre_archivo = $_FILES['imagen']['name'];
            $nombre_archivo = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nombre_archivo);
            $tipo_imagen = $_FILES['imagen']['type'][$x];
            $tamano_imagen = $_FILES['imagen']['size'][$x];
            $extension_archivo = pathinfo($_FILES['imagen']['name'][$x], PATHINFO_EXTENSION);
            if ($tamano_imagen != 0) {
                $nombre_imagen[$x] = 'Documento' . $random . time() . "." .  $extension_archivo;
            } else {
                $nombre_imagen[$x] = 'Archivo vacio';
            }
            if (
                $tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif"
                || $tipo_imagen == "image/jpg" || $tipo_imagen == "application/pdf" || $tipo_imagen == "application/x-zip-compressed" ||
                $tipo_imagen == "application/octet-stream" || $tipo_imagen == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                || $tipo_imagen == "application/x-gzip" || $tipo_imagen == "text/csv" || $tipo_imagen == "text/xlsx"
            ) {
                move_uploaded_file($_FILES['imagen']['tmp_name'][$x], DOCROOT . '/cartas/' . $nombre_imagen[$x]);
            }
        }

        $var = $nombre_imagen[0];
        $peticionesSg->setP_nropeticion($_POST['p_nropeticion']);
        $peticionesSg->setP_estado($_POST['p_estado']);
        $peticionesSg->setP_conclusiones($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setP_fechaatendido(date("Y-m-d H:i:s"));
        $peticionesSg->setP_usuarioatiende($_SESSION['usuario']);
        $peticionesSg->setP_correo($_POST['p_correo']);
        $peticionesSg->setP_usuario($_POST['p_usuario']);
        $peticionesSg->setcategoriaSg($_POST['p_categoria']);
        $peticionesSg->setP_descripcion($_POST['p_descripcion']);
        $peticionesSg->setArchivos($var);
        $crudSg->modificarPeticionesSg($peticionesSg);

        header("location: ../../dashboard.php");
    } else {
        $peticionesSg->setP_nropeticion($_POST['p_nropeticion']);
        $peticionesSg->setP_estado($_POST['p_estado']);
        $peticionesSg->setP_conclusiones($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionesSg->setP_fechaatendido(date("Y-m-d H:i:s"));
        $peticionesSg->setP_usuarioatiende($_SESSION['usuario']);
        $peticionesSg->setP_correo($_POST['p_correo']);
        $peticionesSg->setP_usuario($_POST['p_usuario']);
        $peticionesSg->setcategoriaSg($_POST['p_categoria']);
        $peticionesSg->setP_descripcion($_POST['p_descripcion']);
        $crudSg->modificarPeticionesSg($peticionesSg);

        header("location: ../../dashboard.php");
    }
}


?>