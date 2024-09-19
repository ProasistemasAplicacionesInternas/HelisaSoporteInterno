<?php
    
    require_once("../model/crudProductosMai.php");

    $Crudproductos = new Crudproductos();
    $listadoProductos = $Crudproductos->mostrarProductos();
  
?>