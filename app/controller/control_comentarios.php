<?php
    //require('../model/crud_peticiones.php');
    require_once('../model/datos_peticion.php');
    require_once("../model/vinculo.php");
    
    $datos= new Peticion();
 
    if(isset($_POST['btn-consultarFecha'])){
     
        $inicio= date('Y-m-d', strtotime($_POST['fechaInicial']));
        $final= date('Y-m-d', strtotime($_POST['fechaFinal']));
 
        $db=conectar::acceso();
        $listaConsultaCom=[];

        $seleccion=$db->prepare('SELECT  id_comentario,id_peticion,  DATE_FORMAT(fecha_registro,"%d-%m-%Y "),responsable,comentario FROM comentarios_peticiones WHERE fecha_registro BETWEEN :fechaInicial AND :fechaFinal');   
        $seleccion->bindValue('fechaInicial',$inicio);
        $seleccion->bindValue('fechaFinal',$final);
        $seleccion->execute();
    
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new Peticion();
            $consulta->setP_nropeticion($listado['id_comentario']);  
            $consulta->setPeticion_co($listado['id_peticion']);       
            $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
            $consulta->setP_usuario($listado['responsable']);          
            $consulta->setP_conclusiones($listado['comentario']);
            
            $listaConsultaCom[]=$consulta;
            
        }

   }else if(isset($_POST['btn-consultarTicket'])){
                
       $db=conectar::acceso();
       $listaConsultaCom=[];
 
       $seleccion=$db->prepare('SELECT  id_comentario,id_peticion,  DATE_FORMAT(fecha_registro,"%d-%m-%Y "),responsable,comentario FROM comentarios_peticiones  WHERE  id_peticion=:id_peticion');      
        $seleccion->bindValue('id_peticion',$_POST['peticionFiltro']);
        $seleccion->execute();
    
        foreach($seleccion->fetchAll() as $listado){
        $consulta= new Peticion();
        $consulta->setP_nropeticion($listado['id_comentario']);  
        $consulta->setPeticion_co($listado['id_peticion']);       
        $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setP_usuario($listado['responsable']);          
        $consulta->setP_conclusiones($listado['comentario']);
        
        $listaConsultaCom[]=$consulta;    
            
        }
       
    } else if(isset($_POST['btn-consultarId'])){

       $db=conectar::acceso();
       $listaConsultaCom=[];

       $seleccion=$db->prepare('SELECT cp.id_comentario,cp.id_peticion, DATE_FORMAT(cp.fecha_registro,"%d-%m-%Y "),cp.responsable,cp.comentario,p.usuario,f.identificacion  FROM comentarios_peticiones cp LEFT JOIN peticiones p ON cp.id_peticion = p.numero_peticion LEFT JOIN funcionarios f ON p.usuario = f.usuario WHERE f.identificacion =:identificacion' );
       $seleccion->bindValue('identificacion',$_POST['idFiltro']);
       $seleccion->execute();

       foreach($seleccion->fetchAll() as $listado){
        $consulta= new Peticion();
        $consulta->setP_nropeticion($listado['id_comentario']);  
        $consulta->setPeticion_co($listado['id_peticion']);       
        $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setP_usuario($listado['responsable']);          
        $consulta->setP_conclusiones($listado['comentario']);
        
        $listaConsultaCom[]=$consulta;    
            
        }

    }


         if(isset($_POST['comentar'])){

        $db=conectar::acceso();
            $listaComentario=[];
            $seleccion=$db->prepare('SELECT  id_comentario,id_peticion, DATE_FORMAT(fecha_registro,"%d-%m-%Y "),responsable,comentario FROM comentarios_peticiones  WHERE  id_peticion=:id_peticiones');
            $seleccion->bindValue('id_peticiones',$_POST['peticion']);
            $seleccion->execute();
            
                foreach($seleccion->fetchAll() as $lista){
                $consulta= new Peticion();
                $consulta->setP_nropeticion($lista['id_comentario']);  
                $consulta->setPeticion_co($lista['id_peticion']);       
                $consulta->setP_fechapeticion($lista['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
                $consulta->setP_usuario($lista['responsable']);          
                $consulta->setP_conclusiones($lista['comentario']);
                
                $listaComentario[]=$consulta;    
                    
                }      
                    

     }


?>