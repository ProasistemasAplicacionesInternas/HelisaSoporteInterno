<?php
    
    require_once("../model/crud_soportemai.php");
    require_once("../model/datos_soportemai.php");

    $Crudsoporte = new Crudsoporte();
    $datos = new Datostiposoporte();
    
    $listado_soporte = $Crudsoporte->mostrartipoSoporte();
  
?>