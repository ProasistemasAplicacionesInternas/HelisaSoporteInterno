<?php
require_once('../model/dataCategoryAssets.php');
require_once('../model/crudCategoryAssets.php');

$crudCategoryAssets = new CrudCategoryAssets();

if (isset($_POST['actionsCategoryAssets'])) {
    switch ($_POST['actionsCategoryAssets']) {
        case 'create':
            if ($crudCategoryAssets->categoryExists($_POST['nameCategory'])) {
                echo json_encode(['error' => 'Ya existe una categoría con este nombre']);
            } else {
                $data = convertClassCategoryAssets(null, $_POST['nameCategory'], $_POST['areaCategory'], 5);
                $crudCategoryAssets->createCategory($data);
            }
            break;

        case 'update':
            if ($crudCategoryAssets->categoryExists($_POST['nameCategory'])) {
                echo json_encode(['error' => 'Ya existe una categoría con este nombre']);
            } else {
            $data = convertClassCategoryAssets($_POST['idCategory'], $_POST['nameCategory'], $_POST['areaCategory'], null);
            $crudCategoryAssets->editCategory($data);
            }
            break;
        case 'consultAll':

            $resultados = $crudCategoryAssets->consultAllCategory();
            echo json_encode($resultados);
            break;

        case 'consultAll1':

            $resultados = $crudCategoryAssets->consultAllCategory1();
            echo json_encode($resultados);
            break;    

        case 'findById':
            $resultados = $crudCategoryAssets->findCategory($_POST['idCategory']);
            echo json_encode($resultados);
            break;

        case 'updateStatus':
            $data = convertClassCategoryAssets($_POST['idCategory'], null, null, $_POST['status']);
            $crudCategoryAssets->updateStatus($data);
            break;
    }
}

function convertClassCategoryAssets($id, $name, $area, $state)
{
    $datacategory = new DataCategoryAssets();
    $datacategory->setId($id);
    $datacategory->setNameCategory($name);
    $datacategory->setAreaCategory($area);
    $datacategory->setStatus($state);
    return $datacategory;
}