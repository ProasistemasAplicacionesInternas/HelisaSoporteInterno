<?php
    
    require_once("../model/estados.php");

    $estados=new Llama_estados();
    $matriz_estados=$estados->get_estados();
    $matriz_estado=$estados->get_estado();
   
    
?>