<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set("session.cookie_lifetime","18000");
ini_set("session.gc_maxlifetime","18000");
session_start();


require_once('../model/crud_peticionesmai.php');
require_once('../model/datos_peticionesmai.php');

$crudMai= new CrudPeticionesMai();
$peticionMai= new PeticionMai();

//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//

if (isset($_POST['aceptar_petmai'])) {
    $estado=$_POST['p_estado'];
    if($estado==4){
        $peticionMai->setId_peticionMai($_POST['p_nropeticion']);
        $peticionMai->setFecha_peticionMai($_POST['p_fechapeticion']);
        $peticionMai->setUsuario_creacionMai($_POST['p_usuario']);
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFecha_atendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setEstado_peticionMai($_POST['p_estado']);
        $peticionMai->setDescripcion_peticionMai($_POST['p_descripcion']);
        $peticionMai->setImagen_peticionMai($_POST['imagenC']);
        $peticionMai->setImagen_peticionMai2($_POST['imagen2']);
        $peticionMai->setImagen_peticionMai3($_POST['imagen3']);
        $peticionMai->setConclusiones_peticionMai(htmlentities(nl2br($_POST['p_conclusiones'])));
        $peticionMai->setUsuario_atencionMai($_SESSION['usuario']);
            
        $crudMai->redireccionarPeticionesMai($peticionMai);
        
        header ("location: ../../dashboard.php");
    }else{
        $peticionMai->setId_peticionMai($_POST['p_nropeticion']);
        $peticionMai->setEstado_peticionMai($_POST['p_estado']);
        $peticionMai->setConclusiones_peticionMai(htmlentities(nl2br($_POST['p_conclusiones'])));
        date_default_timezone_set('America/Bogota');
        $peticionMai->setFecha_atendidoMai(date("Y-m-d H:i:s"));
        $peticionMai->setUsuario_atencionMai($_SESSION['usuario']);
        $crudMai->modificarPeticionesMai($peticionMai);
        
        header ("location: ../../dashboard.php");   
    }
}

if (isset($_POST['solicitudLiberada'])&&($_POST['solicitudLiberada']==1)) {
        $peticionMai->setId_peticionMai($_POST['nro_solicitud']);
        print($crudMai->liberarSolicitudMai($peticionMai));
    }
    
if (isset($_POST['marcarRevisado'])&&($_POST['marcarRevisado']==1)) {
        $peticionMai->setId_peticionMai($_POST['nro_solicitud']);
        print($crudMai->marcarRevisado($peticionMai));
}

?>