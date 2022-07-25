<?php
/*------------------@JOHANA WAS HERE--------------------*/
require_once('../model/crud_maquina.php');
require_once('../model/datos_maquina.php');

$crear= new DatosMaquina();
$maquina= new Maquina();

if (isset($_POST['guardar'])) {

    $maquina->setNombre_maquina($_POST['nombre_maquina']);

    $maquina->setNumeroServidor($_POST['servidor']);

    $maquina->setUbicacion_maquina($_POST['ubicacion_maquina']);

    $maquina->setIP_maquina($_POST['IP_maquina']);

    $maquina->setIP_publica($_POST['IP_publica_maquina']);

    $maquina->setFecha_compra_maquina($_POST['fecha_compra_maquina']);

    $maquina->setPuerto_maquina($_POST['puerto_maquina']);

    $maquina->setTipo_maquina($_POST['tipo_maquina']);

    $maquina->setMemoria_maquina($_POST['memoria_maquina']);

    $maquina->setDisco_maquina($_POST['disco_maquina']);

    $maquina->setProcesador_maquina($_POST['procesador_maquina']);

    $maquina->setDominio_maquina($_POST['dominio_maquina']);

    $maquina->setResponsable_maquina($_POST['responsable_maquina']);

    $maquina->setUsuario_administrador($_POST['usuario_administrador']);

    $maquina->setUsuario_estandar($_POST['usuario_estandar']);

    $maquina->setSistema_operativo($_POST['sistema_operativo']);

    $maquina->setProgramas_instalados($_POST['programas_instalados']);

    $maquina->setUso($_POST['uso']);

    $maquina->setTiempo_uso($_POST['tiempo_uso']);

    $maquina->setBackup($_POST['backup']);

    $maquina->setRuta_backup($_POST['ruta_backup']);

    $maquina->setFrecuencia_backup($_POST['frecuencia_backup']);

    $maquina->setPersona_entrega($_POST['persona_entrega']);

    $maquina->setCargo_entrega($_POST['cargo_entrega']);

    $maquina->setFecha_entrega($_POST['fecha_entrega']);

    $maquina->setPersona_recibe($_POST['persona_recibe']);

    $maquina->setCargo_recibe($_POST['cargo_recibe']);

    $maquina->setFecha_recibe($_POST['fecha_recibe']);

    $maquina->setnombre($_POST['usu_name']);
    
    $crear->insertaMaquina($maquina);

    header('Location: ../../dashboard.php');
    
}


/*if (isset($_POST['guardar'])) {

    echo $_POST['servidor'];
    //$maquina->setIDmaquina($_POST['id_maquina']);
    $maquina->setNombre_maquina($_POST['nombre_maquina']);
    $maquina->setNumeroServidor($_POST['servidor']);
    $maquina->setUbicacion_maquina($_POST['ubicacion_maquina']);
    $maquina->setIP_maquina($_POST['IP_maquina']);
    $maquina->setIP_publica($_POST['IP_publica_maquina']);
    $maquina->setFecha_compra_maquina($_POST['fecha_compra_maquina']);
    $maquina->setTipo_maquina($_POST['tipo_maquina']);
    $maquina->setPuerto_maquina($_POST['puerto_maquina']);
    $maquina->setDominio_maquina($_POST['dominio_maquina']);
    $maquina->setResponsable_maquina($_POST['responsable_maquina']);
    $maquina->setUsuario_administrador($_POST['usuario_administrador']);
    $maquina->setUsuario_estandar($_POST['usuario_estandar']);
    $maquina->setMemoria_maquina($_POST['memoria_maquina']);
    $maquina->setDisco_maquina($_POST['disco_maquina']);
    $maquina->setProcesador_maquina($_POST['procesador_maquina']);
    $maquina->setSistema_operativo($_POST['sistema_operativo']);
    $maquina->setProgramas_instalados($_POST['programas_instalados']);
    $maquina->setUso($_POST['uso']);
    $maquina->setTiempo_uso($_POST['tiempo_uso']);
    $maquina->setBackup($_POST['backup']);
    $maquina->setRuta_backup($_POST['ruta_backup']);
    $maquina->setFrecuencia_backup($_POST['frecuencia_backup']);
    $maquina->setPersona_genera($_POST['persona_genera']);
    $maquina->setPersona_entrega($_POST['persona_entrega']);
    $maquina->setCargo_entrega($_POST['cargo_entrega']);
    $maquina->setFecha_entrega($_POST['fecha_entrega']);
    $maquina->setPersona_recibe($_POST['persona_recibe']);
    $maquina->setCargo_recibe($_POST['cargo_recibe']);
    $maquina->setFecha_recibe($_POST['fecha_recibe']);
    
    $crear->insertaMaquina($maquina);
    header('Location: ../../dashboard.php');
    
}*/

if (isset($_POST['crearMaquina'])) {
    
    //$maquina->setIDmaquina($_POST['id_maquina']);
    $maquina->setDescripcion($_POST['descripcion']);
    $maquina->setDireccion($_POST['direccion']);
    $maquina->setNombreServidor($_POST['codigoServidor']);
    
    $crear->insertaMaquina($maquina);
    header('Location: ../../dashboard.php');
    
}
/*------------------@JOHANA WAS HERE--------------------*/
?>