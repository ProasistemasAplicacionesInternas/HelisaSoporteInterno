<?php

require_once('../model/datosPeticion.php');
require_once("../model/vinculo.php");

$datos= new Peticion();

        $db=conectar::acceso();
        
        $seleccion=$db->prepare('SELECT usuario FROM usuarios WHERE (id_roles=3) AND uestado = 5 ');
        $seleccion->execute();
        $programadores = [];

        while ($listado=$seleccion->fetch(PDO::FETCH_ASSOC)) {
            $programadores[]=$listado;
        }

?>