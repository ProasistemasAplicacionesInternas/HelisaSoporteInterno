<?php
    
    require_once("../model/categorias_tecnologia.php");

    $categoria = new Categoria();
    $listado_categorias = $categoria->getCategoria();
  
?>