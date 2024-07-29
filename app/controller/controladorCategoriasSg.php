<?php

require_once("../model/categoriasSeguridad.php");

$categoriaSg = new categoriaSg();
$listadoCategorias = $categoriaSg->getcategoriaSg();


?>