<?php
    
    define('DOCROOTD', $_SERVER['DOCUMENT_ROOT'].'/infraestructura/docs/');
    date_default_timezone_set('America/Bogota');
    if(isset($_POST['descripcion'])){
        $nameB = $_POST['descripcion'] . date('YmdHis') .'.txt';
        $name = str_replace(" ", "", $nameB);
    }else{
        $name = 'namex'. date('YmdHis') .'.txt';
    }

    $archivo = fopen(DOCROOTD . $name,'w');


    if($archivo == true){
        echo $name;
    }else{
        echo 2;
    }


?>