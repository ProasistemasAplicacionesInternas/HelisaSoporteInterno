<?php

    require_once('vinculo.php');

    class plataformas{

        public function getPlataformas(){
            $db = Conectar::acceso();
            $plataformas = [];

            $consulta_plataformas = $db->query("SELECT id_plataforma, plataformas.descripcion, nombre, administrador, usuario AS admin_usuario, estado FROM plataformas LEFT JOIN funcionarios ON administrador = identificacion ORDER BY descripcion");

            while($plataformas_listado = $consulta_plataformas->fetch(PDO::FETCH_ASSOC)){
                $this->plataformas[] = $plataformas_listado;
            }

            $db = null;
            return $this->plataformas;
        }

        public function crearPlataforma($descripcion, $administrador){
            $db = Conectar::acceso();

            $consulta = $db->prepare("SELECT descripcion FROM plataformas WHERE descripcion = :descripcion");
            $consulta->bindValue('descripcion',$descripcion);
            $consulta->execute();

            if($consulta){
                $numeroDeConsidencias = $consulta->rowCount();

                if($numeroDeConsidencias > 0){
                    $valor = 2;
                }else{
                    $insercion = $db->prepare("INSERT INTO plataformas(descripcion,administrador) VALUES(:descripcion,:administrador)");
                    $insercion->bindValue('descripcion',$descripcion);
                    $insercion->bindValue('administrador',$administrador);
                    $insercion->execute();

                    if($insercion){
                        $valor = 1;
                    }else{
                        $valor = 0;
                    }
                }
            }else{
                $valor = 0;
            }

            $db = null;
            return $valor;
        }

        public function modificarPlataforma($id,$administrador,$estado){
            $db = Conectar::acceso();

	    //consulta si la plataforma esta asociada a una peticion de acceso
        if($estado == 6){
            $consultaA = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE (estado = 1 || estado = 3 || estado = 8) && plataformas LIKE :idPlataforma");
            $consultaA->bindValue('idPlataforma',"%".$id."%");
            $consultaA->execute();

            foreach($consultaA as $registro){
                $arregloPlataformas = explode(',' , $registro['plataformas']);
                foreach($arregloPlataformas as $arrPlataforma){
                    if($arrPlataforma == $id){
                        return 6000;
                    }
                }   
            }
        }

        $consulta = $db->prepare("UPDATE plataformas SET administrador = :administrador, estado = :estado WHERE id_plataforma = :id");
            $consulta->bindValue("administrador",$administrador);
            $consulta->bindValue("estado",$estado);
            $consulta->bindValue("id",$id);
            $consulta->execute();

            if($consulta){
                $valor = 1;
            }else{
                $valor = 0;
            }
            $db = null;
            return $valor;
        }

        public function usuariosPeticiones($id){
            $db = Conectar::acceso();

            $consultaPendiente = $db->prepare("SELECT usuario_atiende FROM peticiones_accesos WHERE (estado = 3 || estado = 8) && plataformas LIKE :idPlataforma");
            $consultaPendiente->bindValue('idPlataforma',"%".$id."%");
            $consultaPendiente->execute();

                foreach($consultaPendiente as $registroPendiente){
                    $arregloUsuarioAtiende = implode(" - ", $registroPendiente);
                }


            $db = null;
            return $arregloUsuarioAtiende;
        }

    }