$(document).ready(function() {
    /**** Bloque admin ****/
    $('#solicitudes_internasAdmin').click(function() {
        $("#contenido").load("app/view/solicitudes_internas.php");
    });
    $('#solicitudes_infraestructuraAdmin').click(function() {
        $("#contenido").load("app/view/consultar_peticiones.php");
    });
    
    $('#liberar_maiAdmin').click(function() {
        $("#contenido").load("app/view/liberar_solicitudesmai.php");
    });
    $('#liberarAdmin').click(function() {
        $("#contenido").load("app/view/liberar_soportes.php");
    });
    /**************************************/
    
    $('#solicitudes_internas').click(function() {
        $("#contenido").load("app/view/solicitudes_internas.php");
    });
    
    $('#requerimientos').click(function() {
        $("#contenido").load("app/view/requerimientos.php");
    });
    
    $('#liberar_mai').click(function() {
        $("#contenido").load("app/view/liberar_solicitudesmai.php");
    });
    
    $('#asistencia').click(function() {
        $("#contenido").load("app/view/consultar_peticiones.php");
    });

    $('#liberar').click(function() {
        $("#contenido").load("app/view/liberar_soportes.php");
    });

    $('#consultarPeticiones').click(function() {
        $("#contenido").load("app/view/filtro_consultar.php");
    });

    $('#consultarIso').click(function() {
        $("#contenido").load("app/view/filtro_iso.php");
    });

    $('#comentariosPeticiones').click(function() {
        $("#contenido").load("app/view/filtro_comentar.php");
    });

    $('#funcionarios').click(function() {
        $("#contenido").load("app/view/consulta_funcionarios.php");
    });

    //$('#funcionarios_Inactivos').click(function() {
      //  $("#contenido").load("app/view/funcionarios_inactivos.php");
    //});
    $('#funcionarios_Inactivos').click(function() {
        $("#contenido").load("app/view/funcionarios_inactivos.php?val=2");
    });

    $('#funcionarios_Retirados').click(function() {
        $("#contenido").load("app/view/funcionarios_inactivos.php?val=1");
    });

    $('#servidores').click(function() {
        $("#contenido").load("app/view/servidores.php");
    });

    $('#maquinas').click(function() {
        $("#contenido").load("app/view/maquinas.php");
    });

    $('#activos').click(function() {
        $("#contenido").load("app/view/filtro_activos.php");
    });

    $('#control_actividades').click(function() {
        $("#contenido").load("app/view/filtro_control.php");
    });

    $('#usuarios').click(function() {
        $("#contenido").load("app/view/usuarios.php");
    });

    $('#usuarios_inactivos').click(function() {
        $("#contenido").load("app/view/usuarios_inactivos.php");
    });

    $('#ingresos').click(function() {
        $("#contenido").load("app/view/filtro_ingresos.php");
    });

    $('#ingresos-funcionarios').click(function() {
        $("#contenido").load("app/view/filtro_ingresos_funcionarios.php");
    });

    $('#accesos').click(function() {
        $("#contenido").load("app/view/filtro_accesos.php");
    });

    $('#accesos-funcionarios').click(function() {
        $("#contenido").load("app/view/filtro_accesos_funcionarios.php");
    });

    $('#departamentos').click(function() {
        $("#contenido").load("app/view/organigrama.php");
    });

    $('#areas').click(function() {
        $("#contenido").load("app/view/organigrama_areas.php");
    });

    $('#cargos').click(function() {
        $("#contenido").load("app/view/organigrama_cargos.php");
    });

    $('#centroCostos').click(function() {
        $("#contenido").load("app/view/organigrama_centroCostos.php");
    });

    $('#plataformas').click(function() {
        $("#contenido").load("app/view/plataformas.php");
    });
    $('#gestion_accesos').click(function() {
        $("#contenido").load("app/view/peticiones_accesosDelegados.php");
    });
});