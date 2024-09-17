<?php
    require_once('../model/datosPeticionesmai.php');
    require_once("../model/vinculo.php");
    
    $datos= new PeticionMai();
 
    if(isset($_POST['btn-consultarFecha'])){
     
        $inicio = date('Y-m-d', strtotime($_POST['fechaInicial']));
        $final = date('Y-m-d', strtotime($_POST['fechaFinal']));
        $usuario = $_POST['usuario_actual'];
        
        $db=conectar::acceso();
        $listaConsulta=[];
        $seleccion=$db->prepare('SELECT  id_peticionmai,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i"), usuario_creacion,productos_mai.nombre_producto, descripcion_peticion, usuario_atencion, conclusiones, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id, imagen, estado.descripcion AS estado 
        FROM peticiones_mai 
        LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
        LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion
        LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
        WHERE fecha_peticion BETWEEN :fechaInicial AND :fechaFinal AND usuario_creacion=:usuario_consulta');
        $seleccion->bindValue('fechaInicial',$inicio);
        $seleccion->bindValue('fechaFinal',$final);
        $seleccion->bindValue('usuario_consulta',$usuario);
        $seleccion->execute();
        
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);       
            $consulta->setFecha_peticionMai($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
            $consulta->setUsuario_creacionMai($listado['usuario_creacion']);
            $consulta->setProducto_peticionMai($listado['nombre_producto']);
            $consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
            $consulta->setFecha_atendidoMai($listado['DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i")']);   
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setConclusiones_peticionMai($listado['conclusiones']);
            $consulta->setImagen_peticionMai($listado['imagen']);
            $consulta->setEstado_peticionMai($listado['estado']);
            $consulta->setName($listado['nombre']);
            $listaConsulta[]=$consulta;
                
        }
 
    }else if(isset($_POST['btn-consultarTicket'])){
        $usuario = $_POST['usuario_actual'];        
        $db=conectar::acceso();
        $listaConsulta=[];
        $seleccion=$db->prepare('SELECT  id_peticionmai,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i"), usuario_creacion,productos_mai.nombre_producto, descripcion_peticion, usuario_atencion, conclusiones, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id, imagen, estado.descripcion AS estado 
        FROM peticiones_mai 
        LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
        LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion
        LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
        WHERE id_peticionmai=:id_peticionmai AND usuario_creacion=:usuario_consulta');
        $seleccion->bindValue('id_peticionmai',$_POST['peticionFiltro']);
        $seleccion->bindValue('usuario_consulta',$usuario);
        $seleccion->execute();
        
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);       
            $consulta->setFecha_peticionMai($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
            $consulta->setUsuario_creacionMai($listado['usuario_creacion']);
            $consulta->setProducto_peticionMai($listado['nombre_producto']);
            $consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
            $consulta->setFecha_atendidoMai($listado['DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i")']);   
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setConclusiones_peticionMai($listado['conclusiones']);
            $consulta->setImagen_peticionMai($listado['imagen']);
            $consulta->setEstado_peticionMai($listado['estado']);
            $consulta->setName($listado['nombre']);
            $listaConsulta[]=$consulta;   
            
        }      
                    
     
    }

    if(isset($_POST['btn-consultarTodas'])){
     
        $usuario = $_POST['usuario_actual'];     
        $db=conectar::acceso();
        $listaConsulta=[];
        $seleccion=$db->prepare('SELECT  id_peticionmai,  DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i"),DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i"), usuario_creacion,productos_mai.nombre_producto, descripcion_peticion, usuario_atencion, conclusiones, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id, imagen, estado.descripcion AS estado 
        FROM peticiones_mai 
        LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
        LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion
        LEFT JOIN tipo_soportemai ON tipo_soportemai.id=peticiones_mai.tipo_soportemai
        WHERE usuario_creacion=:usuario_consulta');
        $seleccion->bindValue('usuario_consulta',$usuario);
        $seleccion->execute();
        
        foreach($seleccion->fetchAll() as $listado){
            $consulta= new PeticionMai();
            $consulta->setId_peticionMai($listado['id_peticionmai']);       
            $consulta->setFecha_peticionMai($listado['DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i")']);
            $consulta->setUsuario_creacionMai($listado['usuario_creacion']);
            $consulta->setProducto_peticionMai($listado['nombre_producto']);
            $consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
            $consulta->setFecha_atendidoMai($listado['DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i")']);   
            $consulta->setUsuario_atencionMai($listado['usuario_atencion']);
            $consulta->setConclusiones_peticionMai($listado['conclusiones']);
            $consulta->setImagen_peticionMai($listado['imagen']);
            $consulta->setEstado_peticionMai($listado['estado']);
            $consulta->setName($listado['nombre']);
            $listaConsulta[]=$consulta;
                
        }
    }
    
    if (isset($_POST['id_peticionmai'])) {
        $id_peticionmai = $_POST['id_peticionmai'];
    
        $db = conectar::acceso();
        $conclusionesAnteriores = [];
        $seleccion = $db->prepare('SELECT descripcion_observacion FROM observaciones_mai WHERE id_ticket=:id_peticionmai');
        $seleccion->bindValue('id_peticionmai', $id_peticionmai);
        $seleccion->execute();
    
        foreach ($seleccion->fetchAll() as $listado) {
            $conclusionesAnteriores[] = $listado['descripcion_observacion'];
        }
    
        echo json_encode($conclusionesAnteriores);
    }
    

?>