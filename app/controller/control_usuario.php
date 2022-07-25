<?php

require_once("../model/crud_usuarios.php");
require_once("../model/valida_usuario.php");
require_once("../model/datos_usuario.php");

$verifica= new ValidaUsuario();
$validar= new Usuario();
$crud = new DatosUsuario();

	if (isset($_POST['ingresar'])) {
    $validar->setNombre(htmlentities(addslashes($_POST['usuario'])));
    $validar->setClave(htmlentities(addslashes($_POST['clave'])));
    /*$_SESSION['usuario']=htmlentities(addslashes($_POST['usuario']));*/
    
    $verifica->valida($validar);
    }

    if (isset($_POST['modificaAcceso']) && $_POST['modificaAcceso'] == 1) {
        $validar->setNombre(htmlentities(addslashes($_POST['usuarios'])));
        $validar->setClave(htmlentities(addslashes($_POST['claves'])));
        $verifica->validacion($validar); 
    }

    if(isset($_POST['buscar_rol']) && $_POST['buscar_rol'] == 1){
        $validar->setNombre(htmlentities(addslashes($_POST['usuario'])));
        $rol = $crud->rol_usuario($validar);
        echo $rol;
    }



?>
