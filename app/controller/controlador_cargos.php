<?php
    
    require_once("../model/datos_cargos.php");
    require_once("../model/crud_cargos.php");

    $cargo = new Crudcargos();
    
    if(isset($_POST['modificarCargo'])){
        $resultado = $cargo->modificarCargo($_POST['id_cargo'],$_POST['descripcion'],$_POST['estado'],$_POST['area'],$_POST['auxiliarDp'],$_POST['plataformas']);
        echo $resultado;
    }elseif(isset($_POST['crearCargos'])){
        $resultado = $cargo->crearCargo($_POST['descripcion'],$_POST['area']);
        echo $resultado;
    }elseif(isset($_POST['consultarCargo'])){
        $resultado = $cargo->getCargoxID($_POST['consultarCargo']);
        if(isset($_POST['consultarPersonas'])){
            foreach($resultado AS $cargos){
                $personasxCargo = $cargos['personasxCargo'];
            }
            echo $personasxCargo;
        }elseif(isset($_POST['consultarIDdepartamentoxCargo'])){
            foreach($resultado AS $cargos){
                $id_departamentoxCargo = $cargos['id_departamento'];
            }
            echo $id_departamentoxCargo;
        }elseif(isset($_POST['consultarIDareaxCargo'])){
            foreach($resultado AS $cargos){
                $id_areaxCargo = $cargos['id_area'];
            }
            echo $id_areaxCargo;
        }elseif(isset($_POST['consultarPlataformasxCargo'])){
            foreach($resultado AS $cargos){
                $plataformas = $cargos['plataformas'];
            }
            echo $plataformas;
        }
    }else{

        if(session_status() == 0 || session_status() == 1){
            session_start();
        }

        if(isset($_SESSION['redireccionamiento'])){
            $auxiliar = $_SESSION['redireccionamiento'];
            $_SESSION['redireccionamiento'] = null;
            $listado_cargos = $cargo->getCargosxArea($auxiliar);
        }else{
            $listado_cargos=$cargo->getCargos();
        }
    }
    
  
?>