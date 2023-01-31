$(document).ready(function(){
    /*****************************************************/
    /********** Valida si el funcionario es director *****/
    /*****************************************************/
    var usuario = $('#usuario').text();
    var data = 'consultaPermisosDirector=1&usuario='+usuario;
    $.ajax({
        type:'POST',
        url:'app/controller/control_permisos.php',
        data:data
    }).done(function(respuesta){ 
        if(respuesta > 0){
            $('#notificacionDirectores').removeAttr('hidden');
            notifiacionDirector();
        }
    })
    var data2 = 'consultaPermisoAdministrador=1&usuario='+usuario;
    $.ajax({
        type:'POST',
        url:'app/controller/control_permisos.php',
        data:data2
    }).done(function(respuesta){ 
        if(respuesta > 0){
            $('#notificacionAdministradores').removeAttr('hidden');
            notifiacionAdministrador();
        }
    })
})


function notifiacionDirector(){
    var usuario = $('#usuario').text();
    var data = 'consultaNrPeticionesDelegadas=1&usuario='+usuario;
    $.ajax({
        type:'POST',
        url:'app/controller/controlador_peticionesAccesos.php',
        data:data
    }).done(function(respuesta){ 
        var arreglo = respuesta.split(',');
        $('#D1').text(arreglo[0]);
        $('#D2').text(arreglo[1]);
        $('#D3').text(arreglo[2]);
        $('#D4').text(parseInt(arreglo[0]) + parseInt(arreglo[1]) + parseInt(arreglo[2]));
    })
}

function notifiacionAdministrador(){
    var usuario = $('#usuario').text();
    var data = 'consultaNrPeticionesSoporte=1&usuario='+usuario;
    $.ajax({
        type:'POST',
        url:'app/controller/controlador_peticionesAccesos.php',
        data:data
    }).done(function(respuesta){ 
        var arreglo = respuesta.split(',');
        $('#S1').text(arreglo[0]);
        $('#S2').text(arreglo[1]);
        $('#S3').text(arreglo[2]);
        $('#S4').text(parseInt(arreglo[0]) + parseInt(arreglo[1]) + parseInt(arreglo[2]));
    })
}