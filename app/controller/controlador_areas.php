<?php
    
    require_once("../model/datos_areas.php");
    require_once("../model/crud_areas.php");

    $area = new Crudareas();
    
    if(isset($_POST['modificarArea'])){
        $resultado = $area->modificarArea($_POST['id_area'],$_POST['descripcion'],$_POST['estado'],$_POST['departamento']);
        echo $resultado;
    }elseif(isset($_POST['crearArea'])){
        $resultado = $area->crearArea($_POST['descripcion'],$_POST['departamento']);
        echo $resultado;
    }elseif(isset($_POST['consultarArea'])){
        $resultado= $area->getAreasxID($_POST['consultarArea']);
        
        if(isset($_POST['consultarPersonas'])){
            foreach($resultado AS $areas){
                $personasxArea = $areas['personasxArea'];
            }
            echo $personasxArea;
        }elseif(isset($_POST['consultarEstadoArea'])){
            foreach($resultado AS $areas){
                $estado_area = $areas['estado'];
            }
            echo $estado_area;
        }elseif(isset($_POST['consultarEstadoDepartamento'])){
            foreach($resultado AS $areas){
                $estado_departamento = $areas['estado_departamento'];
            }
            echo $estado_departamento;
        }
    }else{      
        $listado_areasB=$area->mostrarAreas();
        
        if(session_status() == 0 || session_status() == 1){
            session_start();
        }

        if(isset($_SESSION['redireccionamiento'])){
            $auxiliar = $_SESSION['redireccionamiento'];
            $_SESSION['redireccionamiento'] = null;
            $listado_areas = $area->getAreasxDepartamento($auxiliar);
        }else{
            $listado_areas = $area->getAreas();
        }
        
    }
  
?>