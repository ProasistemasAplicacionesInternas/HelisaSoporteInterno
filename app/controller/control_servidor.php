<?php 

    require_once('../model/crud_servidor.php');
    require_once('../model/datos_servidor.php');

    $crear = new DatosServidor();
    $servidor= new Servidor();

    if (isset($_POST['guardar'])) {
    //echo 'HJJH';

        $servidor->setSerial_servidor($_POST['serial_servidor']);
        $servidor->setActivo_fijo($_POST['activo_fijo']);
        $servidor->setMarca_servidor($_POST['marca_servidor']);
        //$servidor->setFisico_servidor($_POST['fisico_servidor']);
        $servidor->setNombre_servidor($_POST['nombre_servidor']);
        $servidor->setUbicacion_servidor($_POST['ubicacion_servidor']);
        $servidor->setIP_servidor($_POST['IP_servidor']);
        $servidor->setIP_publica($_POST['IP_publica']);
        $servidor->setPuerto_servidor($_POST['puerto_servidor']);
        $servidor->setFecha_compra_servidor($_POST['fecha_compra_servidor']);
        $servidor->setMemoria_servidor($_POST['memoria_servidor']);
        $servidor->setDisco_servidor($_POST['disco_servidor']);
        $servidor->setProcesador_servidor($_POST['procesador_servidor']);
        $servidor->setDominio_servidor($_POST['dominio_servidor']);
        $servidor->setResponsable_servidor($_POST['responsable_servidor']);
        $servidor->setUsuarioAdministrador($_POST['usuarioAdministrador']);
        $servidor->setUsuarioEstandar($_POST['usuarioEstandar']);
        $servidor->setSistema_operativo($_POST['sistema_operativo']);
        $servidor->setProgramas_instalados($_POST['programas_instalados']);
        $servidor->setUso($_POST['uso']);
        $servidor->setTiempo_uso($_POST['tiempo_uso']);
        $servidor->setBackup($_POST['backup']);
        $servidor->setFrecuencia_backup($_POST['frecuencia_backup']);
        //$servidor->setPersona_genera($_POST['persona_genera']);
        $servidor->setPersona_entrega($_POST['persona_entrega']);
        $servidor->setCargo_entrega($_POST['cargo_entrega']);
        $servidor->setFecha_entrega($_POST['fecha_entrega']);
        $servidor->setPersona_recibe($_POST['persona_recibe']);
        $servidor->setCargo_recibe($_POST['cargo_recibe']);
        $servidor->setFecha_recibe($_POST['fecha_recibe']);
        $servidor->setTipoServidor($_POST['tipoServidor']);
        $servidor->setRuta_backup($_POST['ruta_backup']);
        $servidor->setNombre($_POST['usu_name']);   
        $crear->insertaServidor($servidor); 

        header('Location: ../../dashboard.php');  
    }

    if (isset($_POST['guardar_cambios'])) {
        $servidor->setSerial_servidor($_POST['serial_servidor']);
        $servidor->setActivo_fijo($_POST['activo_fijo']);
        $servidor->setMarca_servidor($_POST['marca_servidor']);
        //$servidor->setFisico_servidor($_POST['fisico_servidor']);
        $servidor->setNombre_servidor($_POST['nombre_servidor']);
        $servidor->setActivo_fijo($_POST['activo_fijo']);
        $servidor->setIP_servidor($_POST['IP_servidor']);
        $servidor->setIP_publica($_POST['IP_publica']);
        $servidor->setUsuarioAdministrador($_POST['usuarioAdministrador']);
        $servidor->setUsuarioEstandar($_POST['usuarioEstandar']);
        $servidor->setPuerto_servidor($_POST['puerto_servidor']);
        $servidor->setUbicacion_servidor($_POST['ubicacion_servidor']);
        $servidor->setTipoServidor($_POST['tipoServidor']);
        $servidor->setMemoria_servidor($_POST['memoria_servidor']);
        $servidor->setDisco_servidor($_POST['disco_servidor']);
        $servidor->setProcesador_servidor($_POST['procesador_servidor']);
        $servidor->setDominio_servidor($_POST['dominio_servidor']);
        $servidor->setFecha_compra_servidor($_POST['fecha_compra_servidor']);
        $servidor->setResponsable_servidor($_POST['responsable_servidor']);
        $servidor->setSistema_operativo($_POST['sistema_operativo']);
        $servidor->setProgramas_instalados($_POST['programas_instalados']);
        $servidor->setUso($_POST['uso']);
        $servidor->setTiempo_uso($_POST['tiempo_uso']);
        $servidor->setBackup($_POST['backup']);
        $servidor->setFrecuencia_backup($_POST['frecuencia_backup']);
        //$servidor->setPersona_genera($_POST['persona_genera']);
        $servidor->setPersona_entrega($_POST['persona_entrega']);
        $servidor->setCargo_entrega($_POST['cargo_entrega']);
        $servidor->setFecha_entrega($_POST['fecha_entrega']);
        $servidor->setPersona_recibe($_POST['persona_recibe']);
        $servidor->setCargo_recibe($_POST['cargo_recibe']);
        $servidor->setFecha_recibe($_POST['fecha_recibe']);
        $servidor->setRuta_backup($_POST['ruta_backup']);
        $servidor->setNombre($_POST['usu_name']);
        $crear->actualizaServidor($servidor);   

        //header('Location: ../../dashboard.php');  
        echo  "<script type='text/javascript'>window.close();</script>";
    }

    else if(isset($_POST['consultaSerial']) && $_POST['consultaSerial'] == 1){
        $resultado = $crear->consultarSerial($_POST['serial']);
        echo $resultado;
    }


 ?>