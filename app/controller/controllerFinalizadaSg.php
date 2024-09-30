<?php


require_once("../model/datosPeticionesSeguridad.php");
require_once("../model/vinculo.php");


$datos = new PeticionSg();

if (isset($_POST['btn-consultarCategoria'])) {

    $db = conectar::acceso();
    $listaConsulta = [];
    $estado = $_POST['estadoFiltroCategoria'];

    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado_peticion, 
            DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i") AS fecha_peticion, 
            DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacionsg, 
            categorias_sg.nombre_categoria AS categoria, descripcion_peticionsg, usuario_atencion, 
            conclusiones, imagen, imagen2, imagen3, imagen4, imagen5, funcionarios.area, 
            peticiones_sg.descripcion_peticionsg
            FROM peticiones_sg 
            LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
            LEFT JOIN categorias_sg ON categorias_sg.id_categoria=peticiones_sg.categoria
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg 
            LEFT JOIN areas ON areas.id_area=funcionarios.area 
            WHERE peticiones_sg.categoria = :categoriaSg');

    $seleccion->bindValue(':categoriaSg', $_POST['estadoFiltroCategoria'], PDO::PARAM_INT);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setIdPeticionSg($listado['id_peticionessg']);
        $consulta->setFechaPeticionSg($listado['fecha_peticion']);
        $consulta->setDescripcionPeticionSg($listado['descripcion_peticionsg']);
        $consulta->setFechaAtendidoSg($listado['fecha_atencion']);
        $consulta->setEstadoPeticionSg($listado['estado_peticion']);
        $consulta->setCategoriaSg($listado['categoria']);
        $consulta->setConclusionesPeticionSg($listado['conclusiones']);
        $consulta->setUsuarioAtencionSg($listado['usuario_atencion']);
        $consulta->setAreaFuncionario($listado['area']);
        $consulta->setUsuarioCreacionSg($listado['usuario_creacionsg']);
        $listaConsulta[] = $consulta;
    }
} elseif (isset($_POST['btn-consultarEstado'])) {
    $estado = $_POST['estadoFiltroEs'];

    $listaConsulta = [];

    $db = conectar::acceso();
    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado_peticion, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i") AS fecha_peticion, 
            DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacionsg, categorias_sg.nombre_categoria AS categoria,descripcion_peticionsg, usuario_atencion, 
            conclusiones, imagen, imagen2, imagen3, imagen4, imagen5, funcionarios.area, peticiones_sg.descripcion_peticionsg
            FROM peticiones_sg 
            LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
            LEFT JOIN categorias_sg ON categorias_sg.id_categoria=peticiones_sg.categoria
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg 
            LEFT JOIN areas ON areas.id_area=funcionarios.area
            WHERE estado_peticion = :estado');

    $seleccion->bindValue('estado', $_POST['estadoFiltroEs']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setIdPeticionSg($listado['id_peticionessg']);
        $consulta->setFechaPeticionSg($listado['fecha_peticion']);
        $consulta->setDescripcionPeticionSg($listado['descripcion_peticionsg']);
        $consulta->setFechaAtendidoSg($listado['fecha_atencion']);
        $consulta->setEstadoPeticionSg($listado['estado_peticion']);
        $consulta->setcategoriaSg($listado['categoria']);
        $consulta->setConclusionesPeticionSg($listado['conclusiones']);
        $consulta->setUsuarioAtencionSg($listado['usuario_atencion']);
        $consulta->setAreaFuncionario($listado['area']);
        $consulta->setUsuarioCreacionSg($listado['usuario_creacionsg']);
        $listaConsulta[] = $consulta;
    }
} elseif (isset($_POST['btn-consultarTicketI'])) {

    $db = conectar::acceso();
    $listaConsulta = [];

    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado_peticion, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i") AS fecha_peticion, 
    DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacionsg, categorias_sg.nombre_categoria AS categoria,descripcion_peticionsg, usuario_atencion, 
    conclusiones, imagen, imagen2, imagen3, imagen4, imagen5, funcionarios.area, peticiones_sg.descripcion_peticionsg
    FROM peticiones_sg 
    LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
    LEFT JOIN categorias_sg ON categorias_sg.id_categoria=peticiones_sg.categoria
    LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg 
    LEFT JOIN areas ON areas.id_area=funcionarios.area
        WHERE id_peticionessg = :numero_peticion');

    $seleccion->bindValue('numero_peticion', $_POST['peticionFiltro']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setIdPeticionSg($listado['id_peticionessg']);
        $consulta->setFechaPeticionSg($listado['fecha_peticion']);
        $consulta->setDescripcionPeticionSg($listado['descripcion_peticionsg']);
        $consulta->setFechaAtendidoSg($listado['fecha_atencion']);
        $consulta->setEstadoPeticionSg($listado['estado_peticion']);
        $consulta->setCategoriaSg($listado['categoria']);
        $consulta->setConclusionesPeticionSg($listado['conclusiones']);
        $consulta->setUsuarioAtencionSg($listado['usuario_atencion']);
        $consulta->setAreaFuncionario($listado['area']);
        $consulta->setUsuarioCreacionSg($listado['usuario_creacionsg']);
        $listaConsulta[] = $consulta;
    }
}
