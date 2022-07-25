<?php 
    require_once("../model/crud_departamentosInternos.php");

    $crudDepartamentosInt = new departamentosInternos();
    
    if(isset($_POST['modificarDespartamentoInt'])){
        $resultado = $crudDepartamentosInt->modificarDepartamento($_POST['id_departamento'],$_POST['descripcion'],$_POST['estado']);
        echo $resultado;
    }elseif(isset($_POST['crearDespartamentoInt'])){
        $resultado = $crudDepartamentosInt->crearDepartamento($_POST['descripcion']);
        echo $resultado;
    }elseif(isset($_POST['consultarDepartamentoxID'])){
        $resultado = $crudDepartamentosInt->getDepartamentoInternoxID($_POST['consultarDepartamentoxID']);

        if(isset($_POST['consultarPersonas'])){
            foreach($resultado AS $departamento){
                $personasxDepartamento = $departamento['personasxDepartamento'];
            }
            echo $personasxDepartamento;
        }elseif(isset($_POST['consultarEstado'])){
            foreach($resultado AS $departamento){
                $estadoDepartamento = $departamento['estado'];
            }
            echo $estadoDepartamento;
        }

    }else{
        $departamentosInternos = $crudDepartamentosInt->getDepartamentosInternos();
    }
        
    
?>