<?php
    
    require_once("../model/datos_gruposActivos.php");
    require_once("../model/crud_gruposActivos.php");

    $grupo=new crudGrupos();

    $listado_grupos=$grupo->mostrarGrupos();

  
?>