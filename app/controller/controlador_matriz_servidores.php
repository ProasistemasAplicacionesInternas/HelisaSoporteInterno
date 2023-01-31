<?php
    
    require_once("../model/crud_servidor.php");

    $servidores = new DatosServidor();
    $listado_servidores=$servidores->matrizServidores();
  
?>