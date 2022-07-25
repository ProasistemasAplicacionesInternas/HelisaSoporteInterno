<?php
    
    require_once("../model/tipo_servidor.php");

    $tipoServidor=new Llama_tipo_servidor();
    $filas_tipoServidor=$tipoServidor->getTipoServidor();
   
    
?>
