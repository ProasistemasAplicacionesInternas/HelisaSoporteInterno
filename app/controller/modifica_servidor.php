<?php

    require_once("../model/crud_servidor.php");
    require_once("../model/datos_servidor.php");

    $detalleServidor= new DatosServidor();
    $modifica= new Servidor();

    if (isset($_POST['modificar'])) {
    
        $datosServidor=$detalleServidor->detalles();

        /*********************** JOHANA WAS HERE 31-07-19 ***********************/

        $codigoServidor=$datosServidor['codigoServidor'];
        $serial_servidor=$datosServidor['serial_servidor'];
        $activo_fijo=$datosServidor['activo_fijo'];
        $marca_servidor=$datosServidor['marca_servidor'];
        $fisico_servidor=$datosServidor['fisico_servidor'];
        $nombre_servidor=$datosServidor['nombre_servidor'];
        $ubicacion_servidor=$datosServidor['ubicacion_servidor'];
        $IP_servidor=$datosServidor['IP_servidor'];
        $IP_publica=$datosServidor['IP_publica'];
        $puerto_servidor=$datosServidor['puerto_servidor'];
        $fecha_compra_servidor=$datosServidor['fecha_compra_servidor'];
        $memoria_servidor=$datosServidor['memoria_servidor'];
        $disco_servidor=$datosServidor['disco_servidor'];
        $procesador_servidor=$datosServidor['procesador_servidor'];
        $dominio_servidor=$datosServidor['dominio_servidor'];
        $responsable_servidor=$datosServidor['responsable_servidor'];
        $usuarioAdministrador=$datosServidor['usuario_administrador'];
        $usuarioEstandar=$datosServidor['usuario_estandar'];
        $sistema_operativo=$datosServidor['sistema_operativo'];
        $programas_instalados=$datosServidor['programas_instalados'];
        $uso=$datosServidor['uso'];
        $tiempo_uso=$datosServidor['tiempo_uso'];
        $backup=$datosServidor['backup'];
        $frecuencia_backup=$datosServidor['frecuencia_backup'];
        $persona_genera=$datosServidor['persona_genera'];
        $persona_entrega=$datosServidor['persona_entrega'];
        $cargo_entrega=$datosServidor['cargo_entrega'];
        $fecha_entrega=$datosServidor['fecha_entrega'];
        $persona_recibe=$datosServidor['persona_recibe'];
        $cargo_recibe=$datosServidor['cargo_recibe'];
        $fecha_recibe=$datosServidor['fecha_recibe'];
        $tipoServidor=$datosServidor['tipoServidor'];
        $ruta_backup=$datosServidor['ruta_backup'];
        
        /*********************** JOHANA WAS HERE 31-07-19 ***********************/
    }
?>
