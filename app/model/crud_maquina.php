<?php


    require_once    ("../model/vinculo.php");
    
    
    
    class DatosMaquina{
        
        public function __construct(){}
          
        
        public function insertaMaquina($maquina){
            
            /*---------FUNCION PARA INSERTAR DATOS------------*/
            
                    
            //*********************** JOHANA WAS HERE 01-08-19 ***********************/

            /*----------------------INSERTA DATOS DE LA MAQUINA------------------*/
            
            $db=conectar::acceso();
            $inserta_maquina=$db->prepare('INSERT INTO maquinas(
                   nombre_maquina, ubicacion_maquina, IP_maquina, IP_publica_maquina, puerto_maquina, fecha_compra_maquina, tipo_maquina, memoria_maquina, disco_maquina, procesador_maquina, dominio_maquina, responsable_maquina, usuario_administrador, usuario_estandar, sistema_operativo, programas_instalados, uso, tiempo_uso, backup, ruta_backup, frecuencia_backup, persona_genera, persona_entrega, cargo_entrega, fecha_entrega, persona_recibe, cargo_recibe, fecha_recibe, id_servidor)
                    VALUES (:nombre_maquina,:ubicacion_maquina,:IP_maquina, :IP_publica_maquina, :puerto_maquina, :fecha_compra_maquina, :tipo_maquina, :memoria_maquina, :disco_maquina, :procesador_maquina, :dominio_maquina, :responsable_maquina, :usuario_administrador, :usuario_estandar, :sistema_operativo, :programas_instalados, :uso, :tiempo_uso, :backup, :ruta_backup, :frecuencia_backup, :persona_genera, :persona_entrega, :cargo_entrega, :fecha_entrega, :persona_recibe, :cargo_recibe, :fecha_recibe, :id_servidor)'); 
        
            $inserta_maquina->bindValue('nombre_maquina',$maquina->getNombre_maquina());
            $inserta_maquina->bindValue('ubicacion_maquina',$maquina->getUbicacion_maquina());
            $inserta_maquina->bindValue('IP_maquina',$maquina->getIP_maquina());
            $inserta_maquina->bindValue('IP_publica_maquina',$maquina->getIP_publica());
            $inserta_maquina->bindValue('puerto_maquina',$maquina->getPuerto_maquina());
            $inserta_maquina->bindValue('fecha_compra_maquina',$maquina->getFecha_compra_maquina());
            $inserta_maquina->bindValue('tipo_maquina',$maquina->getTipo_maquina());
            $inserta_maquina->bindValue('memoria_maquina',$maquina->getMemoria_maquina());
            $inserta_maquina->bindValue('disco_maquina',$maquina->getDisco_maquina());
            $inserta_maquina->bindValue('procesador_maquina',$maquina->getProcesador_maquina());
            $inserta_maquina->bindValue('dominio_maquina',$maquina->getDominio_maquina());
            $inserta_maquina->bindValue('responsable_maquina',$maquina->getResponsable_maquina());
            $inserta_maquina->bindValue('usuario_administrador',$maquina->getUsuario_administrador());
            $inserta_maquina->bindValue('usuario_estandar',$maquina->getUsuario_estandar());
            $inserta_maquina->bindValue('sistema_operativo',$maquina->getSistema_operativo());
            $inserta_maquina->bindValue('programas_instalados',$maquina->getProgramas_instalados());
            $inserta_maquina->bindValue('uso',$maquina->getUso());
            $inserta_maquina->bindValue('tiempo_uso',$maquina->getTiempo_uso());
            $inserta_maquina->bindValue('backup',$maquina->getBackup());
            $inserta_maquina->bindValue('ruta_backup',$maquina->getRuta_backup());
            $inserta_maquina->bindValue('frecuencia_backup',$maquina->getFrecuencia_backup());
            $inserta_maquina->bindValue('persona_genera',$maquina->getPersona_genera());
            $inserta_maquina->bindValue('persona_entrega',$maquina->getPersona_entrega());
            $inserta_maquina->bindValue('cargo_entrega',$maquina->getCargo_entrega());
            $inserta_maquina->bindValue('fecha_entrega',$maquina->getFecha_entrega());
            $inserta_maquina->bindValue('persona_recibe',$maquina->getPersona_recibe());
            $inserta_maquina->bindValue('cargo_recibe',$maquina->getCargo_recibe());
            $inserta_maquina->bindValue('fecha_recibe',$maquina->getFecha_recibe());
            $inserta_maquina->bindValue('id_servidor',$maquina->getNumeroServidor());
            $inserta_maquina->execute();

            $colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $maquina->getNombre());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_usuario=$filtro['id_usuario'];
                           $funcion_realizada = "El usuario Realizo una creacion de una maquina  nueva";
                           $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_usuario',$id_usuario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();
        }
        
        
        
        public function consulta(){
            
            /*--------------REALIZA UN QUERY PARA LA CONSULTA DE LOS DATOS---------------*/
                     
            $db=conectar::acceso();

            $listaMaquinas=[];
            $seleccion=$db->prepare('SELECT id_maquina, nombre_maquina, tipo_maquina, ubicacion_maquina, IP_maquina, IP_publica_maquina, puerto_servidor, servidores.nombre_servidor AS nombreServidor 
                FROM maquinas
                INNER JOIN servidores ON servidores.id_servidor=maquinas.id_servidor');
                $seleccion->execute();

            foreach($seleccion->fetchAll() as $lista){
                $consulta= new Maquina();
                $consulta->setIDmaquina($lista['id_maquina']);
                $consulta->setNombre_maquina($lista['nombre_maquina']);
                $consulta->setTipo_maquina($lista['tipo_maquina']);
                $consulta->setUbicacion_maquina($lista['ubicacion_maquina']);
                $consulta->setIP_maquina($lista['IP_maquina']);
                $consulta->setIP_publica($lista['IP_publica_maquina']);
                $consulta->setPuerto_maquina($lista['puerto_servidor']);
                $consulta->setNombreServidor($lista['nombreServidor']);
                
                $listaMaquinas[]=$consulta;
            }
            return $listaMaquinas;
        }
        
        
        public function actualizar($modifica){
            
                
            /*----------------REALIZA LA MODIFICACION DE LOS DATOS EXISTENTES---------------*/
            
                        
            $db=conectar::acceso();
                        
            
            $modificar_persona=$db->prepare('UPDATE maquinas SET
              
              nombre_maquina=:nombre_maquina,
              ubicacion_maquina=:ubicacion_maquina,
              IP_maquina=:IP_maquina,
              IP_publica_maquina=:IP_publica_maquina,
              puerto_maquina=:puerto_maquina,
              fecha_compra_maquina=:fecha_compra_maquina,
              tipo_maquina=:tipo_maquina,
              memoria_maquina=:memoria_maquina,
              disco_maquina=:disco_maquina,
              procesador_maquina=:procesador_maquina,
              dominio_maquina=:dominio_maquina,
              responsable_maquina=:responsable_maquina,
              usuario_administrador=:usuario_administrador,
              usuario_estandar=:usuario_estandar,
              sistema_operativo=:sistema_operativo,
              programas_instalados=:programas_instalados,
              uso=:uso,
              tiempo_uso=:tiempo_uso,
              backup=:backup,
              ruta_backup=:ruta_backup,
              frecuencia_backup=:frecuencia_backup,
              persona_genera=:persona_genera,
              persona_entrega=:persona_entrega,
              cargo_entrega=:cargo_entrega,
              fecha_entrega=:fecha_entrega,
              persona_recibe=:persona_recibe,
              cargo_recibe=:cargo_recibe,
              fecha_recibe=:fecha_recibe,
              id_servidor=:nombreServidor,
              m_estado=:estadoM 
              WHERE id_maquina=:id_maquina');
            //echo $modifica->getIDmaquina()." asdasd";
            $modificar_persona->bindValue('id_maquina',$modifica->getIDmaquina());
            $modificar_persona->bindValue('nombre_maquina',$modifica->getNombre_maquina());
            $modificar_persona->bindValue('ubicacion_maquina',$modifica->getUbicacion_maquina());
            $modificar_persona->bindValue('IP_maquina',$modifica->getIP_maquina());
            $modificar_persona->bindValue('IP_publica_maquina',$modifica->getIP_publica());
            $modificar_persona->bindValue('puerto_maquina',$modifica->getPuerto_maquina());
            $modificar_persona->bindValue('fecha_compra_maquina',$modifica->getFecha_compra_maquina());
            $modificar_persona->bindValue('tipo_maquina',$modifica->getTipo_maquina());
            $modificar_persona->bindValue('memoria_maquina',$modifica->getMemoria_maquina());
            $modificar_persona->bindValue('disco_maquina',$modifica->getDisco_maquina());
            $modificar_persona->bindValue('procesador_maquina',$modifica->getProcesador_maquina());
            $modificar_persona->bindValue('dominio_maquina',$modifica->getDominio_maquina());
            $modificar_persona->bindValue('responsable_maquina',$modifica->getResponsable_maquina());
            $modificar_persona->bindValue('usuario_administrador',$modifica->getUsuario_administrador());
            $modificar_persona->bindValue('usuario_estandar',$modifica->getUsuario_estandar());
            $modificar_persona->bindValue('sistema_operativo',$modifica->getSistema_operativo());
            $modificar_persona->bindValue('programas_instalados',$modifica->getProgramas_instalados());
            $modificar_persona->bindValue('uso',$modifica->getUso());
            $modificar_persona->bindValue('tiempo_uso',$modifica->getTiempo_uso());
            $modificar_persona->bindValue('backup',$modifica->getBackup());
            $modificar_persona->bindValue('ruta_backup',$modifica->getRuta_backup());
            $modificar_persona->bindValue('frecuencia_backup',$modifica->getFrecuencia_backup());
            $modificar_persona->bindValue('persona_genera',$modifica->getPersona_genera());
            $modificar_persona->bindValue('persona_entrega',$modifica->getPersona_entrega());
            $modificar_persona->bindValue('cargo_entrega',$modifica->getCargo_entrega());
            $modificar_persona->bindValue('fecha_entrega',$modifica->getFecha_entrega());
            $modificar_persona->bindValue('persona_recibe',$modifica->getPersona_recibe());
            $modificar_persona->bindValue('cargo_recibe',$modifica->getCargo_recibe());
            $modificar_persona->bindValue('fecha_recibe',$modifica->getFecha_recibe());
            $modificar_persona->bindValue('nombreServidor',$modifica->getNombreServidor());  
            $modificar_persona->bindValue('estadoM',$modifica->getEstadoM());  
            $modificar_persona->execute();

             $colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $modifica->getNombre());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_usuario=$filtro['id_usuario'];
                           $funcion_realizada = "El usuario Realizo una actualizacion de una maquina";
                           $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_usuario',$id_usuario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();
 
        
        }

        public function detalleMaquina(){
            $db=conectar::acceso();

            $detalleMaquina=$db->prepare('SELECT id_maquina, nombre_maquina, maquinas.id_servidor, servidores.nombre_servidor, ubicacion_maquina, IP_maquina, IP_publica_maquina, puerto_maquina, fecha_compra_maquina, tipo_maquina, memoria_maquina, disco_maquina, procesador_maquina, dominio_maquina, responsable_maquina, maquinas.usuario_administrador, maquinas.usuario_estandar, maquinas.sistema_operativo, maquinas.programas_instalados, maquinas.uso, maquinas.tiempo_uso, maquinas.backup, maquinas.ruta_backup, maquinas.frecuencia_backup, maquinas.persona_genera, maquinas.persona_entrega, maquinas.cargo_entrega, maquinas.fecha_entrega, maquinas.persona_recibe, maquinas.cargo_recibe, maquinas.fecha_recibe, maquinas.m_estado FROM maquinas LEFT JOIN servidores ON servidores.id_servidor=maquinas.id_servidor WHERE id_maquina=:id_maquina'); 
            $detalleMaquina->bindValue('id_maquina',$_POST['maquinaMod']);
            $detalleMaquina->execute();

            $datosMaquina=$detalleMaquina->fetch(PDO::FETCH_ASSOC);

            return $datosMaquina;  
        }
        
        
    }
    
    


?>
