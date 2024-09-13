<?php

require_once('../model/datosPeticion.php');
require_once("../model/vinculo.php");

$datos= new Peticion();

        $db=conectar::acceso();
        
        $seleccion=$db->prepare('SELECT usuario FROM funcionarios');
        $seleccion->execute();
        $funcionarios = [];

        while ($listado=$seleccion->fetch(PDO::FETCH_ASSOC)) {
            $funcionarios[]=$listado;
        }
?>