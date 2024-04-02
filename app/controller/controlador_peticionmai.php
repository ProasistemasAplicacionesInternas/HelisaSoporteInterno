<?php

require_once('../model/crud_peticionesmai.php');
require_once('../model/datos_peticionesmai.php');


require_once('../model/datos_soportemai.php');
require_once('../model/crud_soportemai.php');

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
        $peticionMai->setId_peticionMai($_POST['p_nropeticion']);
        $peticionMai->setFecha_peticionMai($_POST['p_fechapeticion']);
        $peticionMai->setUsuario_creacionMai($_POST['p_usuario']);
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFecha_atendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setEstado_peticionMai($_POST['p_estado']);
        $peticionMai->setDescripcion_peticionMai(htmlspecialchars($_POST['p_descripcion']));
        $peticionMai->setImagen_peticionMai($_POST['imagenCa']);
        $peticionMai->setImagen_peticionMai2($_POST['imagen2']);
        $peticionMai->setImagen_peticionMai3($_POST['imagen3']);
        $peticionMai->setConclusiones_peticionMai(htmlentities(nl2br($_POST['p_conclusiones'])));
        $peticionMai->setUsuario_atencionMai($_SESSION['usuario']);
        $peticionMai->setName($_POST['soporteMai']);
        $crudMai->redireccionarPeticionesMai($peticionMai);
        header("location: ../../dashboard.php");
    } else if ($estado == 2) {
        /* MODIFY WHEN SWITCHING TO PRODUCTION */ /* /main_project_folder */
        define('DOCROOT', $_SERVER['DOCUMENT_ROOT'] . '/infraestructura');
        $nombre_imagen = array(0 => 2, 1 => 2, 2 => 2);
        /* counts the number of elements in the array (if there are none the result will be 1) */
        $numImagenes = count($_FILES['imagen']['name']);      
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
        $peticionMai->setId_peticionMai($_POST['p_nropeticion']);
        $peticionMai->setEstado_peticionMai($_POST['p_estado']);
        $peticionMai->setUsuario_creacionMai($_POST['p_usuario']);
        $peticionMai->setConclusiones_peticionMai(htmlentities(nl2br($_POST['p_conclusiones'])));
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFecha_atendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setUsuario_atencionMai($_SESSION['usuario']);
        $peticionMai->setEmail_funcionario($_POST['p_correo']);
        $peticionMai->setDescripcion_peticionMai($_POST['p_descripcion']);
        $peticionMai->setArchivos($var);
        $peticionMai->setName($_POST['soporteMai']);
        $peticionMai->setVersion($_POST['version']);
        $peticionMai->setNumero_version($_POST['nVersion']);
        $peticionMai->setConclusiones_peticionMai($_POST['p_conclusiones']);
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
        $peticionMai->setId_peticionMai($_POST['p_nropeticion']);
        $peticionMai->setEstado_peticionMai($_POST['p_estado']);
        $peticionMai->setUsuario_creacionMai($_POST['p_usuario']);
        $peticionMai->setConclusiones_peticionMai($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFecha_atendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setUsuario_atencionMai($_SESSION['usuario']);
        $peticionMai->setEmail_funcionario($_POST['p_correo']);
        $peticionMai->setDescripcion_peticionMai($_POST['p_descripcion']);
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
    $peticionMai->setId_peticionMai($_POST['nro_solicitud']);
    print($crudMai->liberarSolicitudMai($peticionMai));
}

if (isset($_POST['marcarRevisado']) && ($_POST['marcarRevisado'] == 1)) {
    $peticionMai->setId_peticionMai($_POST['nro_solicitud']);
    print($crudMai->marcarRevisado($peticionMai));
}

if (isset($_GET['encuesta']) && isset($_GET['encuesta']) == 'encuesta') {
    $peticionMai->setId_peticionMai($_GET['peticion']);
    $peticionMai->setEstado_peticionMai($_GET['nro']);
    $crudMai->encuesta($peticionMai);
    echo '<script type="text/javascript" charset="utf-8">
        alert("Gracias por calificar nuestra encuesta, para nosotros es muy importante saber lo que piensa de la atención recibida por nuestro equipo de trabajo.");
        window.location.href="https://soporteinfraestructura.helisa.com/infraestructura/login_peticiones.php"
        </script>';
}
