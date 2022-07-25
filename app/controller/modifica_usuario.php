<?php

require_once("../model/crud_usuarios.php");
require_once("../model/datos_usuario.php");

$actualiza= new DatosUsuario();
$modifica= new Usuario();
$lista_usuarios=$actualiza->get_usuarios();
$lista_funcionarios=$actualiza->get_funcionarios();

$lista_usuariosInfraestructura=$actualiza->get_usuariosInfraestructura();
$lista_usuariosMAI=$actualiza->get_usuariosMAI();
$lista_usuariosAtienden=$actualiza->get_usuariosAtienden();


if (isset($_POST['guardar'])) {
     session_start();


	$modifica->setIDusuario($_POST['id_usuario']);
	$modifica->setClave($_POST['contrasena']);
    $modifica->setCorreo($_POST['correo']); 
    $modifica->setIDusuarios($_SESSION['usuario']); 
    $actualiza->actualizar($modifica);
    
   header('Location:../../dashboard.php');
}


if (isset($_POST['inactivar'])) {

    session_start();

    $modifica->setIDusuario($_POST['id_usuarioX']);
    $modifica->setUfecha_inactivacion($_POST['fechaInactivo']);
    $modifica->setDescripcion($_POST['descripcion']);   
    $modifica->setUsuario_inactiva($_SESSION['usuario']); 
    date_default_timezone_set('America/Bogota');
    $modifica->setUfecha_sistema(date('Y-m-d H:i:s'));

    
    $actualiza->InactivaUsuario($modifica);
    
   header('Location:../../dashboard.php');
}



if (isset($_POST['activar'])) {

    session_start();

    $modifica->setIDusuario($_POST['id_usuario']);        
    $modifica->setUsuario_activa($_SESSION['usuario']); 
    date_default_timezone_set('America/Bogota');
    $modifica->setUfecha_activa(date('Y-m-d H:i:s'));

    
    $actualiza->ActivaUsuario($modifica);
    
   header('Location:../../dashboard.php');
}

if (isset($_POST['restablecer-correo'])) {
     
    $modifica->setNombre($_POST['usuario']);       
    $actualiza->restablecerCuenta($modifica);
    
    header('Location:cerrar.php');
}

if(isset($_POST['validar_contrasena'])) {
    $modifica->setClave(htmlentities(addslashes($_POST['contrasena'])));   
    $modifica->setNombre($_POST['usuario']);   
    $actualiza->restablecerContrasena($modifica);
}

?>
