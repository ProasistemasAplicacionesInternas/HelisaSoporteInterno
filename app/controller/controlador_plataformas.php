<?php

    require('../model/crud_plataformas.php');

    $plataforma = new plataformas();

    if(isset($_POST['crearPlataforma'])){
        $consulta = $plataforma->crearPlataforma($_POST['descripcion'],$_POST['administrador']);
        echo $consulta;
    }else if(isset($_POST['modificarPlataforma'])){
        $consulta = $plataforma->modificarPlataforma($_POST['id'],$_POST['administrador'],$_POST['estado']);
        echo $consulta;
    }else if(isset($_POST['usuariosPeticiones'])){
        $consulta = $plataforma->usuariosPeticiones($_POST['id']);
        echo $consulta;
    }else if(isset($_POST['usuariosPlataformas'])){
        $consulta = $plataforma->usuariosPlataformas($_POST['id']);
        echo $consulta;
    }else{
        $plataformas = $plataforma->getPlataformas();
    }
