<?php
require ("../model/datosVersion.php");
require ("../model/consultaVersion.php");

$datosVersion = new datosVersion();
$crudVersion = new crudVersion();


if(isset($_POST['version']) && isset($_POST['version'])==1){
    $consulta = $crudVersion->consultaVersion();
    echo $consulta;
}

?>