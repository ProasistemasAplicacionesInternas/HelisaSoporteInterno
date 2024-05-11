<?php
require_once('../model/datosUvts.php');
require_once('../model/crudUvts.php');


$crudUvts = new CrudUvts();
if (isset($_POST['actionsUvts'])) {
    switch ($_POST['actionsUvts']) {
        case 'create':
            if (!$crudUvts->existUvtByYear($_POST['yearUvt'])) {
                $data = convertClassUvt($_POST['yearUvt'], $_POST['valueUvt']);
                $crudUvts->insertUvt($data);
            } else {
                echo 3;
            }
            break;

        case 'update':
            $data = convertClassUvt($_POST['yearUvt'], $_POST['valueUvt']);
            $crudUvts->updateUvt($data);
            break;

        case 'consultAll':
            $resultados = $crudUvts->consultAllUvts();
            echo json_encode($resultados);
            break;

        case 'lastYear':
            $resultados = $crudUvts->searchLastYear();
            echo json_encode($resultados);
            break;
    }
}

function convertClassUvt($year, $value)
{
    $datosUvts = new Uvts();
    $datosUvts->setYearUvt($year);
    $datosUvts->setValueUvt($value);
    return $datosUvts;
}