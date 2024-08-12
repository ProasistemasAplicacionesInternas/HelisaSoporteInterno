<?php
require_once("../model/vinculo.php");
require_once("../model/datosPeticionesSeguridad.php");


$datos = new PeticionSg();

if (isset($_POST['btn-consultarCategoria'])) {

    $db = conectar::acceso();
    $listaConsulta = [];

    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i") AS fecha_peticion, 
            DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacionsg, categorias.nombre_categoria, as nombre_categoria, descripcion_peticionsg, usuario_atencion, 
            conclusiones, imagen, imagen2, imagen3, imagen4, imagen5
                FROM peticiones_sg 
                LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
                LEFT JOIN categorias ON categorias.nombre_categoria = peticiones_sg.categoria
                WHERE id_peticionessg = :numero_peticion');

    $seleccion->bindValue('numero_peticion', $_POST['estadoFiltroCategoria']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setid_peticionSg($listado['id_peticionessg']);
        $consulta->setfecha_peticionSg($listado['fecha_peticion']);
        $consulta->setdescripcion_peticionSg($listado['descripcion_peticionsg']);
        $consulta->setfecha_atendidoSg($listado['fecha_atencion']);
        $consulta->setestado_peticionSg($listado['estado_peticion']);
        $consulta->setcategoriaSg($listado['categoria']);
        $consulta->setconclusiones_PeticionSg($listado['conclusiones']);
        $consulta->setusuario_atencionSg($listado['usuario_atencion']);
        $consulta->setArea_funcionario($listado['area']);
        $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
        $consulta->setEmail_funcionario($listado['mail']);
        $listaConsulta[] = $consulta;
    }
} elseif (isset($_POST['btn-consultarEstado'])) {
    $estado = $_POST['estadoFiltro'];

    $listaConsulta = [];

    $db = conectar::acceso();
    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado, DATE_FORMAT(fecha_peticion, "%d-%m-%Y %H:%i") AS fecha_peticion, 
            DATE_FORMAT(fecha_atencion, "%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacion, productos_mai.nombre_producto, descripcion_peticion, 
            usuario_atencion, conclusiones, nivel_encuesta, imagen, req_nombre, req_justificacion, sprint, gestion, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id
             AS nombre_categoria
                FROM peticiones_mai
                LEFT JOIN productos_mai ON id_producto = producto_mai
                LEFT JOIN estado ON estado.id_estado = peticiones_mai.estado_peticion
                LEFT JOIN tipo_soportemai ON tipo_soportemai.id = peticiones_mai.tipo_soportemai
                WHERE tipo_soportemai = :tipo_soportemai AND estado_peticion = :estado');
    $seleccion->bindValue('estado', $_POST['estadoFiltro']);
    $seleccion->bindValue('tipo_soportemai', '2');
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setid_peticionSg($listado['id_peticionessg']);
        $consulta->setfecha_peticionSg($listado['fecha_peticion']);
        $consulta->setdescripcion_peticionSg($listado['descripcion_peticionsg']);
        $consulta->setfecha_atendidoSg($listado['fecha_atencion']);
        $consulta->setestado_peticionSg($listado['estado_peticion']);
        $consulta->setcategoriaSg($listado['categoria']);
        $consulta->setconclusiones_PeticionSg($listado['conclusiones']);
        $consulta->setusuario_atencionSg($listado['usuario_atencion']);
        $consulta->setArea_funcionario($listado['area']);
        $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
        $consulta->setEmail_funcionario($listado['mail']);
        $listaConsulta[] = $consulta;
    }
} else if (isset($_POST['btn-consultarusuarioI'])) {
    $db = conectar::acceso();
    $seleccion = $db->prepare('SELECT id_peticionmai, estado.descripcion AS estado, DATE_FORMAT(fecha_peticion, "%d-%m-%Y %H:%i") AS fecha_peticion, 
            DATE_FORMAT(fecha_atencion, "%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacion, productos_mai.nombre_producto, descripcion_peticion, 
            usuario_atencion, conclusiones, nivel_encuesta, imagen, req_nombre, req_justificacion, sprint, gestion, tipo_soportemai, tipo_soportemai.nombre, tipo_soportemai.id
             AS nombre_categoria
                FROM peticiones_mai
                LEFT JOIN productos_mai ON id_producto = producto_mai
                LEFT JOIN estado ON estado.id_estado = peticiones_mai.estado_peticion
                LEFT JOIN tipo_soportemai ON tipo_soportemai.id = peticiones_mai.tipo_soportemai
                WHERE tipo_soportemai=:tipo_soportemai and usuario_creacion=:usuario');
    $seleccion->bindValue('usuario', $_POST['usuarioFiltro']);
    $seleccion->bindValue('tipo_soportemai', '2');
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setid_peticionSg($listado['id_peticionessg']);
        $consulta->setfecha_peticionSg($listado['fecha_peticion']);
        $consulta->setdescripcion_peticionSg($listado['descripcion_peticionsg']);
        $consulta->setfecha_atendidoSg($listado['fecha_atencion']);
        $consulta->setestado_peticionSg($listado['estado_peticion']);
        $consulta->setcategoriaSg($listado['categoria']);
        $consulta->setconclusiones_PeticionSg($listado['conclusiones']);
        $consulta->setusuario_atencionSg($listado['usuario_atencion']);
        $consulta->setArea_funcionario($listado['area']);
        $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
        $consulta->setEmail_funcionario($listado['mail']);
        $listaConsulta[] = $consulta;
    }
}
