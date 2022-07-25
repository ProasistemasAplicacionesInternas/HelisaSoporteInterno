<?php
    
    require_once("../model/crud_productosmai.php");

    $Crudproductos = new Crudproductos();
    $listado_productos = $Crudproductos->mostrarProductos();
  
?>