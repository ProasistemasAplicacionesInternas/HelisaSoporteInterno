<?php

require_once("../model/datos_gruposActivos.php");
require_once("../model/crud_gruposActivos.php");

$crudGroup = new crudGrupos();

$listado_grupos = $crudGroup->mostrarGrupos();

if (isset($_POST["actionsGroups"])) {
    try {
        switch ($_POST["actionsGroups"]) {
            case 'create':
                if ($crudGroup->groupExists($_POST['nameGroup'])) {
                    echo json_encode(['error' => 'Ya existe un grupo con este nombre']);
                } else {
                    $data = convertClassGroups(null, $_POST['nameGroup'], $_POST['areaGroup'], $_POST['categoryGroup'], 5);
                    $crudGroup->createGroup($data);
                }
                break;
                case 'update':
                    if ($crudGroup->checkGroupExists($_POST['nameGroup'], $_POST['idGroup'])) {
                        echo json_encode(['error' => 'Ya existe un grupo con este nombre']);
                    } else {
                        $data = convertClassGroups(
                            $_POST['idGroup'], 
                            $_POST['nameGroup'], 
                            $_POST['areaGroup'], 
                            $_POST['categoryGroup'], 
                            null
                        );

                        $crudGroup->updateGroup($data);
                    }
                    break;

            case 'consultAll':
                $resultados = $crudGroup->consultAllGroup();
                echo json_encode($resultados);
                break;

            case 'findById':
                $resultados = $crudGroup->findGroup($_POST['idGroup']);
                echo json_encode($resultados);
                break;

            case 'updateStatus':
                $data = convertClassGroups($_POST['idGroup'], null, null, null, $_POST['statusGroup']);
                $crudGroup->updateStatus($data);
                break;
        }
    } catch (\Throwable $th) {
        echo "este es el error :V " . $th->getMessage();
    }
}

function convertClassGroups($id, $name, $areaGrupo, $categoria, $status)
{
    $datosGroups = new gruposActivos();
    $datosGroups->setId_grupo($id);
    $datosGroups->setNombre_grupos($name);
    $datosGroups->setAreaGrupo($areaGrupo);
    $datosGroups->setCategoria($categoria);
    $datosGroups->setStatus($status);
    return $datosGroups;
}
