<?php
    //require('../model/crud_peticiones.php');
    require_once('../model/datos_peticion.php');
    require_once("../model/vinculo.php");
    
    $datos= new Peticion();
 
    if(isset($_POST['btn-consultarFecha'])){
     
        $inicio= date('Y-m-d', strtotime($_POST['fechaInicial']));
        $final= date('Y-m-d', strtotime($_POST['fechaFinal']));
        $usuario = $_POST['usuario_actual'];
        
        $db=conectar::acceso();
        $listaConsulta=[];

        $seleccion=$db->prepare('SELECT  numero_peticion,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen FROM peticiones 
        LEFT JOIN categorias ON id_categoria=categoria 
        WHERE fecha_peticion BETWEEN :fechaInicial AND :fechaFinal AND usuario=:usuario');
        $seleccion->bindValue('usuario',$usuario);
        $seleccion->bindValue('fechaInicial',$inicio);
        $seleccion->bindValue('fechaFinal',$final);
        $seleccion->execute();
        
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new Peticion();
            $consulta->setP_nropeticion($listado['numero_peticion']);       
            $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
            $consulta->setP_usuario($listado['usuario']);
            $consulta->setP_categoria($listado['nombre_categoria']);
            $consulta->setP_descripcion($listado['descripcion']);
            $consulta->setP_fechaatendido($listado['DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i")']);   
            $consulta->setP_usuarioatiende($listado['usuario_atiende']);
            $consulta->setP_conclusiones($listado['conclusiones']);
            $consulta->setCalificacion($listado['nivel_encuesta']);
            $consulta->setP_cargarimagen($listado['imagen']);
            
            $listaConsulta[]=$consulta;
                
        }
 
    }else if(isset($_POST['btn-consultarTicket'])){
                
        $db=conectar::acceso();
        $listaConsulta=[];
        $usuario = $_POST['usuario_actual'];

        $seleccion=$db->prepare('SELECT  numero_peticion,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen  FROM peticiones LEFT JOIN categorias ON id_categoria=categoria  WHERE  numero_peticion=:numero_peticion AND usuario=:usuario');
        $seleccion->bindValue('usuario',$usuario);        
        $seleccion->bindValue('numero_peticion',$_POST['peticionFiltro']);
        $seleccion->execute();
    
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new Peticion();
            $consulta->setP_nropeticion($listado['numero_peticion']);       
            $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
            $consulta->setP_usuario($listado['usuario']);
            $consulta->setP_categoria($listado['nombre_categoria']);
            $consulta->setP_descripcion($listado['descripcion']);
            $consulta->setP_fechaatendido($listado['DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i")']);   
            $consulta->setP_usuarioatiende($listado['usuario_atiende']);
            $consulta->setP_conclusiones($listado['conclusiones']);
            $consulta->setCalificacion($listado['nivel_encuesta']);
            $consulta->setP_cargarimagen($listado['imagen']);

            $listaConsulta[]=$consulta;    
            
        }      
                    
     
    }

    if(isset($_POST['btn-consultarTodas'])){
     
        $db=conectar::acceso();
        $listaConsulta=[];
        $usuario = $_POST['usuario_actual'];

        $seleccion=$db->prepare('SELECT  numero_peticion,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen  FROM peticiones 
        LEFT JOIN categorias ON id_categoria=categoria  
        WHERE  usuario=:usuario');
        $seleccion->bindValue('usuario',$usuario);        
        $seleccion->execute();
    
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new Peticion();
            $consulta->setP_nropeticion($listado['numero_peticion']);       
            $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
            $consulta->setP_usuario($listado['usuario']);
            $consulta->setP_categoria($listado['nombre_categoria']);
            $consulta->setP_descripcion($listado['descripcion']);
            $consulta->setP_fechaatendido($listado['DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i")']);   
            $consulta->setP_usuarioatiende($listado['usuario_atiende']);
            $consulta->setP_conclusiones($listado['conclusiones']);
            $consulta->setCalificacion($listado['nivel_encuesta']);
            $consulta->setP_cargarimagen($listado['imagen']);

            $listaConsulta[]=$consulta;
        }
    }
?>