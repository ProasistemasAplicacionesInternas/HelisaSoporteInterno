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

    $seleccion=$db->prepare('SELECT  fun.id_funcionario,usu.nombre,fun.fecha_registro,fun.funcion_realizada,fun.IP FROM funciones_funcionarios fun inner join funcionarios usu on fun.id_funcionario = usu.identificacion where fun.fecha_registro BETWEEN :fechaInicial AND :fechaFinal');
    $seleccion->bindValue('fechaInicial',$inicio);
    $seleccion->bindValue('fechaFinal',$final);
    $seleccion->execute();
            
   foreach($seleccion->fetchAll() as $lista){
            $consulta= new Usuario();
            $consulta->setIDusuarios($lista['id_funcionario']);
            $consulta->setNombre($lista['nombre']);
            $consulta->setFecharegistro($lista['fecha_registro']);
            $consulta->setFuncionrealizada($lista['funcion_realizada']);
            $consulta->setIp($lista['IP']);
            $listaConsulta[]=$consulta;                
        } 
 
} else if(isset($_POST['btn-consultarUsuario'])){

  
        $db=conectar::acceso();
        $listaConsulta=[];

        $seleccion=$db->prepare('SELECT fun.id_funcionario,usu.nombre,fun.fecha_registro,fun.funcion_realizada,fun.IP FROM funciones_funcionarios fun inner join funcionarios usu on fun.id_funcionario = usu.identificacion where usu.usuario = :usuarioFiltro');
            $seleccion->bindValue('usuarioFiltro',$_POST['usuarioFiltro']);
            $seleccion->execute();

        foreach($seleccion->fetchAll() as $lista){
            $consulta= new Usuario();
            $consulta->setIDusuarios($lista['id_funcionario']);
            $consulta->setNombre($lista['nombre']);
            $consulta->setFecharegistro($lista['fecha_registro']);
            $consulta->setFuncionrealizada($lista['funcion_realizada']);
            $consulta->setIp($lista['IP']);
            $listaConsulta[]=$consulta;                
        }                        
}




?>