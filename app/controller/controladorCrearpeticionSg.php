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



//*******************************************************************************//
//************************** UPLOAD DOC SEGURIDAD *******************************//
//*******************************************************************************//

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadDir = __DIR__ . '/../../documentSg/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $nombreImagen = [];

    $maxFiles = 5;

    $codigo = $_SESSION['ticket_codigo'];

    $existingFiles = scandir($uploadDir);
    $existingFilesCount = count($existingFiles) - 2;

    $counter = $existingFilesCount + 1;

    for ($x = 0; $x < min(count($_FILES['imagen']['name']), $maxFiles); $x++) {
        $fileTmpName = $_FILES['imagen']['tmp_name'][$x];
        $fileName = $_FILES['imagen']['name'][$x];
        $fileSize = $_FILES['imagen']['size'][$x];
        $fileError = $_FILES['imagen']['error'][$x];
        $fileType = $_FILES['imagen']['type'][$x];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueFileName = str_pad($counter, 3, '0', STR_PAD_LEFT) . '_' . basename($fileName);

        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument'];

        if (in_array($fileType, $allowedTypes)) {
            $destination = $uploadDir . $uniqueFileName;
            if (move_uploaded_file($fileTmpName, $destination)) {
                $nombreImagen[] = $uniqueFileName;
            } else {
                echo "Error al subir el archivo $fileName.<br>";
            }
        } else {
            echo "Tipo de archivo no permitido para $fileName.<br>";
        }
    }

    while (count($nombreImagen) < 5) {
        $nombreImagen[] = '2';
    }

    $_SESSION['nombre_imagen'] = $nombreImagen;
}



//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('America/Bogota');


    if (isset($_POST['btn-enviarPeticionSg'])) {

        $peticionesSg->setcategoriaSg($_POST['caSeguridad']);
        $peticionesSg->setDescripcionPeticionSg(htmlspecialchars($_POST['pDescripcion']));
        $peticionesSg->setImagenPeticionSeguridad1($nombreImagen[0]);
        $peticionesSg->setImagenPeticionSeguridad2($nombreImagen[1]);
        $peticionesSg->setImagenPeticionSeguridad3($nombreImagen[2]);
        $peticionesSg->setImagenPeticionSeguridad4($nombreImagen[3]);
        $peticionesSg->setImagenPeticionSeguridad5($nombreImagen[4]);
        $peticionesSg->setUsuarioCreacionSg($_SESSION['usuario']);
        $peticionesSg->setEstadoPeticionSg(1);
        $peticionesSg->setFechaPeticionSg(date('Y-m-d H:i:s'));
        $crudSg->crearPeticionesSg($peticionesSg);
        $_SESSION['ticket_codigo'] = $codigo;
    }
    
    if (isset($_SESSION['id_roles']) && $_SESSION['id_roles'] == 5) {
        header('Location:../../dashboard.php');
    } else if (isset($_SESSION['rol']) && $_SESSION['rol'] == 4 || $_SESSION['rol'] == 2) {
        header('Location:../../dashboard_funcionarios.php');
    }

}
