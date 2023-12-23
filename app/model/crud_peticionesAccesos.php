<?php 

    require_once('vinculo.php');
    require_once('../model/libEncript.php');
    require __DIR__ . '/vendor/autoload.php';//Correo

    class peticionesAccesos{


        public function crearPeticion($datos){
            $db = Conectar::acceso();
            $crearPeticion = $db->prepare("INSERT INTO peticiones_accesos(descripcion,tipo,plataformas,usuario_creacion,fecha_creacion,estado,aprobacion,registro,conclusiones) VALUES(:descripcion, :tipo, :plataformas, :usuario_creacion, :fecha_creacion, :estado,:aprobacion, :registro, :conclusiones)");
            $crearPeticion->bindValue('descripcion',$datos->getDescripcion());
            $crearPeticion->bindValue('tipo',$datos->getTipo());
            $crearPeticion->bindValue('plataformas',$datos->getPlataformas());
            $crearPeticion->bindValue('usuario_creacion',$datos->getUsuario_creacion());
            $crearPeticion->bindValue('fecha_creacion',$datos->getFecha_creacion());
            $crearPeticion->bindValue('estado',1);
            $crearPeticion->bindValue('aprobacion',$datos->getAprobado());
            $crearPeticion->bindValue('registro','NoProces');
            $crearPeticion->bindValue('conclusiones',$datos->getConclusiones());
            $crearPeticion->execute();

            if($crearPeticion){
                $colsultar_identificacion =$db->prepare('SELECT identificacion from funcionarios where usuario =:usuario');
                $colsultar_identificacion->bindValue('usuario', $datos->getUsuario_creacion());
                $colsultar_identificacion->execute();
                $filtro=$colsultar_identificacion->fetch(PDO::FETCH_ASSOC);
                $id_funcionario=$filtro['identificacion'];
                $inserta_funcion=$db->prepare("INSERT INTO funciones_funcionarios (id_funcionario, fecha_registro, funcion_realizada,IP) VALUES (:id_funcionario , curdate() , :funcion_realizada ,:ip )");
                $inserta_funcion->bindValue('id_funcionario',$id_funcionario);
                $inserta_funcion->bindValue('funcion_realizada',"El funcionario Realizo una peticion de Accesos a Plataformas.");
                $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                $inserta_funcion->execute();
                if($inserta_funcion){
                    return 1;
                }else{
                    return 2;
                }
            }else{
                return 2;
            }

        }
        


        public function getPeticionesxUsuario($usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_peticionAcceso, PA.descripcion, tipo, plataformas, usuario_creacion, fecha_creacion, fecha_atendido, usuario_atiende, estado, estado.descripcion AS estado_descripcion, conclusiones, nivel_encuesta, aprobacion, revisado FROM peticiones_accesos PA LEFT JOIN estado ON estado = estado.id_estado WHERE usuario_creacion = :usuario_creacion");
            $consulta->bindValue('usuario_creacion',$usuario);
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
				$peticiones = new datosPeticionAccesos();
                $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                $peticiones->setDescripcion($listado['descripcion']);	
                $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                $peticiones->setEstado_peticion($listado['estado']);
                $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                $peticiones->setTipo($listado['tipo']);	
                $peticiones->setPlataformas($listado['plataformas']);	
                $peticiones->setConclusiones($listado['conclusiones']);	
                $peticiones->setRevisado($listado['revisado']);	
                $peticiones->setAprobado($listado['aprobacion']);

				$lista_peticiones[]=$peticiones;	
			}
            $db = null;
			return $lista_peticiones;

        }

        public function modificarRevisado($datos){
            $db = Conectar::acceso();
            $consulta = $db->prepare("UPDATE peticiones_accesos SET revisado = :revisado WHERE id_peticionAcceso = :id_peticionAcceso");
            $consulta->bindValue('id_peticionAcceso',$datos->getNombre());
            $consulta->bindValue('revisado',$datos->getRevisado());
            $consulta->execute();

            if($consulta){
                $consultaB = $db->prepare('SELECT aprobacion FROM peticiones_accesos WHERE id_peticionAcceso = :id_peticionAcceso');
                $consultaB->bindValue('id_peticionAcceso',$datos->getNombre());
                $consultaB->execute();
                $resultado = $consultaB->fetch(PDO::FETCH_ASSOC);
                if($resultado['aprobacion'] == 12){
                    $this->correoDeFinalizacion($datos->getNombre());
                }
                $resultado = 1;
            }else{
                $resultado = 0;
            }
            $db = null;
            return $resultado;
        }
        public function consultaAccesoDuplicado($datos, $id){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT * FROM accesos_plataformas WHERE usuario = :usuarioD AND Plataforma = :plataformaD AND fecha_inactivacion IS NULL AND id_usuario = :id");
            $consulta->bindValue('usuarioD',$datos->getNombre());
            $consulta->bindValue('plataformaD',$datos->getPlataformas());
            $consulta->bindValue('id',$id);
            $consulta->execute();
            $resultado = $consulta->rowCount();
            if ($resultado == 0) {
                echo 1;
            }else{
                echo 2;
            }
        }

        public function getEstado($id_peticion){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT estado FROM peticiones_accesos WHERE id_peticionAcceso = :id_peticionAcceso");
            $consulta->bindValue('id_peticionAcceso',$id_peticion);
            $consulta->execute();

            if($consulta){
                $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
                $resultado = $consultaFinalizada['estado'];
            }else{
                $resultado = 0;
            }
           
            $consulta = null;
            return $resultado;
        }

        public function modificarEstado($datos){
            $db = Conectar::acceso();
            $consulta = $db->prepare("UPDATE peticiones_accesos SET estado = :estado, fecha_atendido = :fecha_atendido, usuario_atiende = :usuario_atiende WHERE id_peticionAcceso = :id_peticionAcceso");
            $consulta->bindValue('id_peticionAcceso',$datos->getNombre());
            $consulta->bindValue('fecha_atendido',$datos->getFecha_atendido());
            $consulta->bindValue('usuario_atiende',$datos->getUsuario_atendio());
            $consulta->bindValue('estado',8);
            $consulta->execute();

            if($consulta){
                $resultado = 1;
            }else{
                $resultado = 0;
            }
            $db = null;
            return $resultado;
        }
        

        public function liberarPeticion($id_peticion){
            $db = Conectar::acceso();
            $consulta = $db->prepare("UPDATE peticiones_accesos SET estado = 3 WHERE id_peticionAcceso = :id_peticion");
            $consulta->bindValue('id_peticion',$id_peticion);
            $consulta->execute();

            if($consulta){
                $resultado = 1;
            }else{
                $resultado = 0;
            }
            $db = null;
            return $resultado;
        }

        public function modificarPeticion($datos){
            $db = Conectar::acceso();
            $consulta = $db->prepare("UPDATE peticiones_accesos SET estado = :estado, conclusiones = :conclusiones , aprobacion = :aprobacion, fecha_atendido = :fecha_atendido, usuario_atiende = :usuario_atiende, plataformas =:plataformas WHERE id_peticionAcceso = :id_peticion");
            $consulta->bindValue('estado',$datos->getEstado_peticion());
            $consulta->bindValue('conclusiones',$datos->getConclusiones());
            $consulta->bindValue('aprobacion',$datos->getAprobado());
            $consulta->bindValue('fecha_atendido', $datos->getFecha_atendido());
            $consulta->bindValue('usuario_atiende',$datos->getUsuario_atendio());
            $consulta->bindValue('id_peticion',$datos->getNombre());
            $consulta->bindValue('plataformas',$datos->getPlataformas());
            $consulta->execute();

            if($consulta){
                $resultado = 1;
            }else{
                $resultado = 0;
            }
            $db = null;
            return $resultado;
        } 
        public function cancelaPeticion($datos){
            $db = Conectar::acceso();
            $consulta = $db->prepare("UPDATE peticiones_accesos SET estado = :estado, conclusiones = :conclusiones , aprobacion = :aprobacion, fecha_atendido = :fecha_atendido, usuario_atiende = :usuario_atiende, plataformas =:plataformas, revisado =:revisado WHERE id_peticionAcceso = :id_peticion");
            $consulta->bindValue('estado',$datos->getEstado_peticion());
            $consulta->bindValue('conclusiones',$datos->getConclusiones());
            $consulta->bindValue('aprobacion',$datos->getAprobado());
            $consulta->bindValue('fecha_atendido', $datos->getFecha_atendido());
            $consulta->bindValue('usuario_atiende',$datos->getUsuario_atendio());
            $consulta->bindValue('id_peticion',$datos->getNombre());
            $consulta->bindValue('plataformas',$datos->getPlataformas());
            $consulta->bindValue('revisado',1);
            $consulta->execute();

            if($consulta){
                $resultado = 1;
            }else{
                $resultado = 0;
            }
            $db = null;
            return $resultado;
        } 

       
        public function getPeticionesxDelegadoDir($usuario){ /***** Busca las peticiones por los directores del departamento o cargos auxiliares  ******/
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT F2.usuario AS delegado , PA.id_peticionAcceso, PA.usuario_creacion, C1.descripcion AS cargo, A1.descripcion AS area, PA.descripcion, PA.tipo, PA.plataformas, PA.fecha_creacion, PA.estado, estado.descripcion AS estado_descripcion, PA.conclusiones, PA.fecha_atendido, PA.usuario_atiende, PA.nivel_encuesta, PA.aprobacion, PA.revisado 
                FROM peticiones_accesos PA 
                LEFT JOIN funcionarios F1 ON F1.usuario = usuario_creacion 
                LEFT JOIN cargos C1 ON C1.id_cargo = F1.cargo 
                LEFT JOIN areas A1 ON A1.id_area = C1.id_area 
                LEFT JOIN departamentos_internos DP1 ON DP1.id_departamento = A1.id_departamento 
                LEFT JOIN areas A2 ON A2.id_departamento = DP1.id_departamento && A2.descripcion LIKE 'Dirección%' 
                LEFT JOIN cargos C2 ON C2.id_area = A2.id_area && C2.descripcion LIKE 'Director%' 
                LEFT JOIN funcionarios F2 ON F2.cargo = C2.id_cargo && F2.festado = 5 
                LEFT JOIN estado ON PA.estado = estado.id_estado 
                WHERE (PA.estado = 1 || PA.estado = 8 || PA.estado = 3) && PA.aprobacion = 0 && F2.usuario = :usuario && PA.usuario_creacion != :usuario
                UNION
                SELECT F2.usuario AS delegado , PA.id_peticionAcceso, PA.usuario_creacion, C1.descripcion AS cargo, A1.descripcion AS area, PA.descripcion, PA.tipo, PA.plataformas, PA.fecha_creacion, PA.estado, estado.descripcion AS estado_descripcion, PA.conclusiones, PA.fecha_atendido, PA.usuario_atiende, PA.nivel_encuesta, PA.aprobacion, PA.revisado 
                FROM peticiones_accesos PA 
                LEFT JOIN funcionarios F1 ON F1.usuario = usuario_creacion 
                LEFT JOIN cargos C1 ON C1.id_cargo = F1.cargo 
                LEFT JOIN areas A1 ON A1.id_area = C1.id_area 
                LEFT JOIN departamentos_internos DP1 ON DP1.id_departamento = A1.id_departamento 
                LEFT JOIN areas A2 ON A2.id_departamento = DP1.id_departamento  
                LEFT JOIN cargos C2 ON C2.id_area = A2.id_area && C2.auxiliarDp = 1
                LEFT JOIN funcionarios F2 ON F2.cargo = C2.id_cargo && F2.festado = 5 
                LEFT JOIN estado ON PA.estado = estado.id_estado 
                WHERE (PA.estado = 1 || PA.estado = 8 || PA.estado = 3) && PA.aprobacion = 0 && F2.usuario = :usuario");
            $consulta->bindValue('usuario',$usuario);
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
                if(!((strncmp('Dirección', $listado['area'], 9) === 0)  && (strncmp('Director', $listado['cargo'], 8) === 0))){
                    $peticiones = new datosPeticionAccesos();
                    $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                    $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                    $peticiones->setDescripcion($listado['descripcion']);	
                    $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                    $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                    $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                    $peticiones->setEstado_peticion($listado['estado']);
                    $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                    $peticiones->setTipo($listado['tipo']);
                    $peticiones->setPlataformas($listado['plataformas']);	
                    $peticiones->setConclusiones($listado['conclusiones']);	
                    $peticiones->setRevisado($listado['revisado']);	
                    $peticiones->setAprobado($listado['aprobacion']);

                    $lista_peticiones[]=$peticiones;	
                }
			}
            $db = null;
			return $lista_peticiones;
           
        }

        public function getPeticionesxDelegadoGer(){ /***** Busca las peticiones por el gerente general  ******/
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT PA.id_peticionAcceso, PA.usuario_creacion, C1.descripcion AS cargo, A1.descripcion AS area, PA.descripcion, PA.tipo, PA.plataformas, PA.fecha_creacion, PA.estado, estado.descripcion AS estado_descripcion, PA.conclusiones, PA.fecha_atendido, PA.usuario_atiende, PA.nivel_encuesta, PA.aprobacion, PA.revisado 
            FROM peticiones_accesos PA 
            LEFT JOIN funcionarios F1 ON F1.usuario = usuario_creacion 
            LEFT JOIN cargos C1 ON C1.id_cargo = F1.cargo 
            LEFT JOIN areas A1 ON A1.id_area = C1.id_area 
            LEFT JOIN estado ON PA.estado = estado.id_estado
            WHERE A1.descripcion LIKE 'Dirección%' && C1.descripcion LIKE  'Director%' && F1.festado = 5
            UNION 
            SELECT PA.id_peticionAcceso, PA.usuario_creacion, C1.descripcion AS cargo, A1.descripcion AS area, PA.descripcion, PA.tipo, PA.plataformas, PA.fecha_creacion, PA.estado, estado.descripcion AS estado_descripcion, PA.conclusiones, PA.fecha_atendido, PA.usuario_atiende, PA.nivel_encuesta, PA.aprobacion, PA.revisado 
            FROM peticiones_accesos PA 
            LEFT JOIN funcionarios F1 ON F1.usuario = usuario_creacion 
            LEFT JOIN cargos C1 ON C1.id_cargo = F1.cargo 
            LEFT JOIN areas A1 ON A1.id_area = C1.id_area 
            LEFT JOIN departamentos_internos DP1 ON DP1.id_departamento = A1.id_departamento 
            LEFT JOIN estado ON PA.estado = estado.id_estado
            WHERE DP1.id_departamento = 1;");
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
                    $peticiones = new datosPeticionAccesos();
                    $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                    $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                    $peticiones->setDescripcion($listado['descripcion']);	
                    $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                    $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                    $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                    $peticiones->setEstado_peticion($listado['estado']);
                    $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                    $peticiones->setTipo($listado['tipo']);
                    $peticiones->setPlataformas($listado['plataformas']);	
                    $peticiones->setConclusiones($listado['conclusiones']);	
                    $peticiones->setRevisado($listado['revisado']);	
                    $peticiones->setAprobado($listado['aprobacion']);

                    $lista_peticiones[]=$peticiones;
			}
            $db = null;
			return $lista_peticiones;
           
        }

        public function plataformasxUsuario($usuario,$tipoConsulta){/* Evalua si el usuario es administrador de una o mas plataforma */
            $db = Conectar::acceso();
            $plataformas = [];

            $consulta_plataformas = $db->prepare("SELECT id_plataforma, plataformas.descripcion, nombre, administrador FROM plataformas LEFT JOIN funcionarios ON administrador = identificacion WHERE usuario = :usuario && plataformas.estado = 5");
            $consulta_plataformas->bindValue('usuario',$usuario);
            $consulta_plataformas->execute();

            if($tipoConsulta == 1){
                while($plataformas_listado = $consulta_plataformas->fetch(PDO::FETCH_ASSOC)){
                    $this->plataformas[] = $plataformas_listado;
                }
                
                return $this->plataformas;
            }else if($tipoConsulta == 2){
                if($consulta_plataformas->rowCount() > 0){
                    $dato =  1;
                }else{
                    $dato = 0;
                }
                return $dato;
            }
            $db = null;
        }

        public function accesoAprobaciones($usuario){/* Evalua si el usuario tiene cargo de gerente o director o si sus cargo es auxiliar de departamento */
            $db = Conectar::acceso();

            $consulta = $db->prepare("SELECT F.usuario,C.descripcion  FROM departamentos_internos DP 
                LEFT JOIN areas A ON A.id_departamento = DP.id_departamento && A.descripcion LIKE 'Dirección%' 
                LEFT JOIN cargos C ON C.id_area = A.id_area &&  C.descripcion LIKE 'Director%'  
                LEFT JOIN funcionarios F ON F.cargo = C.id_cargo && F.festado = 5 
                WHERE F.usuario = :usuario
                UNION 
                SELECT F.usuario,C.descripcion FROM cargos C 
                LEFT JOIN funcionarios F ON F.cargo = C.id_cargo && F.festado = 5 
                WHERE C.auxiliarDp = 1 && F.usuario = :usuario
                UNION 
                SELECT F.usuario ,C.descripcion from departamentos_internos DP 
                LEFT JOIN areas A ON A.id_departamento = DP.id_departamento && A.descripcion LIKE 'Gerencia General'
                LEFT JOIN cargos C ON C.id_area = A.id_area && C.descripcion LIKE 'Gerente General'
                LEFT JOIN funcionarios F ON F.cargo = C.id_cargo && F.festado = 5
                WHERE F.usuario = :usuario");
            $consulta->bindValue('usuario',$usuario);
            $consulta->execute();

            if($consulta->rowCount() > 0){
                $dato = 1;
                foreach ($consulta->fetchAll() as $listado){
                    if($listado['descripcion'] == 'Gerente General'){
                        $dato = 2;
                    }
                }
            }else{
                $dato = 0;
            }

            $db = null;
            return $dato;
        }

        /* Consulta y trae todos los funcionarios que esten en un departamento determinado dependindo el usuario actual (exeptuando el director de departamento)*/
        public function funcionariosxDepartamento($usuario){
            $db = Conectar::acceso();
            $funcionarios = [];

            $preConsulta = $db->prepare("SELECT DP.id_departamento FROM funcionarios F LEFT JOIN cargos C ON F.cargo = C.id_cargo LEFT JOIN areas A ON A.id_area = C.id_area LEFT JOIN departamentos_internos DP ON DP.id_departamento = A.id_departamento WHERE F.usuario = :usuario");
            $preConsulta->bindValue('usuario',$usuario);
            $preConsulta ->execute();

            if($preConsulta){
                $consultaFinalizada = $preConsulta->fetch(PDO::FETCH_ASSOC);
                $departamento = $consultaFinalizada['id_departamento'];

                $consulta = $db->prepare("SELECT usuario, nombre, fecha_registro FROM funcionarios F LEFT JOIN cargos C ON F.cargo = C.id_cargo LEFT JOIN areas A ON A.id_area = C.id_area LEFT JOIN departamentos_internos DP ON DP.id_departamento = A.id_departamento WHERE DP.id_departamento = :departamento && F.festado = 5 && (A.descripcion NOT LIKE 'Dirección%' && C.descripcion NOT LIKE 'Director%') ORDER BY nombre");
                $consulta->bindValue('departamento', $departamento);
                $consulta->execute();

                if($consulta){
                    while ($listado = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        $funcionarios[]=$listado;	
                    }
                    return $funcionarios;

                }else{
                    return 0;
                }

            }else{
                return 0;
            }
            $db = null;
        }


        public function getPeticionesxPlataformas($usuario){/* Obtiene las peticiones que esten aprobadas y que alguna de sus plataformas sea administrada por el usuario */
            $db = Conectar::acceso();
            $consultaPeticioneAprobadas = $db->prepare("SELECT id_peticionAcceso, PA.descripcion, tipo, plataformas, usuario_creacion, fecha_creacion, fecha_atendido, usuario_atiende, estado, estado.descripcion AS estado_descripcion, conclusiones, nivel_encuesta, aprobacion, revisado FROM peticiones_accesos PA LEFT JOIN estado ON PA.estado = id_estado WHERE (estado = 1 || estado = 3 || estado = 8) && aprobacion = 12");
            $consultaPeticioneAprobadas->execute();
            $listadoPeticiones =array();

            if($consultaPeticioneAprobadas){
                foreach($consultaPeticioneAprobadas->fetchAll() as $listado){
                    $platarformasArreglo = explode (',', $listado['plataformas']);
                    $numElement  = count($platarformasArreglo);
                    $esplat = 0;
                    for($x=0; $x<$numElement; $x++){
                        $consultaAdministradorPlataforma = $db->prepare("SELECT id_plataforma FROM `plataformas` LEFT JOIN funcionarios ON identificacion = administrador WHERE usuario = :usuario && id_plataforma = :id_plataforma");
                        $consultaAdministradorPlataforma->bindValue('usuario', $usuario);
                        $consultaAdministradorPlataforma->bindValue('id_plataforma',$platarformasArreglo[$x]);
                        $consultaAdministradorPlataforma->execute();

                        $cuenta = $consultaAdministradorPlataforma->rowCount();
                        if($cuenta > 0){
                            $esplat = 1;
                            break;
                        }
                    }

                    if($esplat == 1){
                        $peticiones = new datosPeticionAccesos();
                        $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                        $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                        $peticiones->setDescripcion($listado['descripcion']);	
                        $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                        $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                        $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                        $peticiones->setEstado_peticion($listado['estado']);
                        $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                        $peticiones->setTipo($listado['tipo']);
                        $peticiones->setPlataformas($listado['plataformas']);	
                        $peticiones->setConclusiones($listado['conclusiones']);	
                        $peticiones->setRevisado($listado['revisado']);	
                        $peticiones->setAprobado($listado['aprobacion']);

                        $listadoPeticiones[]=$peticiones;
                    }
                }

            }
            $db = null;
            return $listadoPeticiones;
        }


        public function insercionDeAccesos($acceso){
            $key = new keyCript();
            $db = Conectar::acceso();

            if($acceso->getEstado() == 12){
                $insertarAcceso = $db->prepare("INSERT INTO accesos_plataformas(plataforma,id_usuario,usuario,clave,estado,fecha_registro) VALUES(:plataforma, :id_usuario, :usuario, :clave, :estado, curdate())");
                $insertarAcceso->bindValue('plataforma', $acceso->getPlataforma());
                $insertarAcceso->bindValue('id_usuario',$acceso->getUsuario_Creacion());
                $insertarAcceso->bindValue('usuario',$acceso->getNombre());
                $insertarAcceso->bindValue('clave', $key->encript($acceso->getClave()));
                $insertarAcceso->bindValue('estado', 5);
                $insertarAcceso->execute();

            }

            $insertarSubRegistro = $db->prepare('UPDATE peticiones_accesos SET registro = CONCAT(registro,"/,,/",:plataforma,"/--/",:usuario,"/--/",:clave,"/--/",:estado) WHERE id_peticionAcceso = :id_peticionAcceso');
            $insertarSubRegistro->bindValue('plataforma', $acceso->getPlataforma());
            $insertarSubRegistro->bindValue('usuario', $acceso->getNombre());
            $insertarSubRegistro->bindValue('clave', $acceso->getClave());
            $insertarSubRegistro->bindValue('estado', $acceso->getEstado());
            $insertarSubRegistro->bindValue('id_peticionAcceso',$acceso->getNombre());
            $insertarSubRegistro->execute(); 
        }


        public function inactivacionDeAccesos($acceso){
            $db = Conectar::acceso();

            if($acceso->getEstado() == 12){
                $inactivacionAcceso = $db->prepare("UPDATE accesos_plataformas SET estado = :estado, fecha_inactivacion = curdate() WHERE id_accesoPlataforma = :id_acceso");
                $inactivacionAcceso->bindValue('estado',6);
                $inactivacionAcceso->bindValue('id_acceso',$acceso->getId_acceso());
                $inactivacionAcceso->execute();
            }
            
            $insertarSubRegistro = $db->prepare('UPDATE peticiones_accesos SET registro = CONCAT(registro,"/,,/",:plataforma,"/--/",:usuario,"/--/",:clave,"/--/",:estado) WHERE id_peticionAcceso = :id_peticionAcceso');
            $insertarSubRegistro->bindValue('plataforma',$acceso->getPlataforma());
            $insertarSubRegistro->bindValue('usuario', $acceso->getNombre());
            $insertarSubRegistro->bindValue('clave','No Use');
            $insertarSubRegistro->bindValue('estado', $acceso->getEstado());
            $insertarSubRegistro->bindValue('id_peticionAcceso',$acceso->getNombre());
            $insertarSubRegistro->execute();

        }
        public function inactivacionDeAccesosxNovedades($acceso){
            $db = Conectar::acceso();

            if($acceso->getEstado() == 12){
                $inactivacionAcceso = $db->prepare("UPDATE accesos_plataformas SET estado = :estado, fecha_inactivacion = curdate() WHERE id_accesoPlataforma = :id_acceso");
                $inactivacionAcceso->bindValue('estado',17);
                $inactivacionAcceso->bindValue('id_acceso',$acceso->getId_acceso());
                $inactivacionAcceso->execute();
            }
            
            $insertarSubRegistro = $db->prepare('UPDATE peticiones_accesos SET registro = CONCAT(registro,"/,,/",:plataforma,"/--/",:usuario,"/--/",:clave,"/--/",:estado) WHERE id_peticionAcceso = :id_peticionAcceso');
            $insertarSubRegistro->bindValue('plataforma',$acceso->getPlataforma());
            $insertarSubRegistro->bindValue('usuario', $acceso->getNombre());
            $insertarSubRegistro->bindValue('clave','No se afecta');
            $insertarSubRegistro->bindValue('estado', $acceso->getEstado());
            $insertarSubRegistro->bindValue('id_peticionAcceso',$acceso->getNombre());
            $insertarSubRegistro->execute();

        }
        public function activacionDeAccesosxNovedades($acceso){
            $db = Conectar::acceso();

            if($acceso->getEstado() == 12){
                $inactivacionAcceso = $db->prepare("UPDATE accesos_plataformas SET estado = :estado, fecha_inactivacion = curdate() WHERE id_accesoPlataforma = :id_acceso");
                $inactivacionAcceso->bindValue('estado',5);
                $inactivacionAcceso->bindValue('id_acceso',$acceso->getId_acceso());
                $inactivacionAcceso->execute();
            }
            
            $insertarSubRegistro = $db->prepare('UPDATE peticiones_accesos SET registro = CONCAT(registro,"/,,/",:plataforma,"/--/",:usuario,"/--/",:clave,"/--/",:estado) WHERE id_peticionAcceso = :id_peticionAcceso');
            $insertarSubRegistro->bindValue('plataforma',$acceso->getPlataforma());
            $insertarSubRegistro->bindValue('usuario', $acceso->getNombre());
            $insertarSubRegistro->bindValue('clave','No se afecta');
            $insertarSubRegistro->bindValue('estado', $acceso->getEstado());
            $insertarSubRegistro->bindValue('id_peticionAcceso',$acceso->getNombre());
            $insertarSubRegistro->execute();

        }


        public function modificarPlataformas($plataformas,$peticion,$conclusiones){
            $db = Conectar::acceso();
            if($plataformas == ''){
                $estado = 2;
            }else{
                $estado = 3;
            }
            $modificarPeticion = $db->prepare("UPDATE peticiones_accesos SET plataformas = :plataformas, estado = :estado, conclusiones = :conclusiones WHERE id_peticionAcceso = :id_peticion");
            $modificarPeticion->bindValue('plataformas',$plataformas);
            $modificarPeticion->bindValue('id_peticion', $peticion);
            $modificarPeticion->bindValue('estado', $estado);
            $modificarPeticion->bindValue('conclusiones',$conclusiones);
            $modificarPeticion->execute();

            if($estado == 2){
                $this->correoDeFinalizacion($peticion);
            }

        }
        public function negacionDePlataformas($plataformas,$peticion,$conclusiones){
            $db = Conectar::acceso();
            if($plataformas == ''){
                $estado = 2;
            }else{
                $estado = 3;
            }
            $modificarPeticion = $db->prepare("UPDATE peticiones_accesos SET plataformas = :plataformas, estado = :estado, conclusiones = :conclusiones, aprobacion = :aprobacion, revisado = :revisado WHERE id_peticionAcceso = :id_peticion");
            $modificarPeticion->bindValue('plataformas',$plataformas);
            $modificarPeticion->bindValue('id_peticion', $peticion);
            $modificarPeticion->bindValue('estado', $estado);
            $modificarPeticion->bindValue('aprobacion', 13);
            $modificarPeticion->bindValue('revisado', 1);
            $modificarPeticion->bindValue('conclusiones',$conclusiones);
            $modificarPeticion->execute();
        }

        public function getPlataformasxPeticion($id_peticion){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE id_peticionAcceso = :id_peticion");
            $consulta->bindValue('id_peticion', $id_peticion);
            $consulta->execute();
            
            $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
            $plataformas = $consultaFinalizada['plataformas'];
            return $plataformas;
        }

        public function accesoPlataformasxUsuario($usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_accesoPlataforma, plataforma, F.identificacion, AP.usuario, clave, AP.estado, estado.descripcion AS estadoDescripcion, AP.fecha_registro, AP.fecha_inactivacion, P.descripcion as plataforma_descripcion, FP.usuario as plataforma_administrador 
                FROM accesos_plataformas AP 
                LEFT JOIN funcionarios F ON F.identificacion = id_usuario 
                LEFT JOIN plataformas P ON P.id_plataforma = AP.plataforma 
                LEFT JOIN funcionarios FP ON P.administrador = FP.identificacion
                LEFT JOIN estado ON AP.estado = estado.id_estado
                WHERE F.usuario = :usuario && AP.estado = :estado");
            $consulta->bindValue('usuario', $usuario);
            $consulta->bindValue('estado', 5);
            $consulta->execute();
            $listadoAccesosPlataformas = array();

            if($consulta){
                foreach($consulta->fetchall() as $listado){
                    $accesosPlataformas = new datosAccesosPlataformas();
                    $accesosPlataformas->setId_accesoPlataforma($listado['id_accesoPlataforma']);
                    $accesosPlataformas->setPlataforma($listado['plataforma']);
                    $accesosPlataformas->setPlataformaDescripcion($listado['plataforma_descripcion']);
                    $accesosPlataformas->setPlataformaAdministrador($listado['plataforma_administrador']);
                    $accesosPlataformas->setId_usuario($listado['identificacion']);
                    $accesosPlataformas->setUsuario($listado['usuario']);
                    $accesosPlataformas->setClave($listado['clave']);
                    $accesosPlataformas->setEstado($listado['estado']);
                    $accesosPlataformas->setEstadoDescripcion($listado['estadoDescripcion']);
                    $accesosPlataformas->setFecha_registro($listado['fecha_registro']);
                    $accesosPlataformas->setFecha_inactivacion($listado['fecha_inactivacion']);
                    $listadoAccesosPlataformas[] = $accesosPlataformas;
                }
            }

            $db = null;
            return $listadoAccesosPlataformas;
        }
        public function accesoPlataformasxUsuarioInactive($usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_accesoPlataforma, plataforma, F.identificacion, AP.usuario, clave, AP.estado, estado.descripcion AS estadoDescripcion, AP.fecha_registro, AP.fecha_inactivacion, P.descripcion as plataforma_descripcion, FP.usuario as plataforma_administrador 
                FROM accesos_plataformas AP 
                LEFT JOIN funcionarios F ON F.identificacion = id_usuario 
                LEFT JOIN plataformas P ON P.id_plataforma = AP.plataforma 
                LEFT JOIN funcionarios FP ON P.administrador = FP.identificacion
                LEFT JOIN estado ON AP.estado = estado.id_estado
                WHERE F.usuario = :usuario && AP.estado = :estado");
            $consulta->bindValue('usuario', $usuario);
            $consulta->bindValue('estado', 17);
            $consulta->execute();
            $listadoAccesosPlataformas = array();

            if($consulta){
                foreach($consulta->fetchall() as $listado){
                    $accesosPlataformas = new datosAccesosPlataformas();
                    $accesosPlataformas->setId_accesoPlataforma($listado['id_accesoPlataforma']);
                    $accesosPlataformas->setPlataforma($listado['plataforma']);
                    $accesosPlataformas->setPlataformaDescripcion($listado['plataforma_descripcion']);
                    $accesosPlataformas->setPlataformaAdministrador($listado['plataforma_administrador']);
                    $accesosPlataformas->setId_usuario($listado['identificacion']);
                    $accesosPlataformas->setUsuario($listado['usuario']);
                    $accesosPlataformas->setClave($listado['clave']);
                    $accesosPlataformas->setEstado($listado['estado']);
                    $accesosPlataformas->setEstadoDescripcion($listado['estadoDescripcion']);
                    $accesosPlataformas->setFecha_registro($listado['fecha_registro']);
                    $accesosPlataformas->setFecha_inactivacion($listado['fecha_inactivacion']);
                    $listadoAccesosPlataformas[] = $accesosPlataformas;
                }
            }

            $db = null;
            return $listadoAccesosPlataformas;
        }
        public function accesoPlataformasxUsuarioInactivo($usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_accesoPlataforma, plataforma, F.identificacion, AP.usuario, clave, AP.estado, estado.descripcion AS estadoDescripcion, AP.fecha_registro, AP.fecha_inactivacion, P.descripcion as plataforma_descripcion, FP.usuario as plataforma_administrador 
                FROM accesos_plataformas AP 
                LEFT JOIN funcionarios F ON F.identificacion = id_usuario 
                LEFT JOIN plataformas P ON P.id_plataforma = AP.plataforma 
                LEFT JOIN funcionarios FP ON P.administrador = FP.identificacion
                LEFT JOIN estado ON AP.estado = estado.id_estado
                WHERE F.usuario = :usuario && AP.estado = :estado");
            $consulta->bindValue('usuario', $usuario);
            $consulta->bindValue('estado', 17);
            $consulta->execute();
            $listadoAccesosPlataformas = array();

            if($consulta){
                foreach($consulta->fetchall() as $listado){
                    $accesosPlataformas = new datosAccesosPlataformas();
                    $accesosPlataformas->setId_accesoPlataforma($listado['id_accesoPlataforma']);
                    $accesosPlataformas->setPlataforma($listado['plataforma']);
                    $accesosPlataformas->setPlataformaDescripcion($listado['plataforma_descripcion']);
                    $accesosPlataformas->setPlataformaAdministrador($listado['plataforma_administrador']);
                    $accesosPlataformas->setId_usuario($listado['identificacion']);
                    $accesosPlataformas->setUsuario($listado['usuario']);
                    $accesosPlataformas->setClave($listado['clave']);
                    $accesosPlataformas->setEstado($listado['estado']);
                    $accesosPlataformas->setEstadoDescripcion($listado['estadoDescripcion']);
                    $accesosPlataformas->setFecha_registro($listado['fecha_registro']);
                    $accesosPlataformas->setFecha_inactivacion($listado['fecha_inactivacion']);
                    $listadoAccesosPlataformas[] = $accesosPlataformas;
                }
            }

            $db = null;
            return $listadoAccesosPlataformas;
        }

        public function accesoPlataformasxUsuarioTodas($usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_accesoPlataforma, plataforma, F.identificacion, AP.usuario, clave, AP.estado, estado.descripcion AS estadoDescripcion, AP.fecha_registro, AP.fecha_inactivacion, P.descripcion as plataforma_descripcion, FP.usuario as plataforma_administrador 
                FROM accesos_plataformas AP 
                LEFT JOIN funcionarios F ON F.identificacion = id_usuario 
                LEFT JOIN plataformas P ON P.id_plataforma = AP.plataforma 
                LEFT JOIN funcionarios FP ON P.administrador = FP.identificacion
                LEFT JOIN estado ON AP.estado = estado.id_estado
                WHERE F.usuario = :usuario");
            $consulta->bindValue('usuario', $usuario);
            $consulta->execute();
            $listadoAccesosPlataformas = array();

            if($consulta){
                foreach($consulta->fetchall() as $listado){
                    $accesosPlataformas = new datosAccesosPlataformas();
                    $accesosPlataformas->setId_accesoPlataforma($listado['id_accesoPlataforma']);
                    $accesosPlataformas->setPlataforma($listado['plataforma']);
                    $accesosPlataformas->setPlataformaDescripcion($listado['plataforma_descripcion']);
                    $accesosPlataformas->setPlataformaAdministrador($listado['plataforma_administrador']);
                    $accesosPlataformas->setId_usuario($listado['identificacion']);
                    $accesosPlataformas->setUsuario($listado['usuario']);
                    $accesosPlataformas->setClave($listado['clave']);
                    $accesosPlataformas->setEstado($listado['estado']);
                    $accesosPlataformas->setEstadoDescripcion($listado['estadoDescripcion']);
                    $accesosPlataformas->setFecha_registro($listado['fecha_registro']);
                    $accesosPlataformas->setFecha_inactivacion($listado['fecha_inactivacion']);
                    $listadoAccesosPlataformas[] = $accesosPlataformas;
                }
            }

            $db = null;
            return $listadoAccesosPlataformas;
        }

        public function registroAccesosPeticion($id_peticion){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT registro FROM peticiones_accesos WHERE id_peticionAcceso = :peticion");
            $consulta->bindValue('peticion', $id_peticion);
            $consulta->execute();
            $listadoRegistros = array();

            if($consulta){
                $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
                $registro = $consultaFinalizada['registro'];
                $arregloRegistro = explode('/,,/',$registro);
                $numElement = count($arregloRegistro);

                for($x=1; $x<$numElement; $x++){
                    $arregloNivel2 = explode('/--/',$arregloRegistro[$x]);
                    $descripcionPlataforma = $db->prepare("SELECT descripcion FROM plataformas WHERE id_plataforma = :id_plataforma");
                    $descripcionPlataforma->bindValue('id_plataforma',$arregloNivel2[0]);
                    $descripcionPlataforma->execute();
                    $descripcionPlataformaFinalizada = $descripcionPlataforma->fetch(PDO::FETCH_ASSOC);
                    $descripcion = $descripcionPlataformaFinalizada['descripcion'];

                    $accesosPlataformas = new  datosAccesosPlataformas();
                    $accesosPlataformas->setPlataforma($arregloNivel2[0]);
                    $accesosPlataformas->setPlataformaDescripcion($descripcion);
                    $accesosPlataformas->setUsuario($arregloNivel2[1]);
                    $accesosPlataformas->setClave($arregloNivel2[2]);
                    $accesosPlataformas->setEstado($arregloNivel2[3]);
                    $listadoRegistros[] = $accesosPlataformas;  
                }
            }

            $db = null;
            return $listadoRegistros;
        }

        public function getPeticionesxDelegadoMai(){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_peticionAcceso, usuario_creacion, peticiones_accesos.descripcion, fecha_creacion, fecha_atendido, usuario_atiende, estado, estado.descripcion as estado_descripcion, tipo, plataformas, conclusiones, revisado, aprobacion FROM peticiones_accesos LEFT JOIN estado ON estado = id_estado");
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
                $peticiones = new datosPeticionAccesos();
                $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                $peticiones->setDescripcion($listado['descripcion']);	
                $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                $peticiones->setEstado_peticion($listado['estado']);
                $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                $peticiones->setTipo($listado['tipo']);
                $peticiones->setPlataformas($listado['plataformas']);	
                $peticiones->setConclusiones($listado['conclusiones']);	
                $peticiones->setRevisado($listado['revisado']);	
                $peticiones->setAprobado($listado['aprobacion']);

                $lista_peticiones[]=$peticiones;
            }

            $db = null;
            return $lista_peticiones;
        }

        public function getPeticionesxPlataformasMai(){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_peticionAcceso, usuario_creacion, peticiones_accesos.descripcion, fecha_creacion, fecha_atendido, usuario_atiende, estado, estado.descripcion as estado_descripcion, tipo, plataformas, conclusiones, revisado, aprobacion FROM peticiones_accesos LEFT JOIN estado ON estado = id_estado WHERE (estado = 1 || estado = 3 || estado = 8) && (aprobacion = 12)");
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
                $peticiones = new datosPeticionAccesos();
                $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                $peticiones->setDescripcion($listado['descripcion']);	
                $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                $peticiones->setEstado_peticion($listado['estado']);
                $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                $peticiones->setTipo($listado['tipo']);
                $peticiones->setPlataformas($listado['plataformas']);	
                $peticiones->setConclusiones($listado['conclusiones']);	
                $peticiones->setRevisado($listado['revisado']);	
                $peticiones->setAprobado($listado['aprobacion']);

                $lista_peticiones[]=$peticiones;
            }

            $db = null;
            return $lista_peticiones;
        }

        public function getPeticionesxUsuarios(){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT id_peticionAcceso, PA.descripcion, tipo, plataformas, usuario_creacion, fecha_creacion, fecha_atendido, usuario_atiende, estado, estado.descripcion AS estado_descripcion, conclusiones, nivel_encuesta, aprobacion, revisado FROM peticiones_accesos PA LEFT JOIN estado ON estado = estado.id_estado LIMIT 5000");
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
				$peticiones = new datosPeticionAccesos();
                $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                $peticiones->setDescripcion($listado['descripcion']);	
                $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                $peticiones->setEstado_peticion($listado['estado']);
                $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                $peticiones->setTipo($listado['tipo']);	
                $peticiones->setPlataformas($listado['plataformas']);	
                $peticiones->setConclusiones($listado['conclusiones']);	
                $peticiones->setRevisado($listado['revisado']);	
                $peticiones->setAprobado($listado['aprobacion']);

				$lista_peticiones[]=$peticiones;	
			}
            $db = null;
			return $lista_peticiones;

        }

        public function consultarClaveAccesoPlataforma($id_accesoPlataforma){
            $key = new keyCript();
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT clave FROM accesos_plataformas WHERE  id_accesoPlataforma = :id_accesoPlataforma LIMIT 1");
            $consulta->bindValue('id_accesoPlataforma',$id_accesoPlataforma);
            $consulta->execute();
        
            $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
            $clave = $consultaFinalizada['clave'];
            return $key->decript($clave);
        }

        public function modificarClaveAccesosPlataforma($id_accesoPlataforma,$clave){
            $key = new keyCript();
            $db = Conectar::acceso();
            $consulta = $db->prepare("UPDATE accesos_plataformas SET clave = :clave WHERE id_accesoPlataforma = :id_accesoPlataforma");
            $consulta->bindValue('id_accesoPlataforma', $id_accesoPlataforma);
            $consulta->bindValue('clave',$key->encript($clave));
            $consulta->execute();

        

            if($consulta){
                return 1;
            }else{
                return 0;
            }
            $db = null;
        }

        public function getPlataformasxCargo($usuario){
            $db = Conectar::acceso();
            $plataformasIngreso = '';

            $consulta = $db->prepare("SELECT plataformas FROM cargos LEFT JOIN funcionarios ON cargo = id_cargo  WHERE usuario = :usuario");
            $consulta->bindValue('usuario', $usuario);
            $consulta->execute();

            if($consulta){
                $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
                $plataformasIngreso = $consultaFinalizada['plataformas'];
                
                return  $plataformasIngreso;

            }else{
                return 0;
            }
            $db = null;

        }

        public function getPeticionesxUsuarioDir($usuario){ /***** Busca las peticiones por los directores del departamento o cargos auxiliares en Consulta ******/
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT F2.usuario AS delegado , PA.id_peticionAcceso, PA.usuario_creacion, C1.descripcion AS cargo, A1.descripcion AS area, PA.descripcion, PA.tipo, PA.plataformas, PA.fecha_creacion, PA.estado, estado.descripcion AS estado_descripcion, PA.conclusiones, PA.fecha_atendido, PA.usuario_atiende, PA.nivel_encuesta, PA.aprobacion, PA.revisado 
                FROM peticiones_accesos PA 
                LEFT JOIN funcionarios F1 ON F1.usuario = usuario_creacion 
                LEFT JOIN cargos C1 ON C1.id_cargo = F1.cargo 
                LEFT JOIN areas A1 ON A1.id_area = C1.id_area 
                LEFT JOIN departamentos_internos DP1 ON DP1.id_departamento = A1.id_departamento 
                LEFT JOIN areas A2 ON A2.id_departamento = DP1.id_departamento && A2.descripcion LIKE 'Dirección%' 
                LEFT JOIN cargos C2 ON C2.id_area = A2.id_area && C2.descripcion LIKE 'Director%' 
                LEFT JOIN funcionarios F2 ON F2.cargo = C2.id_cargo && F2.festado = 5 
                LEFT JOIN estado ON PA.estado = estado.id_estado 
                WHERE F2.usuario = :usuario 
                UNION
                SELECT F2.usuario AS delegado , PA.id_peticionAcceso, PA.usuario_creacion, C1.descripcion AS cargo, A1.descripcion AS area, PA.descripcion, PA.tipo, PA.plataformas, PA.fecha_creacion, PA.estado, estado.descripcion AS estado_descripcion, PA.conclusiones, PA.fecha_atendido, PA.usuario_atiende, PA.nivel_encuesta, PA.aprobacion, PA.revisado 
                FROM peticiones_accesos PA 
                LEFT JOIN funcionarios F1 ON F1.usuario = usuario_creacion 
                LEFT JOIN cargos C1 ON C1.id_cargo = F1.cargo 
                LEFT JOIN areas A1 ON A1.id_area = C1.id_area 
                LEFT JOIN departamentos_internos DP1 ON DP1.id_departamento = A1.id_departamento 
                LEFT JOIN areas A2 ON A2.id_departamento = DP1.id_departamento  
                LEFT JOIN cargos C2 ON C2.id_area = A2.id_area && C2.auxiliarDp = 1
                LEFT JOIN funcionarios F2 ON F2.cargo = C2.id_cargo && F2.festado = 5 
                LEFT JOIN estado ON PA.estado = estado.id_estado 
                WHERE F2.usuario = :usuario");
            $consulta->bindValue('usuario',$usuario);
            $consulta->execute();
            $lista_peticiones = array();

            foreach ($consulta->fetchAll() as $listado) {
                $peticiones = new datosPeticionAccesos();
                $peticiones->setId_peticion($listado['id_peticionAcceso']);	
                $peticiones->setUsuario_creacion($listado['usuario_creacion']);	
                $peticiones->setDescripcion($listado['descripcion']);	
                $peticiones->setFecha_creacion($listado['fecha_creacion']);	
                $peticiones->setFecha_atendido($listado['fecha_atendido']);	
                $peticiones->setUsuario_atendio($listado['usuario_atiende']);	
                $peticiones->setEstado_peticion($listado['estado']);
                $peticiones->setEstado_descripcion($listado['estado_descripcion']);	
                $peticiones->setTipo($listado['tipo']);
                $peticiones->setPlataformas($listado['plataformas']);	
                $peticiones->setConclusiones($listado['conclusiones']);	
                $peticiones->setRevisado($listado['revisado']);	
                $peticiones->setAprobado($listado['aprobacion']);

                $lista_peticiones[]=$peticiones;
			}
            $db = null;
			return $lista_peticiones;
           
        }

        public function correoDeFinalizacion($peticion){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT F.nombre ,F.mail, F.mail2,F.identificacion,C.descripcion, PA.id_peticionAcceso, PA.conclusiones, PA.registro, PA.tipo 
                                        FROM peticiones_accesos PA 
                                        LEFT JOIN funcionarios F ON F.usuario = PA.usuario_creacion 
                                        LEFT JOIN cargos C ON F.cargo = C.id_cargo 
                                        WHERE PA.id_peticionAcceso = :peticion && PA.estado = 2");
            $consulta->bindValue('peticion',$peticion);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            $mail1 = $resultado['mail'];
            $mail2 = $resultado['mail2'];
            $nombre = $resultado['nombre'];
            $identificacion = $resultado['identificacion'];
            $cargo = $resultado['descripcion'];
            $id_peticion = $resultado['id_peticionAcceso'];
            $conclusiones =$resultado['conclusiones'];
            $registro = $resultado['registro'];
            $tipo = $resultado['tipo'];

            $arregloRegistro = explode('/,,/',$registro);
            $numElement = count($arregloRegistro);

            $conclusiones = preg_replace("[\n|\r|\n\r]", "<br>", $conclusiones);
            
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.office365.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'no-responder@helisa.com'; // SMTP username
            $mail->Password = 'jkO5w6NqsJf7jRCop1X*#*'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to
            $mail->setFrom('no-responder@helisa.com');
            $mail->addAddress("$mail1");
            $mail->addAddress("$mail2");					
            $mail->isHTML(true); // Set email format to HTML
            switch ($tipo) {
                case 1:$subjects ="Aceptación entrega de accesos a plataformas PROASISTEMAS S.A.";break;
                case 2:$subjects ="Inactivacion entrega de accesos a plataformas PROASISTEMAS S.A.";break;
                case 3:$subjects ="Novedades entrega de accesos a plataformas PROASISTEMAS S.A.";break;
                case 4:$subjects ="Reactivacion entrega de accesos a plataformas PROASISTEMAS S.A.";break;
                               
            }
            $cuerpo="<style type='text/css'> 
            *{ 
                font-size: 15px;
            }
            p{
                margin-top:5%;
            }
            table, th, td {
                border: 1px solid;
            }
            table {
                width: 85%;
                border-collapse: collapse;
            }
            thead {
                background-color: #e83e8c;
            }
            </style>";
            $cuerpo.= "<h5><b>Colaborador: " . $nombre . "</b></h5>";
            $cuerpo.= "<h5><b>identificacion: " . $identificacion . "</b></h5>";
            $cuerpo.= "<h5><b>Cargo: " . $cargo . "</b></h5>";
	    $cuerpo.= "<h5><b>Nro. Peticion Acceso: " . $id_peticion . "</b></h5>";
            $cuerpo.= " <p>Cordial saludo.<br>
                        De acuerdo a la aceptación realizada en la plataforma de Soporte Interno
                        El presente correo tiene como fin reconfirmar la aceptación que usted a realizado para los accesos de las siguientes aplicaciones, que permitirá el desarrollo de sus funciones en la compañía:</p>";
            $cuerpo.="<div><table> <thead> <th>plataforma</th><th>usuario</th><th>Estado</th> </thead> <tbody>";
            
            for($x=1; $x<$numElement; $x++){
                $arregloNivel2 = explode('/--/',$arregloRegistro[$x]);
                $descripcionPlataforma = $db->prepare("SELECT descripcion FROM plataformas WHERE id_plataforma = :id_plataforma");
                $descripcionPlataforma->bindValue('id_plataforma',$arregloNivel2[0]);
                $descripcionPlataforma->execute();
                $descripcionPlataformaFinalizada = $descripcionPlataforma->fetch(PDO::FETCH_ASSOC);
                $descripcion = $descripcionPlataformaFinalizada['descripcion'];
                if($arregloNivel2[3] == 12){
                    $estado = "Aprobado";
                }else{
                    $estado = "No aprobado";
                }
                $cuerpo .= "<tr> <td>" . $descripcion . "</td> <td>" . $arregloNivel2[1] . "</td> <td>" . $estado . "</td> </tr>";
            }

            $cuerpo.="</tbody></table></div>";
            $cuerpo.="<p>En caso que usted no haya realizado el acceso a dicha plataforma ni la aceptación de los accesos mencionados en el párrafo anterior comuníquese de forma inmediata con su jefe directo y con el 
                        departamento de tecnología de lo contrario se dará por aprobada la aceptación realizada.</p>";
            $cuerpo.="Tenga presente que:";
            $cuerpo.="<br></br>";
            $cuerpo.="Las cuentas de Usuario y Password entregadas son de uso SECRETO, UNICO E INSTRASFERIBLE, usted es el único responsable del manejo que dé a las mismas.";
            $cuerpo.="<br></br>";
            $cuerpo.="Acostumbrarse a cerrar la sesión de cada plataforma al terminar las actividades.";
            $cuerpo.="<br></br>";
            $cuerpo.="No utilice la opción de recordar clave para el ingreso al aplicativo.";
            $cuerpo.="<br></br>";
            $cuerpo.="PROASISTEMAS se reserva el derecho de cancelar temporal o definitivamente una cuenta cuando se haga uso inapropiado del sistema";
            $cuerpo.="<br></br>";
            $cuerpo.="Es obligatorio asegurar que el equipo desde el cual se conecte tenga instalado y actualizado un software antivirus, así como los últimos parches de seguridad del sistema.";
            $cuerpo.="<br></br>";
            $cuerpo.="Recuerde que resguardar y proteger la información es responsabilidad de TODOS.";
            $cuerpo.="<br></br>";
            $cuerpo.="Asimismo, en seguimiento a los lineamientos de seguridad vigentes en PROASISTEMAS S.A., es de aclarar que los datos que sean o se encuentren registrados en las diferentes aplicaciones asignadas son de carácter reservado y de acceso restringido, por lo que es necesario que mantenga la seguridad y confidencialidad de la información a la que tiene acceso.";
            $cuerpo.="<br></br>";
            $cuerpo.="Toda la información registrada en las aplicaciones, tienen carácter de Declaración Jurada, es decir que cualquier acción efectuada en el Sistema, permitirá determinar la identidad del usuario y/o las acciones realizadas, cuando un Órgano de Control o Entidad de Vigilancia lo requiera.";
            $cuerpo.="<br></br>";
            $cuerpo.="Consulte nuestras políticas de seguridad de la información ingresando a nuestra página www.somoshelisa.com";
            $body = utf8_decode($cuerpo);
            $subject = utf8_decode($subjects);
            $mail->Subject = $subject;
            $mail->MsgHTML($body);
            $mail->send();

            } 
            catch (Exception $e){ 
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo; 
            }

        }

        /* ************************************************** */
        /* *** Listado de administradores de plataformas **** */
        /* ************************************************** */
        public function administradores(){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT administrador FROM plataformas GROUP BY administrador");
            $consulta->execute();
            $resultado = [];
  
            while($listado = $consulta->fetch(PDO::FETCH_ASSOC)){
                $this->resultado[]=$listado['administrador'];
            }
            $db = null;
            return $this->resultado;
        }

        /* ************************************************** */
        /* **** Obtiene el numero de administrador de la **** */
        /* *************** Plataforma *********************** */
        /* ************************************************** */
        public function administradorxPltaforma($plataforma){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT administrador FROM plataformas WHERE id_plataforma = :plataforma");
            $consulta->bindValue('plataforma',$plataforma);
            $consulta->execute();

            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            $administrador = $resultado['administrador'];
            $db = null;
            return $administrador;
        }

        
        /* ************************************************** */
        /* **** Determina si el funcionario tiene acceso **** */
        /* ******* a una plataforma especifica ************** */
        /* ************************************************** */
        public function trueAcces($plataforma,$usuario){
            $db = Conectar::acceso();
            $consultaIdent = $db->prepare("SELECT identificacion FROM funcionarios WHERE usuario = :usuario");
            $consultaIdent->bindValue("usuario",$usuario);
            $consultaIdent->execute();
            $resultado = $consultaIdent->fetch(PDO::FETCH_ASSOC);
            $identificacion = $resultado['identificacion'];

            $consulta = $db->prepare("SELECT id_accesoPlataforma FROM accesos_plataformas WHERE plataforma = :plataforma && estado = 5 && id_usuario = :id_user");
            $consulta->bindValue('plataforma', $plataforma);
            $consulta->bindValue('id_user',$identificacion);
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }

        public function inactiveAcces($plataforma,$usuario){
            $db = Conectar::acceso();
            $consultaIdent = $db->prepare("SELECT identificacion FROM funcionarios WHERE usuario = :usuario");
            $consultaIdent->bindValue("usuario",$usuario);
            $consultaIdent->execute();
            $resultado = $consultaIdent->fetch(PDO::FETCH_ASSOC);
            $identificacion = $resultado['identificacion'];

            $consulta = $db->prepare("SELECT id_accesoPlataforma FROM accesos_plataformas WHERE plataforma = :plataforma && estado = 17 && id_usuario = :id_user");
            $consulta->bindValue('plataforma', $plataforma);
            $consulta->bindValue('id_user',$identificacion);
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return 1;
            }else{
                return 0;
            }
        }

        /* ************************************************** */
        /* **** Determina si un acceso se encuentra en ****** */
        /* ******* una peticion de inactivacion ************* */
        /* ************************************************** */
        public function accesoEnPeticion($plataforma,$usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE usuario_creacion = :usuario && estado != 2 && tipo = 2");
            $consulta->bindValue('usuario', $usuario);
            $consulta->execute();


            $dato = 0;
            foreach($consulta->fetchAll() as $listado){
                $arreglo = explode(',',$listado['plataformas']);
                foreach($arreglo as $valor){
                    if($valor == $plataforma){
                        $dato = 1;
                        break;break;
                    }
                }
            }
            
            $db = null;
            return $dato;
        }
        public function accesoReActivacionEnPeticion($plataforma,$usuario){
            $db = Conectar::acceso();
            $consulta = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE usuario_creacion = :usuario && estado != 1 && tipo = 4");
            $consulta->bindValue('usuario', $usuario);
            $consulta->execute();


            $dato = 0;
            foreach($consulta->fetchAll() as $listado){
                $arreglo = explode(',',$listado['plataformas']);
                foreach($arreglo as $valor){
                    if($valor == $plataforma){
                        $dato = 1;
                        break;break;
                    }
                }
            }
            
            $db = null;
            return $dato;
        }



    }
