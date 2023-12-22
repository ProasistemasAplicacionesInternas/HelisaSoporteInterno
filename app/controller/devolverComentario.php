<?php
function devolverComentarios($peticionComentario){
    $db=conectar::acceso();
    $areas=[];
    $cadena = "";
    $seleccion=$db->prepare('SELECT comentario FROM comentarios_peticiones  WHERE  id_peticion=:id_peticiones');
    $seleccion->bindValue('id_peticiones',$peticionComentario);
    $seleccion->execute();
    
    while ($listado_areas=$seleccion->fetch(PDO::FETCH_ASSOC)) {
        $areas[]=$listado_areas;
        $cadena .= $listado_areas["comentario"] . ".\n";
    }
    return $cadena;
}
