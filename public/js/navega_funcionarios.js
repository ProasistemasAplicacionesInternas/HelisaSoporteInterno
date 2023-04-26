$(document).ready(function() {
    $('#generar_solicitud').click(function() {
        $("#contenido").load("app/view/peticion_funcionario.php");
    });
    
    $('#vista_solicitudesmai').click(function() {
        $("#contenido").load("app/view/peticiones_mai.php");
    });

    $('#activos_asignados').click(function() {
        $("#contenido").load("app/view/activos_funcionario.php");
    });

    $('#control_actividades_administracion').click(function() {
        $("#contenido").load("app/view/filtro_control_administrador.php");
    });
    $('#peticiones_funcionario').click(function() {
        $("#contenido").load("app/view/filtro_solicitudesInfraestructura.php");
    });
    $('#peticionesmai_funcionario').click(function() {
        $("#contenido").load("app/view/filtro_solicitudesAplicaciones.php");
    });

    $('#datosFuncionarios').click(function() {
        $("#contenido").load("app/view/datosFuncionarios_accesos.php");
    });

    $('#accesos').click(function() {
        $("#contenido").load("app/view/peticiones_accesos.php");
    });




/*****************************************************/
/************ Validacion de Permisos *****************/
/*****************************************************/

        
    /*****************************************************/
    /********** Valida si el funcionario es director *****/
    /*****************************************************/
    var usuario = $('#usuario').text();
    var data = 'consultaPermisosDirector=1&usuario='+usuario;
    $.ajax({
        type:'POST',
        url:'app/controller/control_permisos.php',
        data:data
    }).done(function(respuesta){ //obtiene el departamento en caso de ser director o auxiliar de director
        if(respuesta > 0){
            $('#datosFuncionarios').removeAttr('hidden');
        }
    })

    /* ************************************************************ */
    /* ************ Validacion de Ingreso boveda ****************** */
    /* *** (Valida si el funcionario tienes peticiones_accesos **** */
    /* ***************** finalizadas sin aceptar) ***************** */
    /* ************************************************************ */
    $('#validationBoveda').click(function(){
        var usuario = $('#usuario').text();
        var data = 'consultaNumPeticionesNoAcep=1&usuario='+usuario;
        $.ajax({
            type:'POST',
            url:'app/controller/control_permisos.php',
            data:data
        }).done(function(respuesta){ //obtiene el departamento en caso de ser director o auxiliar de director
            if(respuesta == 2){
                $('#claveBovedaModal').modal('show');
            }else if (respuesta == 1) {
                $.smkAlert({
					text: 'No puedes ingresar a la boveda ya que tienes asignaciones de activos pendientes',
					type: 'danger'
				});
            }else if (respuesta == 0) {
                $.smkAlert({
					text: 'No puedes ingresar a la boveda ya que tienes Peticiones de Accesos Finaliazadas sin Aceptar',
					type: 'danger'
				});
            }
        })  
    });
    $('#validationTicket').click(function(){
        var usuario = $('#usuario').text();
        var data = 'consultaNumPeticionesNoAcep=1&usuario='+usuario;
        $.ajax({
            type:'POST',
            url:'app/controller/control_permisos.php',
            data:data
        }).done(function(respuesta){ //obtiene el departamento en caso de ser director o auxiliar de director
           if (respuesta == 1) {
                $('#dropTicket').hide();
                $.smkAlert({
					text: 'No puedes ingresar a la boveda ya que tienes asignaciones de activos pendientes',
					type: 'danger'
				});
            }else if (respuesta == 0) {
                $('#dropTicket').hide();
                $.smkAlert({
					text: 'No puedes ingresar a la boveda ya que tienes Peticiones de Accesos Finaliazadas sin Aceptar',
					type: 'danger'
				});
            }
        })  
    });

});

