<?php

require_once("../model/crudPeticionesSg.php");
require_once("../model/datosPeticionesSeguridad.php");
require_once("../model/vinculo.php");

$datos = new PeticionSg();

if (isset($_POST['btn-consultarTicket'])) {

    $db = conectar::acceso();
    $listaConsultaCom = [];

    $seleccion = $db->prepare('SELECT id_observaciones_sg, id_ticket_sg,  DATE_FORMAT(fecha_registro,"%d-%m-%Y "),usuario_creacion,descripcion_observaciones FROM observaciones_sg  WHERE  id_ticket_sg=:id_ticket_sg');
    $seleccion->bindValue('id_ticket_sg', $_POST['peticionFiltro']);
    $seleccion->execute();

    foreach ($seleccion->fetchAll() as $listado) {
        $consulta = new PeticionSg();
        $consulta->setIdPeticionSg($listado['id_observaciones_sg']);
        $consulta->setPeticionCom($listado['id_ticket_sg']);
        $consulta->setFechaPeticionSg($listado['DATE_FORMAT(fecha_registro,"%d-%m-%Y ")']);
        $consulta->setUsuarioAtencionSg($listado['usuario_creacion']);
        $consulta->setConclusionesPeticionSg($listado['descripcion_observaciones']);

        $listaConsultaCom[] = $consulta;
    }
}

if (isset($_POST['verConclusion'])) {
    $idTicket = $_POST['peticion1'];

    if (empty($idTicket)) {
        echo "Error: ID de petición es nulo o vacío.";
        exit();
    }

    try {
        $db = conectar::acceso();
        $cadena = "";
        $seleccion = $db->prepare('SELECT id_ticket_sg, DATE_FORMAT(fecha_observacion,"%d-%m-%Y ") as fecha,
            usuario_creacion, descripcion_observaciones 
            FROM observaciones_sg 
            WHERE id_ticket_sg=:id_ticket_sg');
        $seleccion->bindValue('id_ticket_sg', $idTicket);
        $seleccion->execute();

        if ($seleccion->rowCount() > 0) {
            while ($listadoAreas = $seleccion->fetch(PDO::FETCH_ASSOC)) {
                $cadena .= $listadoAreas['id_ticket_sg'] . "/-/" . $listadoAreas['fecha'] . "/-/" .
                    $listadoAreas['usuario_creacion'] . "/-/" . $listadoAreas["descripcion_observaciones"] . "/,/";
            }
        } else {
            echo "No se encontraron registros para el ID de petición: " . $idTicket;
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
    $seleccion = $db->prepare('SELECT id_observacion_sg ,id_ticket_sg, DATE_FORMAT(fecha_observacion,"%d-%m-%Y ") as fecha,
            usuario_creacion , descripcion_observaciones , estado_observacion 
            FROM observaciones_sg 
            WHERE id_ticket=:id_ticket ');
    $seleccion->bindValue('id_ticket', $_POST['peticion1']);
    $seleccion->execute();

    while ($listadoAreas = $seleccion->fetch(PDO::FETCH_ASSOC)) {
        $areas[] = $listadoAreas;
        $cadena .=  $listadoAreas['id_observacion_sg'] . "/-/" . $listadoAreas['id_ticket_sg'] . "/-/" . $listadoAreas['fecha'] . "/-/" .
            $listadoAreas['usuario_creacion'] . "/-/" . $listadoAreas["descripcion_observaciones"] . "/,/";
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

