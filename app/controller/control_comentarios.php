<?php
//require('../model/crud_peticiones.php');
require_once('../model/datos_peticion.php');
require_once("../model/vinculo.php");

$datos = new Peticion();

if (isset($_POST['btn-consultarFecha'])) {

    $inicio = date('Y-m-d 00:00:00', strtotime($_POST['fechaInicial']));
    $final = date('Y-m-d 23:59:59', strtotime($_POST['fechaFinal']));

    $db = conectar::acceso();
    $listaConsultaCom = [];

    $seleccion = $db->prepare('SELECT  id_comentario,id_peticion,  DATE_FORMAT(fecha_registro,"%d-%m-%Y "),responsable,comentario FROM comentarios_peticiones WHERE fecha_registro BETWEEN :fechaInicial AND :fechaFinal');
    $seleccion->bindValue('fechaInicial', $inicio);
    $seleccion->bindValue('fechaFinal', $final);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new Peticion();
        $consulta->setP_nropeticion($listado['id_comentario']);
        $consulta->setPeticion_co($listado['id_peticion']);
        $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setP_usuario($listado['responsable']);
        $consulta->setP_conclusiones($listado['comentario']);

        $listaConsultaCom[] = $consulta;
    }
} else if (isset($_POST['btn-consultarTicket'])) {

    $db = conectar::acceso();
    $listaConsultaCom = [];

    $seleccion = $db->prepare('SELECT  id_comentario,id_peticion,  DATE_FORMAT(fecha_registro,"%d-%m-%Y "),responsable,comentario FROM comentarios_peticiones  WHERE  id_peticion=:id_peticion');
    $seleccion->bindValue('id_peticion', $_POST['peticionFiltro']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new Peticion();
        $consulta->setP_nropeticion($listado['id_comentario']);
        $consulta->setPeticion_co($listado['id_peticion']);
        $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setP_usuario($listado['responsable']);
        $consulta->setP_conclusiones($listado['comentario']);

        $listaConsultaCom[] = $consulta;
    }
} else if (isset($_POST['btn-consultarId'])) {

    $db = conectar::acceso();
    $listaConsultaCom = [];

    $seleccion = $db->prepare('SELECT cp.id_comentario,cp.id_peticion, DATE_FORMAT(cp.fecha_registro,"%d-%m-%Y "),cp.responsable,cp.comentario,p.usuario,f.identificacion  FROM comentarios_peticiones cp LEFT JOIN peticiones p ON cp.id_peticion = p.numero_peticion LEFT JOIN funcionarios f ON p.usuario = f.usuario WHERE f.identificacion =:identificacion');
    $seleccion->bindValue('identificacion', $_POST['idFiltro']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new Peticion();
        $consulta->setP_nropeticion($listado['id_comentario']);
        $consulta->setPeticion_co($listado['id_peticion']);
        $consulta->setP_fechapeticion($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setP_usuario($listado['responsable']);
        $consulta->setP_conclusiones($listado['comentario']);

        $listaConsultaCom[] = $consulta;
    }
}


if (isset($_POST['comentar'])) {

    $db = conectar::acceso();
    $listaComentario = [];
    $seleccion = $db->prepare('SELECT  id_comentario,id_peticion, DATE_FORMAT(fecha_registro,"%d-%m-%Y "),responsable,comentario FROM comentarios_peticiones  WHERE  id_peticion=:id_peticiones');
    $seleccion->bindValue('id_peticiones', $_POST['peticion']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $lista) {
        $consulta = new Peticion();
        $consulta->setP_nropeticion($lista['id_comentario']);
        $consulta->setPeticion_co($lista['id_peticion']);
        $consulta->setP_fechapeticion($lista['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setP_usuario($lista['responsable']);
        $consulta->setP_conclusiones($lista['comentario']);

        $listaComentario[] = $consulta;
    }
}

if (isset($_POST['verConclusion'])) {

    $db = conectar::acceso();
    $areas = [];
    $cadena = "";
    $seleccion = $db->prepare('SELECT id_observacion,id_ticket, DATE_FORMAT(fecha_observacion,"%d-%m-%Y ") as fecha,
            usuario_creacion,descripcion_observacion, estado_observacion 
            FROM observaciones_mai 
            WHERE id_ticket=:id_ticket ');
    $seleccion->bindValue('id_ticket', $_POST['peticion1']);
    $seleccion->execute();

    while ($listado_areas = $seleccion->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $listado_areas;
        $cadena .=  $listado_areas['id_observacion'] . "/-/" . $listado_areas['id_ticket'] . "/-/" . $listado_areas['fecha'] . "/-/" .
            $listado_areas['usuario_creacion'] . "/-/" . $listado_areas["descripcion_observacion"] . "/,/";
    }
    echo $cadena;
}

if (isset($_POST['verComentarios'])) {

    $db = conectar::acceso();
    $areas = [];
    $cadena = "";
    $seleccion = $db->prepare('SELECT  id_comentario, id_peticion, DATE_FORMAT(fecha_registro,"%d-%m-%Y ") as fecha, responsable,comentario FROM comentarios_peticiones  WHERE  id_peticion=:id_peticiones');
    $seleccion->bindValue('id_peticiones', $_POST['peticion']);
    $seleccion->execute();

    while ($listado_areas = $seleccion->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $listado_areas;
        $cadena .=  $listado_areas['id_comentario'] . "/-/" . $listado_areas['id_peticion'] . "/-/" . $listado_areas['fecha'] . "/-/" .
            $listado_areas['responsable'] . "/-/" . $listado_areas["comentario"] . "/,/";
    }
    echo $cadena;
}

if (isset($_POST['verConclusionFuncionarios'])) {

    $db = conectar::acceso();
    $areas = [];
    $cadena = "";
    $seleccion = $db->prepare('SELECT id_observacion,id_ticket, DATE_FORMAT(fecha_observacion,"%d-%m-%Y ") as fecha,
            usuario_creacion,descripcion_observacion, estado_observacion 
            FROM observaciones_mai 
            WHERE id_ticket=:id_ticket ');
    $seleccion->bindValue('id_ticket', $_POST['peticion1']);
    $seleccion->execute();

    while ($listado_areas = $seleccion->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $listado_areas;
        $cadena .=  $listado_areas['id_observacion'] . "/-/" . $listado_areas['id_ticket'] . "/-/" . $listado_areas['fecha'] . "/-/" .
            $listado_areas['usuario_creacion'] . "/-/" . $listado_areas["descripcion_observacion"] . "/,/";
    }
    echo $cadena;
}
