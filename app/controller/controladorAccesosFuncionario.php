<?php
require('../model/consultaAccesosFuncionario.php');
//require('../model/datos_peticionesAccesos.php');
$crud = new consultaAccesosFuncionario();
//$datos = new datosPeticionAccesos();
$consultarDocumentos = $crud->traerDocumento($_POST['usuario_creacion']);
$consultarPlataformasActivas = $crud->plataformasActivasxUsuario($consultarDocumentos);
?>