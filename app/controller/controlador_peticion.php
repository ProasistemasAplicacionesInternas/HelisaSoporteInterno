<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php 

ini_set("session.cookie_lifetime","18000");
ini_set("session.gc_maxlifetime","18000");
session_start();

require_once('../model/crud_peticiones.php');
require_once('../model/datos_peticion.php');

$crud= new CrudPeticiones();
$peticion= new Peticion();

//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//
if (isset($_POST['aceptar'])) {
    
    $estado = $_POST['p_estado'];
    if($estado==4){
        $peticion->setP_nropeticion($_POST['p_nropeticion']);
        $peticion->setP_estado($_POST['p_estado']);
        $peticion->setP_fechapeticion($_POST['p_fechapeticion']);
        $peticion->setP_conclusiones($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticion->setP_fechaatendido(date("Y-m-d H:i:s"));
        $peticion->setP_usuarioatiende($_SESSION['usuario']);
        $peticion->setP_correo($_POST['p_correo']);
        $peticion->setP_usuario($_POST['p_usuario']);
        $peticion->setP_categoria($_POST['p_categoria']);
        $peticion->setP_descripcion(htmlspecialchars($_POST['p_descripcion']));
        $peticion->setP_cargarimagen($_POST['imagenCa']);
        $peticion->setP_cargarimagen2($_POST['imagen2']);
        $peticion->setP_cargarimagen3($_POST['imagen3']);
        $crud->redireccionaPeticiones($peticion);

        header ("location: ../../dashboard.php");
    }else{
        $peticion->setP_nropeticion($_POST['p_nropeticion']);
        $peticion->setP_estado($_POST['p_estado']);
        $peticion->setP_conclusiones($_POST['p_conclusiones']);
        date_default_timezone_set('America/Bogota');
        $peticion->setP_fechaatendido(date("Y-m-d H:i:s"));
        $peticion->setP_usuarioatiende($_SESSION['usuario']);
        $peticion->setP_correo($_POST['p_correo']);
        $peticion->setP_usuario($_POST['p_usuario']);
        $peticion->setP_categoria($_POST['p_categoria']);
        $peticion->setP_descripcion($_POST['p_descripcion']);
        $crud->modificarPeticiones($peticion);

        header ("location: ../../dashboard.php");
    }
    
}


if(isset($_POST['crear_comentario']) && ($_POST['crear_comentario'] == 1)){
 $peticion->setP_nropeticion($_POST['id_peticion']);
 $peticion->setComentario($_POST['comentario']);
 date_default_timezone_set('America/Bogota');
 $peticion->setP_fechapeticion(date('Y-m-d H:i:s'));
 $peticion->setP_usuario($_SESSION['usuario']);
 $crud->comentarioPeticion($peticion);

 //header('Location: ../../dashboard.php');  

     
}

if(isset($_GET['encuesta']) && isset($_GET['encuesta']) =="encuesta"){
        $peticion->setP_nropeticion($_GET['peticion']);
        $peticion->setEstado_encuesta($_GET['nro']);
        $crud->encuesta($peticion);
        echo'<script type="text/javascript" charset="utf-8">
        alert("gracias por calificar nuestra encuestas, para nosotros es muy importante saber lo que piensa de la atención recibida por nuestro equipo de trabajo.");
        window.location.href="https://soporteinfraestructura.helisa.com/infraestructura/login_peticiones.php"
        </script>';
    }

if (isset($_POST['marcarRevisado'])&&($_POST['marcarRevisado']==1)) {
        $peticion->setP_nropeticion($_POST['nro_solicitud']);
        print($crud->marcarRevisado($peticion));
}
?>