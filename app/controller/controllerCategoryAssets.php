<?php
require_once('../model/dataCategoryAssets.php');
require_once('../model/crudCategoryAssets.php');

$crudCategoryAssets = new CrudCategoryAssets();

if (isset($_POST['actionsCategoryAssets'])) {
    switch ($_POST['actionsCategoryAssets']) {
        case 'create':
            $data = convertClassCategoryAssets(null, $_POST['nameCategory'], $_POST['areaCategory']);
            $crudCategoryAssets->createCategory($data);
            break;

        case 'update':
            $data = convertClassCategoryAssets($_POST['idCategory'], $_POST['nameCategory'], $_POST['areaCategory']);
            $crudCategoryAssets->editCategory($data);
            break;

        case 'consultAll':
            
            $resultados = $crudCategoryAssets->consultAllCategory();
            echo json_encode($resultados);
            break;
        
        case 'findById':
            $resultados = $crudCategoryAssets->findCategory($_POST['idCategory']);
            echo json_encode($resultados);
            break;
    }
}

function convertClassCategoryAssets($id, $name, $area)
{
    $datacategory = new DataCategoryAssets();
    $datacategory->setId($id);
    $datacategory->setNameCategory($name);
    $datacategory->setAreaCategory($area);
    return $datacategory;
}