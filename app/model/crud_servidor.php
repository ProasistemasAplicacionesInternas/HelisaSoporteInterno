<?php 
require_once("../model/vinculo.php");
    
    
    
    class DatosServidor{
        
  
        
        public function insertaServidor($servidor){
            
            /*---------FUNCION PARA INSERTAR DATOS------------*/
            
                    
            /*----------------------INSERTA DATOS DEL SERVIDOR------------------*/
            $db=Conectar::acceso();
            
            $consulta_servidor=$db->prepare('SELECT serial_servidor FROM servidores WHERE serial_servidor=:serial_servidor');
            $consulta_servidor->bindValue('serial_servidor',$servidor->getSerial_servidor());
            $consulta_servidor->execute();
            $resultado=$consulta_servidor->rowCount();
            if($resultado!=0){
                echo 3;
            }else{ 
            
            /*********************** JOHANA WAS HERE 30-07-19 ***********************/
            
            $inserta_servidor=$db->prepare('INSERT INTO servidores(serial_servidor, activo_fijo, marca_servidor, nombre_servidor, ubicacion_servidor, IP_servidor, IP_publica, usuario_administrador, usuario_estandar, puerto_servidor, fecha_compra_servidor, memoria_servidor, disco_servidor, procesador_servidor, dominio_servidor, responsable_servidor, sistema_operativo, programas_instalados, uso, tiempo_uso, backup, frecuencia_backup, persona_entrega, cargo_entrega, fecha_entrega, persona_recibe, cargo_recibe, fecha_recibe, id_tipo_servidor, ruta_backup) VALUES (:serial_servidor, :activo_fijo, :marca_servidor, :nombre_servidor, :ubicacion_servidor, :IP_servidor, :IP_publica, :usuario_administrador, :usuario_estandar, :puerto_servidor, :fecha_compra_servidor, :memoria_servidor, :disco_servidor, :procesador_servidor, :dominio_servidor, :responsable_servidor, :sistema_operativo, :programas_instalados, :uso, :tiempo_uso, :backup, :frecuencia_backup, :persona_entrega, :cargo_entrega, :fecha_entrega, :persona_recibe, :cargo_recibe, :fecha_recibe, :tipoServidor, :ruta_backup)'); 
        
            $inserta_servidor->bindValue('serial_servidor',$servidor->getSerial_servidor());
            $inserta_servidor->bindValue('activo_fijo',$servidor->getActivo_fijo());
            $inserta_servidor->bindValue('marca_servidor',$servidor->getMarca_servidor());
            //$inserta_servidor->bindValue('fisico_servidor',$servidor->getFisico_servidor());
            $inserta_servidor->bindValue('nombre_servidor',$servidor->getNombre_servidor());
            $inserta_servidor->bindValue('ubicacion_servidor',$servidor->getUbicacion_servidor());    
            $inserta_servidor->bindValue('IP_servidor',$servidor->getIP_servidor());
            $inserta_servidor->bindValue('IP_publica',$servidor->getIP_publica());
            $inserta_servidor->bindValue('usuario_administrador',$servidor->getUsuarioAdministrador());
            $inserta_servidor->bindValue('usuario_estandar',$servidor->getUsuarioEstandar());
            $inserta_servidor->bindValue('puerto_servidor',$servidor->getPuerto_servidor());
            $inserta_servidor->bindValue('fecha_compra_servidor',$servidor->getFecha_compra_servidor());
            $inserta_servidor->bindValue('memoria_servidor',$servidor->getMemoria_servidor());
            $inserta_servidor->bindValue('disco_servidor',$servidor->getDisco_servidor());
            $inserta_servidor->bindValue('procesador_servidor',$servidor->getProcesador_servidor());
            $inserta_servidor->bindValue('dominio_servidor',$servidor->getDominio_servidor());
            $inserta_servidor->bindValue('responsable_servidor',$servidor->getResponsable_servidor());
            $inserta_servidor->bindValue('sistema_operativo',$servidor->getSistema_operativo());
            $inserta_servidor->bindValue('programas_instalados',$servidor->getProgramas_instalados());
            $inserta_servidor->bindValue('uso',$servidor->getUso());
            $inserta_servidor->bindValue('tiempo_uso',$servidor->getTiempo_uso());
            $inserta_servidor->bindValue('backup',$servidor->getBackup());
            $inserta_servidor->bindValue('frecuencia_backup',$servidor->getFrecuencia_backup());
            //$inserta_servidor->bindValue('persona_genera',$servidor->getPersona_genera());
            $inserta_servidor->bindValue('persona_entrega',$servidor->getPersona_entrega());
            $inserta_servidor->bindValue('cargo_entrega',$servidor->getCargo_entrega());
            $inserta_servidor->bindValue('fecha_entrega',$servidor->getFecha_entrega());
            $inserta_servidor->bindValue('persona_recibe',$servidor->getPersona_recibe());
            $inserta_servidor->bindValue('cargo_recibe',$servidor->getCargo_recibe());
            $inserta_servidor->bindValue('fecha_recibe',$servidor->getFecha_recibe());
            $inserta_servidor->bindValue('tipoServidor',$servidor->getTipoServidor());
            $inserta_servidor->bindValue('ruta_backup',$servidor->getRuta_backup());
            $inserta_servidor->execute();

            if($inserta_servidor){
                $colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                $colsultar_usuario->bindValue('usuario', $servidor->getNombre());
                $colsultar_usuario->execute();
                $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                
                $id_usuario=$filtro['id_usuario'];
                $funcion_realizada = "El usuario realizo la creacion de un servidor nuevo, servidor: ".$servidor->getSerial_servidor();

                $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                $inserta_funcion->bindValue('id_usuario',$id_usuario);
                $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                $inserta_funcion->execute();
                /*********************** JOHANA WAS HERE 30-07-19 ***********************/
            }                                                
        }

    }
        
        
            
            /*--------------REALIZA UN QUERY PARA LA CONSULTA DE SERVIDORES---------------*/
        
        public function consultaServidor(){
                     
            $db=Conectar::acceso();
            $listaServidor=[];
            $seleccion=$db->query('SELECT id_servidor, serial_servidor, marca_servidor, nombre_servidor, ubicacion_servidor, IP_servidor, usuario_administrador, usuario_estandar, IP_publica, puerto_servidor, tipo_servidor.tipo_servidor AS tipoServidor FROM servidores INNER JOIN tipo_servidor ON tipo_servidor.id_tipo_servidor=servidores.id_tipo_servidor ORDER BY nombre_servidor');

            $seleccion->execute();
                
            foreach($seleccion->fetchAll() as $lista){
                $consulta= new Servidor();
                $consulta->setIDservidor($lista['id_servidor']);
                $consulta->setSerial_servidor($lista['serial_servidor']);
                $consulta->setMarca_servidor($lista['marca_servidor']);
                $consulta->setNombre_servidor($lista['nombre_servidor']);
                $consulta->setUbicacion_servidor($lista['ubicacion_servidor']);
                $consulta->setIP_servidor($lista['IP_servidor']);
                $consulta->setIP_publica($lista['IP_publica']);
                $consulta->setUsuarioAdministrador($lista['usuario_administrador']);
                $consulta->setUsuarioEstandar($lista['usuario_estandar']);
                $consulta->setPuerto_servidor($lista['puerto_servidor']);
                $consulta->setTipoServidor($lista['tipoServidor']);
                
                
                $listaServidor[]=$consulta;
            }
            //endforeach;
            return $listaServidor;
        } 

            
            /*--------------REALIZA UN QUERY PARA VER EL DETALLE DE UN SERVIDOR---------------*/
        
        public function detalles(){
                     
            $db=Conectar::acceso();
            $detalles=$db->prepare('SELECT serial_servidor, activo_fijo, marca_servidor, fisico_servidor,  nombre_servidor, ubicacion_servidor, IP_servidor, IP_publica, usuario_administrador, usuario_estandar, puerto_servidor, fecha_compra_servidor, memoria_servidor, disco_servidor, procesador_servidor, dominio_servidor, responsable_servidor, sistema_operativo, programas_instalados, uso, tiempo_uso, backup, frecuencia_backup, persona_genera, persona_entrega, cargo_entrega, fecha_entrega, persona_recibe, cargo_recibe, fecha_recibe, servidores.id_tipo_servidor AS codigoServidor, tipo_servidor.tipo_servidor AS tipoServidor, ruta_backup FROM servidores INNER JOIN tipo_servidor ON tipo_servidor.id_tipo_servidor=servidores.id_tipo_servidor WHERE id_servidor=:servidor');
            $detalles->bindValue('servidor',$_POST['servidor']);
            $detalles->execute();
            $datosServidor=$detalles->fetch(PDO::FETCH_ASSOC);
            //echo($datosServidor);
            return $datosServidor; 

             
         } 
        /*--------------REALIZA UNA MATRIZ PARA CONSULTAR TODOS LOS SERVIDORES ---------------*/
        public function matrizServidores(){
             $servidores=array();
             $db=Conectar::acceso();
             $matrizServidores=$db->query('SELECT id_servidor, nombre_servidor FROM servidores ORDER BY nombre_servidor');
             while($matriz = $matrizServidores->fetch(PDO::FETCH_ASSOC)){
                 $servidores[]=$matriz;
             }
             return $servidores;
        }


/*----------------------------------------------------------------------------------------------------*/
/*------------------------------------Actualiza DATOS DEL SERVIDOR------------------------------------*/   
/*----------------------------------------------------------------------------------------------------*/  

        public function actualizaServidor($servidor){

          $db=Conectar::acceso();


          $actualiza_servidor=$db->prepare('UPDATE servidores SET
              
              activo_fijo=:activo_fijo,
              marca_servidor=:marca_servidor,
              nombre_servidor=:nombre_servidor,
              ubicacion_servidor=:ubicacion_servidor,
              IP_servidor=:IP_servidor,
              IP_publica=:IP_publica,
              puerto_servidor=:puerto_servidor,
              fecha_compra_servidor=:fecha_compra_servidor,
              memoria_servidor=:memoria_servidor,
              disco_servidor=:disco_servidor,
              procesador_servidor=:procesador_servidor,
              dominio_servidor=:dominio_servidor,
              usuario_administrador=:usuario_administrador,
              usuario_estandar=:usuario_estandar,
              sistema_operativo=:sistema_operativo,
              responsable_servidor=:responsable_servidor,
              programas_instalados=:programas_instalados,
              uso=:uso,
              tiempo_uso=:tiempo_uso,
              backup=:backup,
              frecuencia_backup=:frecuencia_backup,
              persona_entrega=:persona_entrega,
              cargo_entrega=:cargo_entrega,
              fecha_entrega=:fecha_entrega,
              persona_recibe=:persona_recibe,
              cargo_recibe=:cargo_recibe,
              fecha_recibe=:fecha_recibe,
              id_tipo_servidor=:tipoServidor,
              ruta_backup=:ruta_backup
              WHERE serial_servidor=:serial_servidor');

        $actualiza_servidor->bindValue('serial_servidor',$servidor->getSerial_servidor());
        $actualiza_servidor->bindValue('activo_fijo',$servidor->getActivo_fijo());
        $actualiza_servidor->bindValue('marca_servidor',$servidor->getMarca_servidor());
        //$actualiza_servidor->bindValue('fisico_servidor',$servidor->getFisico_servidor());
        $actualiza_servidor->bindValue('nombre_servidor',$servidor->getNombre_servidor());
        $actualiza_servidor->bindValue('ubicacion_servidor',$servidor->getUbicacion_servidor());
        $actualiza_servidor->bindValue('IP_servidor',$servidor->getIP_servidor());
        $actualiza_servidor->bindValue('IP_publica',$servidor->getIP_publica());
        $actualiza_servidor->bindValue('puerto_servidor',$servidor->getPuerto_servidor());
        $actualiza_servidor->bindValue('fecha_compra_servidor',$servidor->getFecha_compra_servidor());
        $actualiza_servidor->bindValue('memoria_servidor',$servidor->getMemoria_servidor());
        $actualiza_servidor->bindValue('disco_servidor',$servidor->getDisco_servidor());
        $actualiza_servidor->bindValue('procesador_servidor',$servidor->getProcesador_servidor()); 
        $actualiza_servidor->bindValue('dominio_servidor',$servidor->getDominio_servidor());
        $actualiza_servidor->bindValue('responsable_servidor',$servidor->getResponsable_servidor());
        $actualiza_servidor->bindValue('usuario_administrador',$servidor->getUsuarioAdministrador());
        $actualiza_servidor->bindValue('usuario_estandar',$servidor->getUsuarioEstandar());
        $actualiza_servidor->bindValue('sistema_operativo',$servidor->getSistema_operativo());
        $actualiza_servidor->bindValue('programas_instalados',$servidor->getProgramas_instalados());
        $actualiza_servidor->bindValue('uso',$servidor->getUso());
        $actualiza_servidor->bindValue('tiempo_uso',$servidor->getTiempo_uso());
        $actualiza_servidor->bindValue('backup',$servidor->getBackup());
        $actualiza_servidor->bindValue('frecuencia_backup',$servidor->getFrecuencia_backup());
        //$actualiza_servidor->bindValue('persona_genera',$servidor->getPersona_genera());
        $actualiza_servidor->bindValue('persona_entrega',$servidor->getPersona_entrega());
        $actualiza_servidor->bindValue('cargo_entrega',$servidor->getCargo_entrega());
        $actualiza_servidor->bindValue('fecha_entrega',$servidor->getFecha_entrega());
        $actualiza_servidor->bindValue('persona_recibe',$servidor->getPersona_recibe());
        $actualiza_servidor->bindValue('cargo_recibe',$servidor->getCargo_recibe());
        $actualiza_servidor->bindValue('fecha_recibe',$servidor->getFecha_recibe());
        $actualiza_servidor->bindValue('tipoServidor',$servidor->getTipoServidor());
        $actualiza_servidor->bindValue('ruta_backup',$servidor->getRuta_backup());
        $actualiza_servidor->execute();

         $colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $servidor->getNombre());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_usuario=$filtro['id_usuario'];
                           $funcion_realizada = "El usuario realizo una actualizacion de un servidor, servidor: ".$servidor->getSerial_servidor();
                           $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_usuario',$id_usuario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();

        }

        public function consultarSerial($serial){
            $db=Conectar::acceso();
            
            $consulta_servidor=$db->prepare('SELECT serial_servidor FROM servidores WHERE serial_servidor=:serial_servidor');
            $consulta_servidor->bindValue('serial_servidor',$serial);
            $consulta_servidor->execute();
            $resultado=$consulta_servidor->rowCount(); 
            $db = null;
            if($resultado > 0){
                return 1;
            }else{
                return 2;
            }
        }
    

}
?>