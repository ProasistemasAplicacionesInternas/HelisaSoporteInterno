<?php
require_once('vinculo.php');

class consultaAccesosFuncionario{

    public function traerDocumento($usuario){
        $db=Conectar::acceso();
<<<<<<< HEAD
        $consulta = $db->prepare("SELECT identificacion FROM funcionarios WHERE usuario=:id_usuario LIMIT 1");
        $consulta->bindValue('id_usuario', $usuario);
        $consulta->execute();  
        $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
        $identificacion = $consultaFinalizada['identificacion'];
=======
        $consulta = $db->prepare("SELECT id_usuario FROM accesos_plataformas WHERE usuario=:id_usuario LIMIT 1");
        $consulta->bindValue('id_usuario', $usuario);
        $consulta->execute();  
        $consultaFinalizada = $consulta->fetch(PDO::FETCH_ASSOC);
        $identificacion = $consultaFinalizada['id_usuario'];
>>>>>>> d07a9fb8f4e0c98d70372638cf652c5cce3d289e
        return $identificacion;
    }
    public function plataformasActivasxUsuario($identificacion){
        $db=Conectar::acceso();
        $consulta = $db->prepare("SELECT plataformas.descripcion AS plataforma, usuario, fecha_registro FROM accesos_plataformas 
        LEFT JOIN plataformas ON plataformas.id_plataforma=accesos_plataformas.plataforma
        WHERE accesos_plataformas.estado=:estado AND id_usuario=:id_usuario");
        $consulta->bindValue('id_usuario', $identificacion);
        $consulta->bindValue('estado', 5);
        $consulta->execute();
        $listadoPlataformasUsuario = array();
        if($consulta){
            foreach($consulta->fetchall() as $listado){
                $accesosPlataformas = new datosAccesosPlataformas();
                $accesosPlataformas->setPlataforma($listado['plataforma']);
                $accesosPlataformas->setUsuario($listado['usuario']);
                $accesosPlataformas->setFecha_registro($listado['fecha_registro']);
                $listadoPlataformasUsuario[] = $accesosPlataformas;
            }
        }
        $db = null;
        return $listadoPlataformasUsuario;
    }
}     
        


?>