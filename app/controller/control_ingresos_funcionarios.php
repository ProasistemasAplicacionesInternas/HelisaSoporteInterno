<?php
//require('../model/crud_peticiones.php');
require_once("../model/datos_usuario.php");
require_once("../model/vinculo.php");

$datos= new Usuario();

 
if(isset($_POST['btn-consultarFecha'])){

    date_default_timezone_set('America/Bogota');

    $inicio= date('Y-m-d', strtotime($_POST['fechaInicial']));
    $final= date('Y-m-d', strtotime($_POST['fechaFinal']));
     
    $db=conectar::acceso();
    $listaConsulta=[];

    $seleccion=$db->prepare('SELECT  id_intentos, usuario, DATE_FORMAT(fecha,"%d-%m-%Y %H:%i"),cantidad_exitos, cantidad_fallidos,IP FROM intentos_funcionarios WHERE fecha BETWEEN :fechaInicial AND :fechaFinal');
    $seleccion->bindValue('fechaInicial',$inicio);
    $seleccion->bindValue('fechaFinal',$final);
    $seleccion->execute();
            
    foreach($seleccion->fetchAll() as $lista){
        $consulta= new Usuario();
        $consulta->setId_intentos($lista['id_intentos']);
        $consulta->setNombre($lista['usuario']);
        $consulta->setUfecha_sistema($lista['DATE_FORMAT(fecha,"%d-%m-%Y %H:%i")']);
        $consulta->setExitos($lista['cantidad_exitos']);
        $consulta->setFallidos($lista['cantidad_fallidos']);
        $consulta->setIp($lista['IP']);
        $listaConsulta[]=$consulta;                    
    }
 
} else if(isset($_POST['btn-consultarUsuario'])){

    if(isset($_POST['todo'])){


        date_default_timezone_set('America/Bogota');

        $inicio= date('Y-m-d', strtotime($_POST['fechaIn']));
        $final= date('Y-m-d', strtotime($_POST['fechaFin']));
 
            
        $db=conectar::acceso();
        $listaConsulta=[];

        $seleccion=$db->prepare('SELECT  id_intentos, usuario, DATE_FORMAT(fecha,"%d-%m-%Y %H:%i"),cantidad_exitos, cantidad_fallidos,IP FROM intentos_funcionarios WHERE usuario=:user');
            $seleccion->bindValue('user',$_POST['usuarioFiltro']);
            $seleccion->execute();
        foreach($seleccion->fetchAll() as $lista){
            $consulta= new Usuario();
            $consulta->setId_intentos($lista['id_intentos']);
            $consulta->setNombre($lista['usuario']);
            $consulta->setUfecha_sistema($lista['DATE_FORMAT(fecha,"%d-%m-%Y %H:%i")']);
            $consulta->setExitos($lista['cantidad_exitos']);
            $consulta->setFallidos($lista['cantidad_fallidos']);
            $consulta->setIp($lista['IP']);
            $listaConsulta[]=$consulta;                
        }  

    }else if(isset($_POST['fechaU'])){


        date_default_timezone_set('America/Bogota');

        $inicio= date('Y-m-d', strtotime($_POST['fechaIn']));
        $final= date('Y-m-d', strtotime($_POST['fechaFin']));
 
            
        $db=conectar::acceso();
        $listaConsulta=[];

        $seleccion=$db->prepare('SELECT  id_intentos, usuario, DATE_FORMAT(fecha,"%d-%m-%Y %H:%i"),cantidad_exitos, cantidad_fallidos,IP FROM intentos_funcionarios WHERE usuario=:user AND fecha BETWEEN :fechaIn AND :fechaFin');
        $seleccion->bindValue('fechaIn',$inicio);
        $seleccion->bindValue('fechaFin',$final);
        $seleccion->bindValue('user',$_POST['usuarioFiltro']);
        $seleccion->execute();

        foreach($seleccion->fetchAll() as $lista){
            $consulta= new Usuario();
            $consulta->setId_intentos($lista['id_intentos']);
            $consulta->setNombre($lista['usuario']);
            $consulta->setUfecha_sistema($lista['DATE_FORMAT(fecha,"%d-%m-%Y %H:%i")']);
            $consulta->setExitos($lista['cantidad_exitos']);
            $consulta->setFallidos($lista['cantidad_fallidos']);
            $consulta->setIp($lista['IP']);
            $listaConsulta[]=$consulta;            
        }  
    }                        
}




?>