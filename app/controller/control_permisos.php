<?php
    /* ****************************************************** */
    /* **** Controlador para la manipulacion de los datos *** */
    /* ***************** De Funcionario ********************* */
    /* ****************************************************** */

    require_once('../model/read_permisos.php');
    $permisos = new permisos();

    if(isset($_POST['consultaPermisosDirector']) && $_POST['consultaPermisosDirector'] == 1 ){
        $consulta = $permisos->consultaPermisosDirector($_POST['usuario']);
        echo $consulta;
    }

    else if(isset($_POST['consultaNumPeticionesNoAcep']) && $_POST['consultaNumPeticionesNoAcep'] == 1 ){
        $consulta = $permisos->consultaPeticionesAccesosNoAcep($_POST['usuario']);
        echo $consulta;
    }

    else if(isset($_POST['consultaPermisoAdministrador']) && $_POST['consultaPermisoAdministrador'] == 1){
        $consulta = $permisos->consultarPermisosAdministrador($_POST['usuario']);
        echo $consulta;
    }





?>