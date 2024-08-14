<?php

require_once("../model/crud_peticionesSg.php");
require_once("../model/datosPeticionesSeguridad.php");
require_once("../model/vinculo.php");

$datos = new PeticionSg();

if (isset($_POST['btn-consultarTicket'])) {

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
}

if (isset($_POST['verConclusion'])) {
    $id_ticket = $_POST['peticion1'];

    if (empty($id_ticket)) {
        echo "Error: ID de petición es nulo o vacío.";
        exit();
    }

    try {
        $db = conectar::acceso();
        $cadena = "";
        $seleccion = $db->prepare('SELECT id_observaciones_sg, id_ticket_sg, DATE_FORMAT(fecha_observacion,"%d-%m-%Y ") as fecha,
            usuario_creacion, descripcion_observaciones 
            FROM observaciones_sg 
            WHERE id_ticket_sg=:id_ticket_sg');
        $seleccion->bindValue('id_ticket_sg', $id_ticket);
        $seleccion->execute();

        if ($seleccion->rowCount() > 0) {
            while ($listado_areas = $seleccion->fetch(PDO::FETCH_ASSOC)) {
                $cadena .= $listado_areas['id_observaciones_sg'] . "/-/" . $listado_areas['id_ticket_sg'] . "/-/" . $listado_areas['fecha'] . "/-/" .
                    $listado_areas['usuario_creacion'] . "/-/" . $listado_areas["descripcion_observaciones"] . "/,/";
            }
        } else {
            echo "No se encontraron registros para el ID de petición: " . $id_ticket;
            exit();
        }
        echo $cadena;
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
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


if (isset($_POST['verDocumentos'])) {
    $db = Conectar::acceso();
    $ticketId = $_POST['peticion1'];

    if (empty($ticketId)) {
        echo json_encode([]);
        exit;
    }

    $archivos = CrudPeticionesSg::obtenerArchivosDeTicket($ticketId);
    echo json_encode($archivos);
}

