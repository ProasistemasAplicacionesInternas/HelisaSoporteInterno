<?php 

  require_once('../model/datos_servidor.php'); 
  $consultar= new DatosServidor();

  if(isset($_POST['generar'])){
    $arregloservidores = $consultar->consultaMaquinasActivas();
    return $arregloservidores;
}
?>