<?php
    require_once('../../app/model/crudPeticionesMai.php');

    $crud = new CrudPeticionesMai();
    
    if(isset($_POST['seleccionar_peticionmai'])){
        $crud->revisionSeleccionar($_POST['seleccionar_peticionmai']);
    }
?>