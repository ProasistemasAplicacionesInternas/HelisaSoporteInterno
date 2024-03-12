<?php

require_once("../model/datos_gruposActivos.php");
require_once("../model/crud_gruposActivos.php");

$crudGroup = new crudGrupos();

$listado_grupos = $crudGroup->mostrarGrupos();

if (isset($_POST["actionsGroups"])) {
    switch ($_POST["actionsGroups"]) {
        case 'create':
            $data = convertClassGroups(null ,$_POST['nameGroup'], $_POST['categoryGroup']);
            $crudGroup->createGroup($data);
            break;

        case 'update':
            $data = convertClassGroups($_POST['idGroup'], $_POST['nameGroup'],  $_POST['categoryGroup']);
            $crudGroup->updateGroup($data);
            break;

        case 'consultAll':
            $resultados = $crudGroup->consultAllGroup();
            echo json_encode($resultados);
            break;

        case 'findById':
            $resultados = $crudGroup->findGroup($_POST['idGroup']);
            echo json_encode($resultados);
            break;
    }
}

function convertClassGroups($id, $name, $categoria)
{
    $datosGroups = new gruposActivos();
    $datosGroups->setId_grupo($id);
    $datosGroups->setNombre_grupos($name);
    $datosGroups->setAreaGrupo(32);
    $datosGroups->setCategoria($categoria);
    return $datosGroups;
}
?>