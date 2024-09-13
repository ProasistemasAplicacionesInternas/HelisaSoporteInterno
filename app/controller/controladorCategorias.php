<?php
    
    require_once("../model/categoriasTecnologia.php");

    $categoria = new Categoria();
    $listadoCategorias = $categoria->getCategoria();
  
?>