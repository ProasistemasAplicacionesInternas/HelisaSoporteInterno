<?php
    //require('../model/crud_peticiones.php');
    require_once('../model/datos_peticion.php');
    require_once("../model/vinculo.php");
    
    $datos= new Peticion();
 
    if(isset($_POST['btn-consultarFecha'])){

        if(isset($_POST['areaF1']) && $_POST['areaF1'] == 1){
            $inicio= date('Y-m-d', strtotime($_POST['fechaInicial']));
            $final= date('Y-m-d', strtotime($_POST['fechaFinal']));
    
            $db=conectar::acceso();
            $listaConsulta=[];

            $seleccion=$db->prepare('SELECT  numero_peticion, estado.descripcion AS estado,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, peticiones.descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen FROM peticiones LEFT JOIN categorias ON id_categoria=categoria
            LEFT JOIN estado ON estado.id_estado=peticiones.estado 
            WHERE fecha_peticion BETWEEN :fechaInicial AND :fechaFinal AND (estado=:estadoN OR estado=:estadoP OR estado=:estadoD OR estado=:estadoC OR estado=:estadoS)');
            $seleccion->bindValue('estadoN','1');
            $seleccion->bindValue('estadoD','2');
            $seleccion->bindValue('estadoP','3');
            $seleccion->bindValue('estadoC','4');
            $seleccion->bindValue('estadoS','8');
            $seleccion->bindValue('fechaInicial',$inicio);
            $seleccion->bindValue('fechaFinal',$final);
            $seleccion->execute();
            
            foreach($seleccion->fetchAll() as $listado){
                $consulta= new Peticion();
                $consulta->setP_estado($listado['estado']);
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
        }else if(isset($_POST['areaF1']) && $_POST['areaF1'] == 2){
                $inicio= date('Y-m-d', strtotime($_POST['fechaInicial']));
                $final= date('Y-m-d', strtotime($_POST['fechaFinal']));
        
                $db=conectar::acceso();
                $listaConsulta=[];

                $seleccion=$db->prepare('SELECT  id_peticionmai, estado.descripcion AS estado, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i"), usuario_creacion, productos_mai.nombre_producto, peticiones_mai.descripcion_peticion, usuario_atencion, conclusiones,nivel_encuesta,imagen, req_nombre, req_justificacion, sprint, gestion  FROM peticiones_mai 
                LEFT JOIN productos_mai ON id_producto = producto_mai 
                LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion
                WHERE fecha_peticion BETWEEN :fechaInicial AND :fechaFinal  AND (estado_peticion=:estadoN OR estado_peticion=:estadoD OR estado_peticion=:estadoP OR estado_peticion=:estadoC OR estado_peticion=:estadoS)');
                $seleccion->bindValue('estadoN','1');
                $seleccion->bindValue('estadoD','2');
                $seleccion->bindValue('estadoP','3');
                $seleccion->bindValue('estadoC','4');
                $seleccion->bindValue('estadoS','8');
                $seleccion->bindValue('fechaInicial',$inicio);
                $seleccion->bindValue('fechaFinal',$final);
                $seleccion->execute();
                
                foreach($seleccion->fetchAll() as $listado){
                    $consulta= new Peticion();
                    $consulta->setP_estado($listado['estado']);
                    $consulta->setP_nropeticion($listado['id_peticionmai']);       
                    $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
                    $consulta->setP_usuario($listado['usuario_creacion']);
                    $consulta->setP_categoria($listado['nombre_producto']);
                    $consulta->setP_descripcion($listado['descripcion_peticion']);
                    $consulta->setP_fechaatendido($listado['DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i")']);   
                    $consulta->setP_usuarioatiende($listado['usuario_atencion']);
                    $consulta->setP_conclusiones($listado['conclusiones']);
                    $consulta->setCalificacion($listado['nivel_encuesta']);
                    $consulta->setP_cargarimagen($listado['imagen']);
                    $consulta->setReq_nombre($listado['req_nombre']);
                    $consulta->setReq_justificacion($listado['req_justificacion']);
                    $consulta->setSprint($listado['sprint']);
                    $consulta->setGestion(($listado['gestion']));
                    
                    $listaConsulta[]=$consulta;
                    
                } 
        }
     
        
 
    }else if(isset($_POST['btn-consultarTicket'])){
        
        if(isset($_POST['areaF2']) && $_POST['areaF2'] == 1){
            $db=conectar::acceso();
            $listaConsulta=[];

            $seleccion=$db->prepare('SELECT  numero_peticion, estado.descripcion AS estado,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, peticiones.descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen  FROM peticiones  
            LEFT JOIN estado ON estado.id_estado=peticiones.estado  
            LEFT JOIN categorias ON id_categoria=categoria  
            WHERE  numero_peticion=:numero_peticion AND (estado=:estadoN OR estado=:estadoP OR estado=:estadoD OR estado=:estadoC OR estado=:estadoS)');
            $seleccion->bindValue('estadoN','1');
            $seleccion->bindValue('estadoD','2');
            $seleccion->bindValue('estadoP','3');
            $seleccion->bindValue('estadoC','4');
            $seleccion->bindValue('estadoS','8');
            $seleccion->bindValue('numero_peticion',$_POST['peticionFiltro']);
            $seleccion->execute();
        
            foreach($seleccion->fetchAll() as $listado){
                $consulta= new Peticion();
                $consulta->setP_estado($listado['estado']);
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
        }else if(isset($_POST['areaF2']) && $_POST['areaF2'] == 2){
            $db=conectar::acceso();
            $listaConsulta=[];

            $seleccion=$db->prepare('SELECT  id_peticionmai, estado.descripcion AS estado, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i"), usuario_creacion, productos_mai.nombre_producto, descripcion_peticion, usuario_atencion, conclusiones,nivel_encuesta,imagen, req_nombre, req_justificacion, sprint, gestion FROM peticiones_mai 
            LEFT JOIN productos_mai ON id_producto = producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion WHERE  id_peticionmai=:numero_peticion  AND (estado_peticion=:estadoN OR estado_peticion=:estadoD OR estado_peticion=:estadoP OR estado_peticion=:estadoC OR estado_peticion=:estadoN OR estado_peticion=:estadoS)');
            $seleccion->bindValue('estadoN','1');
            $seleccion->bindValue('estadoD','2');
            $seleccion->bindValue('estadoP','3');
            $seleccion->bindValue('estadoC','4');
            $seleccion->bindValue('estadoS','8');
            $seleccion->bindValue('numero_peticion',$_POST['peticionFiltro']);
            $seleccion->execute();
        
            foreach($seleccion->fetchAll() as $listado){
                $consulta= new Peticion();
                $consulta->setP_estado($listado['estado']);
                $consulta->setP_nropeticion($listado['id_peticionmai']);       
                $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
                $consulta->setP_usuario($listado['usuario_creacion']);
                $consulta->setP_categoria($listado['nombre_producto']);
                $consulta->setP_descripcion($listado['descripcion_peticion']);
                $consulta->setP_fechaatendido($listado['DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i")']);   
                $consulta->setP_usuarioatiende($listado['usuario_atencion']);
                $consulta->setP_conclusiones($listado['conclusiones']);
                $consulta->setCalificacion($listado['nivel_encuesta']);
                $consulta->setP_cargarimagen($listado['imagen']);
                $consulta->setReq_nombre($listado['req_nombre']);
                $consulta->setReq_justificacion($listado['req_justificacion']);
                $consulta->setSprint($listado['sprint']);
                $consulta->setGestion(($listado['gestion']));

                $listaConsulta[]=$consulta;    
                
            }

        }
                    
    
    }else if(isset($_POST['btn-consultarProgramador'])){
        
        if(isset($_POST['areaF3']) && $_POST['areaF3'] == 2){
            $db=conectar::acceso();
            $listaConsulta=[];

            $seleccion=$db->prepare('SELECT  id_peticionmai, estado.descripcion AS estado, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i"), usuario_creacion, productos_mai.nombre_producto, descripcion_peticion, usuario_atencion, conclusiones,nivel_encuesta,imagen, req_nombre , req_justificacion, sprint, gestion 
            FROM peticiones_mai LEFT JOIN productos_mai ON id_producto = producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion
            WHERE  usuario_atencion=:usuario AND (estado_peticion=:estadoN OR estado_peticion=:estadoD OR estado_peticion=:estadoP OR estado_peticion=:estadoC OR estado_peticion=:estadoS)');
            $seleccion->bindValue('estadoN','1');
            $seleccion->bindValue('estadoD','2');
            $seleccion->bindValue('estadoP','3');
            $seleccion->bindValue('estadoC','4');
            $seleccion->bindValue('estadoS','8');
            $seleccion->bindValue('usuario',$_POST['programadorFiltro']);
            $seleccion->execute();
        
            foreach($seleccion->fetchAll() as $listado){
                $consulta= new Peticion();
                $consulta->setP_estado($listado['estado']);
                $consulta->setP_nropeticion($listado['id_peticionmai']);       
                $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
                $consulta->setP_usuario($listado['usuario_creacion']);
                $consulta->setP_categoria($listado['nombre_producto']);
                $consulta->setP_descripcion($listado['descripcion_peticion']);
                $consulta->setP_fechaatendido($listado['DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i")']);   
                $consulta->setP_usuarioatiende($listado['usuario_atencion']);
                $consulta->setP_conclusiones($listado['conclusiones']);
                $consulta->setCalificacion($listado['nivel_encuesta']);
                $consulta->setP_cargarimagen($listado['imagen']);
                $consulta->setReq_nombre($listado['req_nombre']);
                $consulta->setReq_justificacion($listado['req_justificacion']);
                $consulta->setSprint($listado['sprint']);
                $consulta->setGestion(($listado['gestion']));
                $listaConsulta[]=$consulta;    
                
            }
        }                   
    }

    if(isset($_POST['btn-consultarFechaI'])){
    
        $inicio= date('Y-m-d', strtotime($_POST['fechaInicial']));
        $final= date('Y-m-d', strtotime($_POST['fechaFinal']));

        $db=conectar::acceso();
        $listaConsulta=[];

        $seleccion=$db->prepare('SELECT  numero_peticion,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen FROM peticiones LEFT JOIN categorias ON id_categoria=categoria WHERE fecha_peticion BETWEEN :fechaInicial AND :fechaFinal AND (estado=:estadoD OR estado=:estadoC) AND id_categoria=:categorias');
        $seleccion->bindValue('estadoC','4');
        $seleccion->bindValue('estadoD','2');
        $seleccion->bindValue('categorias','20');
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
        
    }else if(isset($_POST['btn-consultarTicketI'])){
        $db=conectar::acceso();
        $listaConsulta=[];

        $seleccion=$db->prepare('SELECT  numero_peticion, estado.descripcion AS estado,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atendido,"%d-%m-%Y %H:%i"), usuario,categorias.nombre_categoria, peticiones.descripcion, usuario_atiende, conclusiones,nivel_encuesta,imagen  FROM peticiones  
        LEFT JOIN estado ON estado.id_estado=peticiones.estado  
        LEFT JOIN categorias ON id_categoria=categoria  
        WHERE  numero_peticion=:numero_peticion AND (estado=:estadoN OR estado=:estadoP OR estado=:estadoD OR estado=:estadoC OR estado=:estadoS) AND categoria=:categoria ');
        $seleccion->bindValue('estadoN','1');
        $seleccion->bindValue('estadoD','2');
        $seleccion->bindValue('estadoP','3');
        $seleccion->bindValue('estadoC','4');
        $seleccion->bindValue('estadoS','8');
        $seleccion->bindValue('categoria','20');
        $seleccion->bindValue('numero_peticion',$_POST['peticionFiltro']);
        $seleccion->execute();
    
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new Peticion();
            $consulta->setP_estado($listado['estado']);
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