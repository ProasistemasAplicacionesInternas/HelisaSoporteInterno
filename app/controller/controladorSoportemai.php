<?php
    
    require_once("../model/crudSoportemai.php");
    require_once("../model/datos_soportemai.php");

    $Crudsoporte = new Crudsoporte();
    $datos = new Datostiposoporte();
    
    $listadoSoporte = $Crudsoporte->mostrarTipoSoporte();
  
?>