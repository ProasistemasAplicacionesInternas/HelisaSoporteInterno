<?php
require_once __DIR__ . "/vinculo.php";

class DatosBoard
{

    public function soportesNuevos()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(numero_peticion) AS soportes FROM peticiones WHERE estado=:estadoU');
        $soportes_nuevos->bindValue('estadoU', '1');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }
    public function soportesPendientes()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(numero_peticion) AS soportes FROM peticiones WHERE estado=:estadoT');
        $soportes_nuevos->bindValue('estadoT', '3');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }
    public function soportesSeleccionados()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(numero_peticion) AS soportes FROM peticiones WHERE estado=:estadoO');
        $soportes_nuevos->bindValue('estadoO', '8');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    public function soportesNuevosMai()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionmai) AS soportes FROM peticiones_mai WHERE estado_peticion=:estadoU AND (tipo_soportemai=1 OR tipo_soportemai=3)');
        $soportes_nuevos->bindValue('estadoU', '1');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }
    public function soportesPendientesMai()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionmai) AS soportes FROM peticiones_mai WHERE estado_peticion=:estadoT AND (tipo_soportemai=1 OR tipo_soportemai=3)');
        $soportes_nuevos->bindValue('estadoT', '3');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }
    public function soportesSeleccionadosMai()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionmai) AS soportes FROM peticiones_mai WHERE estado_peticion=:estadoO AND (tipo_soportemai=1 OR tipo_soportemai=3)');
        $soportes_nuevos->bindValue('estadoO', '8');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    /* ----------REQUERIMIENTOS---------*/

    public function requerimientosNuevos()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionmai) AS soportes FROM peticiones_mai WHERE tipo_soportemai=2 AND estado_peticion=:estadoU');
        $soportes_nuevos->bindValue('estadoU', '1');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    public function requerimientosPendientes()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionmai) AS soportes FROM peticiones_mai WHERE tipo_soportemai=2 AND estado_peticion=:estadoT');
        $soportes_nuevos->bindValue('estadoT', '3');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    public function requerimientosSeleccionados()
    {
        $db = Conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionmai) AS soportes FROM peticiones_mai WHERE tipo_soportemai=2 AND estado_peticion=:estadoO');
        $soportes_nuevos->bindValue('estadoO', '8');
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    /* ----------Seguridad---------*/

    public function soporteNuevoSeguridad()
    {
        $db = conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionessg) AS soportes FROM peticiones_sg WHERE estado_peticion=:estadoN');
        $soportes_nuevos->bindvalue('estadoN', 1);
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    public function soportesPendienteSeguridad()
    {
        $db = conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionessg) AS soportes FROM peticiones_sg WHERE estado_peticion=:estadoP');
        $soportes_nuevos->bindvalue('estadoP', 2);
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }

    public function soportesProcesoSeguridad()
    {
        $db = conectar::acceso();
        $soportes_nuevos = $db->prepare('SELECT COUNT(id_peticionessg) AS soportes FROM peticiones_sg WHERE estado_peticion=:estadoPrc');
        $soportes_nuevos->bindvalue('estadoPrc', 22);
        $soportes_nuevos->execute();
        $data_soportes = $soportes_nuevos->fetch(PDO::FETCH_ASSOC);
        return $data_soportes;
    }
}
