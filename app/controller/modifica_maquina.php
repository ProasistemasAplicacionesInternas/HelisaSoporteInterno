<?php

require_once('../model/crud_maquina.php');
require_once('../model/datos_maquina.php');

$crear= new DatosMaquina();
$modifica= new Maquina();


if (isset($_POST['guardar_cambios'])) {
	$modifica->setIDmaquina($_POST['id_maquina']);
    $modifica->setNombreServidor($_POST['id_servidor']);
    $modifica->setNombre_maquina($_POST['nombre_maquina']);
    $modifica->setUbicacion_maquina($_POST['ubicacion_maquina']);
    $modifica->setTipo_maquina($_POST['tipo_maquina']);
    $modifica->setIP_maquina($_POST['IP_maquina']);
    $modifica->setIP_publica($_POST['IP_publica_maquina']);
    $modifica->setPuerto_maquina($_POST['puerto_maquina']);
    $modifica->setDominio_maquina($_POST['dominio_maquina']);
    $modifica->setFecha_compra_maquina($_POST['fecha_compra_maquina']);
    $modifica->setResponsable_maquina($_POST['responsable_maquina']);
    $modifica->setUsuario_administrador($_POST['usuario_administrador']);
    $modifica->setUsuario_estandar($_POST['usuario_estandar']);
    $modifica->setMemoria_maquina($_POST['memoria_maquina']);
    $modifica->setDisco_maquina($_POST['disco_maquina']);
    $modifica->setProcesador_maquina($_POST['procesador_maquina']);
    $modifica->setSistema_operativo($_POST['sistema_operativo']);
    $modifica->setProgramas_instalados($_POST['programas_instalados']);
    $modifica->setUso($_POST['uso']);
    $modifica->setTiempo_uso($_POST['tiempo_uso']);
    $modifica->setBackup($_POST['backup']);
    $modifica->setRuta_backup($_POST['ruta_backup']);
    $modifica->setFrecuencia_backup($_POST['frecuencia_backup']);
    $modifica->setPersona_genera($_POST['persona_genera']);
    $modifica->setPersona_entrega($_POST['persona_entrega']);
    $modifica->setCargo_entrega($_POST['cargo_entrega']);
    $modifica->setFecha_entrega($_POST['fecha_entrega']);
    $modifica->setPersona_recibe($_POST['persona_recibe']);
    $modifica->setCargo_recibe($_POST['cargo_recibe']);
    $modifica->setFecha_recibe($_POST['fecha_recibe']);
    $modifica->setnombre($_POST['usu_name']);
    
    $crear->actualizar($modifica);
   header('Location: ../../dashboard.php');
    
}

if (isset($_POST['seleccionarMaquina'])) {
    $datosMaquina=$crear->detalleMaquina();
    	$id_maquina                =$datosMaquina['id_maquina'];
    	$nombre_maquina            =$datosMaquina['nombre_maquina'];
    	$id_servidor               =$datosMaquina['id_servidor'];
    	$nombre_servidor           =$datosMaquina['nombre_servidor'];
    	$ubicacion_maquina         =$datosMaquina['ubicacion_maquina'];
    	$ip_maquina                =$datosMaquina['IP_maquina'];
    	$ip_publica_maquina        =$datosMaquina['IP_publica_maquina'];
    	$fechaC_maquina            =$datosMaquina['fecha_compra_maquina'];
    	$puerto_maquina            =$datosMaquina['puerto_maquina'];
    	$tipo_maquina              =$datosMaquina['tipo_maquina'];
    	$memoria_maquina           =$datosMaquina['memoria_maquina'];
    	$disco_maquina             =$datosMaquina['disco_maquina'];
    	$procesador_maquina        =$datosMaquina['procesador_maquina'];
    	$dominio_maquina           =$datosMaquina['dominio_maquina'];
    	$responsable_maquina       =$datosMaquina['responsable_maquina'];
    	$usuarioA_maquina          =$datosMaquina['usuario_administrador'];
    	$usuarioE_maquina          =$datosMaquina['usuario_estandar'];
    	$so_maquina                =$datosMaquina['sistema_operativo'];
    	$programas_maquina         =$datosMaquina['programas_instalados'];
    	$uso_maquina               =$datosMaquina['uso'];
    	$tiempoUso_Maquina         =$datosMaquina['tiempo_uso'];
    	$backup_maquina            =$datosMaquina['backup'];
    	$ruta_maquina              =$datosMaquina['ruta_backup'];
    	$frecuencia_maquina        =$datosMaquina['frecuencia_backup'];
    	$genera_maquina            =$datosMaquina['persona_genera'];
    	$entrega_maquina           =$datosMaquina['persona_entrega'];
    	$cargoE_maquina            =$datosMaquina['cargo_entrega'];
    	$fechaE_maquina            =$datosMaquina['fecha_entrega'];
    	$recibe_maquina            =$datosMaquina['persona_recibe'];
    	$cargoR_maquina            =$datosMaquina['cargo_recibe'];
    	$fechaR_maquina            =$datosMaquina['fecha_recibe'];

}



?>
