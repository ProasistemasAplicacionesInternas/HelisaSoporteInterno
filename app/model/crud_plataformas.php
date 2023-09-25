<?php

require_once('vinculo.php');

class plataformas
{

    public function getPlataformas()
    {
        $db = Conectar::acceso();
        $plataformas = [];

        $consulta_plataformas = $db->query("SELECT id_plataforma, plataformas.descripcion, nombre, administrador, usuario AS admin_usuario, estado FROM plataformas LEFT JOIN funcionarios ON administrador = identificacion ORDER BY descripcion");

        while ($plataformas_listado = $consulta_plataformas->fetch(PDO::FETCH_ASSOC)) {
            $this->plataformas[] = $plataformas_listado;
        }

        $db = null;
        return $this->plataformas;
    }

    public function crearPlataforma($descripcion, $administrador)
    {
        $db = Conectar::acceso();

        $consulta = $db->prepare("SELECT descripcion FROM plataformas WHERE descripcion = :descripcion");
        $consulta->bindValue('descripcion', $descripcion);
        $consulta->execute();

        if ($consulta) {
            $numeroDeConsidencias = $consulta->rowCount();

            if ($numeroDeConsidencias > 0) {
                $valor = 2;
            } else {
                $insercion = $db->prepare("INSERT INTO plataformas(descripcion,administrador) VALUES(:descripcion,:administrador)");
                $insercion->bindValue('descripcion', $descripcion);
                $insercion->bindValue('administrador', $administrador);
                $insercion->execute();

                if ($insercion) {
                    $valor = 1;
                } else {
                    $valor = 0;
                }
            }
        } else {
            $valor = 0;
        }

        $db = null;
        return $valor;
    }

    public function modificarPlataforma($id, $administrador, $estado)
    {
        $db = Conectar::acceso();

        //consulta si la plataforma esta asociada a una peticion de acceso
        if ($estado == 6) {
            $consultaNuevo = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE (estado = 1) && plataformas LIKE :idPlataforma");
            $consultaNuevo->bindValue('idPlataforma', "%" . $id . "%");
            $consultaNuevo->execute();

            foreach ($consultaNuevo as $registroNuevo) {
                $arregloPlataformasNuevo = explode(',', $registroNuevo['plataformas']);
                foreach ($arregloPlataformasNuevo as $arrPlataformaNuevo) {
                    if ($arrPlataformaNuevo == $id) {
                        return 6000;
                    }
                }
            }

            $consultaPendiente = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE (estado = 3 ) && plataformas LIKE :idPlataforma");
            $consultaPendiente->bindValue('idPlataforma', "%" . $id . "%");
            $consultaPendiente->execute();

            foreach ($consultaPendiente as $registroPendiente) {
                $arregloPlataformasPendiente = explode(',', $registroPendiente['plataformas']);
                foreach ($arregloPlataformasPendiente as $arrPlataformaPendiente) {
                    if ($arrPlataformaPendiente == $id) {
                        return 7000;
                    }
                }
            }

            $consultaSeleccionada = $db->prepare("SELECT plataformas FROM peticiones_accesos WHERE ( estado = 8) && plataformas LIKE :idPlataforma");
            $consultaSeleccionada->bindValue('idPlataforma', "%" . $id . "%");
            $consultaSeleccionada->execute();

            foreach ($consultaSeleccionada as $registroSeleccionado) {
                $arregloPlataformasSeleccionado = explode(',', $registroSeleccionado['plataformas']);
                foreach ($arregloPlataformasSeleccionado as $arregloPlataformasSeleccionado) {
                    if ($arregloPlataformasSeleccionado == $id) {
                        return 5000;
                    }
                }
            }

            $consultaPendiente = $db->prepare("SELECT plataforma FROM accesos_plataformas WHERE (estado = 5) && plataforma LIKE :idPlataforma");
            $consultaPendiente->bindValue('idPlataforma', "%" . $id . "%");
            $consultaPendiente->execute();

            foreach ($consultaPendiente as $registroPendiente) {
                $arregloPlataformasPendiente = explode(',', $registroPendiente['plataforma']);
                foreach ($arregloPlataformasPendiente as $arrPlataformaPendiente) {
                    if ($arrPlataformaPendiente == $id) {
                        return 8000;
                    }
                }
            }
        }

        $consulta = $db->prepare("UPDATE plataformas SET administrador = :administrador, estado = :estado WHERE id_plataforma = :id");
        $consulta->bindValue("administrador", $administrador);
        $consulta->bindValue("estado", $estado);
        $consulta->bindValue("id", $id);
        $consulta->execute();

        if ($consulta) {
            $valor = 1;
        } else {
            $valor = 0;
        }
        $db = null;
        return $valor;
    }

    public function usuariosPeticiones($id)
    {
        $db = Conectar::acceso();

        $consultaPendiente = $db->prepare("SELECT usuario_creacion FROM peticiones_accesos WHERE (estado = 3 || estado = 8) && plataformas LIKE :idPlataforma");
        $consultaPendiente->bindValue('idPlataforma', "%" . $id . "%");
        $consultaPendiente->execute();

        $usuariosPeticiones = [];

        foreach ($consultaPendiente as $registroPendiente) {
            $usuariosPeticiones[] = $registroPendiente['usuario_creacion'];
        }

        $usuariosUnicos = array_unique($usuariosPeticiones);
        $arregloUsuarioCreacion = implode(",", $usuariosUnicos);

        $db = null;
        return $arregloUsuarioCreacion;
    }

    public function usuariosPlataformas($id)
    {
        $db = Conectar::acceso();

        $consultaPendiente = $db->prepare("SELECT usuario FROM accesos_plataformas WHERE (estado = 5) && plataforma LIKE :idPlataforma");
        $consultaPendiente->bindValue('idPlataforma', "%" . $id . "%");
        $consultaPendiente->execute();

        $usuariosPeticiones = [];

        foreach ($consultaPendiente as $registroPendiente) {
            $usuariosPeticiones[] = $registroPendiente['usuario'];
        }

        $usuariosUnicos = array_unique($usuariosPeticiones);
        $arregloUsuario = implode(",", $usuariosUnicos);

        $db = null;
        return $arregloUsuario;
    }
}
