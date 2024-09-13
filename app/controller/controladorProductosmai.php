<?php
    
    require_once("../model/crudProductosmai.php");

    $Crudproductos = new Crudproductos();
    $listadoProductos = $Crudproductos->mostrarProductos();
  
?>