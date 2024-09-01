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
    }else if(isset($_POST['consultarCentroCostosModifica'])){
        $resultado = $centroCostos->getCodigoCentro($_POST['consultarCentroCostosModifica']);
        if(isset($_POST['consultarcodigo'])){
            $codigo = '';
            $otroValor = ''; 
            foreach($resultado as $centros){
                $codigo = $centros['codigo'];
                $otroValor = $centros['id_centroCostos']; 
                
            }
            echo json_encode(['codigo' => $codigo, 'otroValor' => $otroValor]);
        }
    }else if(isset($_POST['consultarCentroCostosMod'])){
    try{
        $resultado = $centroCostos->getCodigoCentroCosto($_POST['consultarCentroCostosMod']);
        if(isset($_POST['consultarcodigo'])){
            $codigo = '';
            $otroValor = ''; 
            $desc = ''; 
            foreach($resultado as $centros){
                $codigo = $centros['codigo'];
                $otroValor = $centros['id_centroCostos']; 
                $desc = $centros['descripcion']; 
            }
            echo json_encode(['codigo' => $codigo, 'otroValor' => $otroValor, 'desc' => $desc]);
        }
    } catch (Exception $e) {
        // Manejo de excepciones, puedes registrar el error o mostrar un mensaje al usuario
        echo "Error en consultaCompleta: " . $e->getMessage();
        return []; // Retorna un arreglo vacío en caso de error
    }
    }else{
        $centroDeCostos = $centroCostos->getcentroCostos();
    }
        
    
?>