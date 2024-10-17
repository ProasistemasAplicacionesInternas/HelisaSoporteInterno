<?php
    
    require_once("../model/crudSoporteMai.php");
    require_once("../model/datosSoporteMai.php");

    $Crudsoporte = new Crudsoporte();
    $datos = new Datostiposoporte();
    
    $listadoSoporte = $Crudsoporte->mostrarTipoSoporte();
  
?>