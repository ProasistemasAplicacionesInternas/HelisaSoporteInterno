<?php 
    require_once("../model/crud_centro_de_costos.php");
    $centroCostos = new centroCostos();
 
    if(isset($_POST['crearCentroCostos'])){
        $resultado=$centroCostos->crearCentroCostos($_POST['descripcion'],$_POST['codigo']);
        echo $resultado;   
    }else if(isset($_POST['consultarCentroCostosxID'])){
        $resultado = $centroCostos->getCodigoCentro($_POST['consultarCentroCostosxID']);
        if(isset($_POST['consultarcodigo'])){
            foreach($resultado AS $centros){
                $codigo = $centros['codigo'];
            }
            echo $codigo;
        }
    }else{
        $centroDeCostos = $centroCostos->getcentroCostos();
    }
        
    
?>