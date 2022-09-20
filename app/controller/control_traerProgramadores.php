<?php

require_once('../model/datos_peticion.php');
require_once("../model/vinculo.php");

$datos= new Peticion();

        $db=conectar::acceso();
        
        $seleccion=$db->prepare('SELECT usuario FROM usuarios WHERE (id_roles=3 OR id_roles=5) AND uestado = 5 ');
        $seleccion->execute();
        $programadores = [];

        while ($listado=$seleccion->fetch(PDO::FETCH_ASSOC)) {
            $programadores[]=$listado;
        }

?>