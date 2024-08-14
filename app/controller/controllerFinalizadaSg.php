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
            categorias.nombre_categoria AS categoria, descripcion_peticionsg, usuario_atencion, 
            conclusiones, imagen, imagen2, imagen3, imagen4, imagen5, funcionarios.area, 
            peticiones_sg.descripcion_peticionsg
            FROM peticiones_sg 
            LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
            LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg 
            LEFT JOIN areas ON areas.id_area=funcionarios.area 
            WHERE peticiones_sg.categoria = :categoriaSg'); // Asegúrate de usar el marcador correcto ":categoriaSg"

    $seleccion->bindValue(':categoriaSg', $_POST['estadoFiltroCategoria'], PDO::PARAM_INT); // Usa el marcador correcto ":categoriaSg"
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setid_peticionSg($listado['id_peticionessg']);
        $consulta->setfecha_peticionSg($listado['fecha_peticion']);
        $consulta->setdescripcion_peticionSg($listado['descripcion_peticionsg']);
        $consulta->setfecha_atendidoSg($listado['fecha_atencion']);
        $consulta->setestado_peticionSg($listado['estado_peticion']);
        $consulta->setcategoriaSg($listado['categoria']); // Usa la columna correcta aquí
        $consulta->setconclusiones_PeticionSg($listado['conclusiones']);
        $consulta->setusuario_atencionSg($listado['usuario_atencion']);
        $consulta->setArea_funcionario($listado['area']);
        $consulta->setUsuario_creacionSg($listado['usuario_creacionsg']);
        $listaConsulta[] = $consulta;
    }
} elseif (isset($_POST['btn-consultarEstado'])) {
    $estado = $_POST['estadoFiltroEs'];

    $listaConsulta = [];

    $db = conectar::acceso();
    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado_peticion, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i") AS fecha_peticion, 
            DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacionsg, categorias.nombre_categoria AS categoria,descripcion_peticionsg, usuario_atencion, 
            conclusiones, imagen, imagen2, imagen3, imagen4, imagen5, funcionarios.area, peticiones_sg.descripcion_peticionsg
            FROM peticiones_sg 
            LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
            LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg 
            LEFT JOIN areas ON areas.id_area=funcionarios.area
            WHERE estado_peticion = :estado');

    $seleccion->bindValue('estado', $_POST['estadoFiltroEs']);
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
        $listaConsulta[] = $consulta;
    }
} elseif (isset($_POST['btn-consultarTicketI'])) {

    $db = conectar::acceso();
    $listaConsulta = [];

    $seleccion = $db->prepare('SELECT id_peticionessg, estado.descripcion AS estado_peticion, DATE_FORMAT(fecha_peticion,"%d-%m-%Y %H:%i") AS fecha_peticion, 
    DATE_FORMAT(fecha_atencion,"%d-%m-%Y %H:%i") AS fecha_atencion, usuario_creacionsg, categorias.nombre_categoria AS categoria,descripcion_peticionsg, usuario_atencion, 
    conclusiones, imagen, imagen2, imagen3, imagen4, imagen5, funcionarios.area, peticiones_sg.descripcion_peticionsg
    FROM peticiones_sg 
    LEFT JOIN estado ON estado.id_estado = peticiones_sg.estado_peticion
    LEFT JOIN categorias ON categorias.id_categoria=peticiones_sg.categoria
    LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_sg.usuario_creacionsg 
    LEFT JOIN areas ON areas.id_area=funcionarios.area
        WHERE id_peticionessg = :numero_peticion');

    $seleccion->bindValue('numero_peticion', $_POST['peticionFiltro']);
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
        $listaConsulta[] = $consulta;
    }
}
