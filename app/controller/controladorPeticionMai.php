<?php

require_once('../model/crudPeticionesMai.php');
require_once('../model/datosPeticionesMai.php');


require_once('../model/datosSoporteMai.php');
require_once('../model/crudSoporteMai.php');

$crudSop = new CrudSoporte();
$soporte = new Datostiposoporte();

$crudMai = new CrudPeticionesMai();
$peticionMai = new PeticionMai();

if (session_status() == 0 || session_status() == 1) {

    session_start();
}
//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//

if (isset($_POST['aceptar_petmai'])) {
    $estado = $_POST['p_estado'];
    //REDIRECTED
    if ($estado == 4) {
        $peticionMai->setIdPeticionMai($_POST['p_nropeticion']);
        $peticionMai->setFechaPeticionMai($_POST['p_fechapeticion']);
        $peticionMai->setUsuarioCreacionMai($_POST['p_usuario']);
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFechaAtendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setEstadoPeticionMai($_POST['p_estado']);
        $peticionMai->setDescripcionPeticionMai(htmlspecialchars($_POST['p_descripcion']));
        $peticionMai->setImagenPeticionMai($_POST['imagenCa']);
        $peticionMai->setImagenPeticionMai2($_POST['imagen2']);
        $peticionMai->setImagenPeticionMai3($_POST['imagen3']);
        $peticionMai->setConclusionesPeticionMai(htmlentities(nl2br($_POST['p_conclusiones'])));
        $peticionMai->setUsuarioAtencionMai($_SESSION['usuario']);
        $peticionMai->setName($_POST['soporteMai']);
        $crudMai->redireccionarPeticionesMai($peticionMai);
        header("location: ../../dashboard.php");
    } else if ($estado == 2) {
        /* MODIFY WHEN SWITCHING TO PRODUCTION */ /* /main_project_folder */
        define('DOCROOT', $_SERVER['DOCUMENT_ROOT'] . '/infraestructura');
        $nombreImagen = array(0 => 2, 1 => 2, 2 => 2);
        /* counts the number of elements in the array (if there are none the result will be 1) */
        $numImagenes = count($_FILES['imagen']['name']);      
        for ($x = 0; $x < $numImagenes; $x++) {
            $random = rand(100, 1000);
            $nombreImagen = $_FILES['imagen']['name'];
            $nombreImagen = preg_replace('/\\.[^.\\s]{3,4}$/', '', $nombreImagen);
            $tipoImagen = $_FILES['imagen']['type'][$x];
            $tamanoImagen = $_FILES['imagen']['size'][$x];
            $extension_archivo = pathinfo($_FILES['imagen']['name'][$x], PATHINFO_EXTENSION);
            if ($tamanoImagen != 0) {
                $nombreImagen[$x] = 'Documento' . $random . time() . "." .  $extensionArchivo;
            } else {
                $nombreImagen[$x] = 'Archivo vacio';
            }
            if (
                $tipoImagen == "image/jpeg" || $tipoImagen == "image/jpg" || $tipoImagen == "image/png" || $tipoImagen == "image/gif"
                || $tipoImagen == "image/jpg" || $tipoImagen == "application/pdf" || $tipoImagen == "application/x-zip-compressed" ||
                $tipoImagen == "application/octet-stream" || $tipoImagen == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                || $tipoImagen == "application/x-gzip" || $tipoImagen == "text/csv" || $tipoImagen == "text/xlsx"
            ) {
                move_uploaded_file($_FILES['imagen']['tmp_name'][$x], DOCROOT . '/cartas/' . $nombreImagen[$x]);
            }
        }


        $var = $nombreImagen[0];
        $peticionMai->setIdPeticionMai($_POST['p_nropeticion']);
        $peticionMai->setEstadoPeticionMai($_POST['p_estado']);
        $peticionMai->setUsuarioCreacionMai($_POST['p_usuario']);
        $peticionMai->setConclusionesPeticionMai(htmlentities(nl2br($_POST['p_conclusiones'])));
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFechaAtendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setUsuarioAtencionMai($_SESSION['usuario']);
        $peticionMai->setEmailFuncionario($_POST['p_correo']);
        $peticionMai->setDescripcionPeticionMai($_POST['p_descripcion']);
        $peticionMai->setArchivos($var);
        $peticionMai->setName($_POST['soporteMai']);
        $peticionMai->setVersion($_POST['version']);
        $peticionMai->setNumeroVersion($_POST['nVersion']);
        $peticionMai->setConclusionesPeticionMai($_POST['p_conclusiones']);
        $sprint = isset($_POST['sprint']) && !empty($_POST['sprint']) ? $_POST['sprint'] : 0;
        $peticionMai->setSprint($sprint);
        if (isset($_POST['gestionado']) && !empty($_POST['gestionado'])) {
            if ($_POST['gestionado'] == "on") {
                $peticionMai->setGestion('SI');
            } else {
                $peticionMai->setGestion('NO');
            }
        } else {
            $peticionMai->setGestion('NO');
        }
        try {
            $crudMai->modificarPeticionesMai($peticionMai);
            header("location: ../../dashboard.php");
        } catch (Exception $e) {
            // Manejo de excepciones
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    } else {
        $peticionMai->setIdPeticionMai($_POST['p_nropeticion']);
        $peticionMai->setEstadoPeticionMai($_POST['p_estado']);
        $peticionMai->setUsuarioCreacionMai($_POST['p_usuario']);
        $peticionMai->setConclusionesPeticionMai($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFechaAtendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setUsuarioAtencionMai($_SESSION['usuario']);
        $peticionMai->setEmailFuncionario($_POST['p_correo']);
        $peticionMai->setDescripcionPeticionMai($_POST['p_descripcion']);
        $peticionMai->SetName($_POST['soporteMai']);
        $peticionMai->setSprint($_POST['sprint']);
        if ($_POST['gestionado'] == "on") {
            $peticionMai->setGestion('SI');
        } else {
            $peticionMai->setGestion('NO');
        }
        $crudMai->modificarPeticionesMai($peticionMai);

        header("location: ../../dashboard.php");
    }
}

if (isset($_POST['solicitudLiberada']) && ($_POST['solicitudLiberada'] == 1)) {
    $peticionMai->setIdPeticionMai($_POST['nro_solicitud']);
    print($crudMai->liberarSolicitudMai($peticionMai));
}

if (isset($_POST['marcarRevisado']) && ($_POST['marcarRevisado'] == 1)) {
    $peticionMai->setIdPeticionMai($_POST['nro_solicitud']);
    print($crudMai->marcarRevisado($peticionMai));
}

if (isset($_GET['encuesta']) && isset($_GET['encuesta']) == 'encuesta') {
    $peticionMai->setIdPeticionMai($_GET['peticion']);
    $peticionMai->setEstado_peticionMai($_GET['nro']);
    $crudMai->encuesta($peticionMai);
    echo '<script type="text/javascript" charset="utf-8">
        alert("Gracias por calificar nuestra encuesta, para nosotros es muy importante saber lo que piensa de la atención recibida por nuestro equipo de trabajo.");
        window.location.href="https://soporteinfraestructura.helisa.com/infraestructura/login_peticiones.php"
        </script>';
}
