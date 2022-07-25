$(document).ready(function() {
    $('#peticiones_MAI').click(function() {
        $("#contenido").load("app/view/consultar_peticionesMAI.php");
    });

    $('#peticiones_Infraestructura').click(function() {
        $("#contenido").load("app/view/consultar_peticionesInfraestructura.php");
    });

    $('#liberar_Infraestructura').click(function() {
        $("#contenido").load("app/view/liberar_soportesInfraestructura.php");
    });

    $('#liberar_MAI').click(function() {
        $("#contenido").load("app/view/liberar_soportesMAI.php");
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
});