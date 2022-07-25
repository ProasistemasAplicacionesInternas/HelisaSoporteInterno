<?php
    
    require_once("../model/crud_tipo_accesos.php");

    $accesos = new Crudaccesos();
    $listado_accesos=$accesos->mostrarAccesos();
  
?>