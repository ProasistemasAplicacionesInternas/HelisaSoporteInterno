/************************************************** Boton de modificar Acceso ********************************************/
$(document).on('click', '.detalleAcceso', function() {
    let id = $(this).val();
    let tipo = $('#tipo_accesosA' + id).text();
    let codigo = $('#codigos' + id).text();
    let nombre = $('#nombreUsuario' + id).text();
    let fecha = $('#fechas' + id).text();
    $('#detalleAcceso').modal('show');
    $('#tipo_accesos').val(tipo);
    $('#codigos').val(codigo);
    $('#nombreUsuario').val(nombre);
    $('#fechas').val(fecha);

});

$('#btn-cambiosAcceso').click(function() {
    if ($('#form-acceso').smkValidate()) {
        var infoAcceso = "codigos=" + $('#codigos').val() +
            '&nombreUsuario=' + encodeURIComponent($('#nombreUsuario').val()) +
            '&fechas=' + $('#fechas').val() +           
            '&modificaBoveda=1';

        $.ajax({
            type: 'POST',
            url: '../controller/controlador_funcionarios.php',
            data: infoAcceso
        }).done(function(data) {
            if (data == 1) {
                $('#detalleAcceso').modal('toggle');
                location.reload();
            } else {
                $.smkAlert({
                    text: 'Se presento un problema',
                    type: 'danger'
                });
            }
        });
    }
});
for(let i=0; i<$("#counter").val();i++){
    $('#boton_eliminar'+i).click(function() {
    
        var infoAcceso = "codigos=" + $(this).val() +
            '&eliminarBoveda=1';
    
        $.ajax({
            type: 'POST',
            url: '../controller/controlador_funcionarios.php',
            data: infoAcceso
        }).done(function(data) {
            if (data == 1) {
                location.reload();
            } else {
                $.smkAlert({
                    text: 'Se presento un problema',
                    type: 'danger'
                });
            }
        });
    });
}

/************************************************** Boton o imagen de ver clave ********************************************/

$(document).on('click', '.claveInicial', function() {

    //<?= $crud->getClave();?>
    let id = $(this).val();
    $('#claveInicial').modal('show');
    $('#idacceso').val(id);
    
});
/***************************************Botones para Cancelar y limpiar modales ************************************************** */

$('#btn-cancelarVerificacion').click(function(){
    var clear = "";
    $('#claveBoveda').val(clear);
})

$('#btn-cancelarVerificacion1').click(function(){
    var clear = "";
    $('#claveBoveda').val(clear);
})


/****************************************** Para Visualizar la Clave ************************************************************/



$('#btn-verificarClave').click(function() {
    let id = $(this).val();
    var variableID = $('#idacceso').val();
    var infoBoveda = "clave=" + $('#claveBoveda').val() + '&verificarBoveda=1';
    var clear = "";
    $.ajax({
        type: 'POST',
        url: '../controller/controlador_funcionarios.php',
        data: infoBoveda
    }).done(function(data) {
        var responseValue = "id="+ $('#idacceso').val() + '&getPassword=1';
        $('#claveBoveda').val(clear);
        if (data == 1) {
            $.ajax({
                type: 'POST',
                url: '../controller/controlador_funcionarios.php',
                data: responseValue
            }).done(function(pass){
                $('#clavesBoveda').val(pass);
            });
            $('#claveInicial').appendTo("body").modal('hide');
            $('#claveAcceso').modal('show');
            
            $('#codigosX').val(variableID);
        } else {
            $.smkAlert({
                text: 'Se presento un problema al consultar',
                type: 'danger'
            });
        }
    });
});


$('#btn-cambiarClave').click(function() {
    var infoBoveda = "clavesBoveda=" + $('#clavesBoveda').val() +
        "&codigos=" + $('#codigosX').val() +
        '&modificarClaveBoveda=1';
    $.ajax({
        type: 'POST',
        url: '../controller/controlador_funcionarios.php',
        data: infoBoveda
    }).done(function(data) {
        if (data == 1) {
            $('#claveAcceso').modal('toggle');
            location.reload()

        } else {
            $.smkAlert({
                text: 'Se presento un problema',
                type: 'danger'
            });
        }
    });
});

$('#btn-cerrarModal').click(function() {
    $('#claveAcceso').appendTo("body").modal('hide');
    $('.modal-backdrop').css("display", "none");
});

//$(document).ready(function() {
//    $('#clavePrimera').modal('show');
//    $('#claveBovedaModal').modal('show');
//});


$('#btn-insertarClave').click(function() {
    let claveBoveda = $('#claveBoveda').val();
    let claveBovedaSegundo = $('#claveBovedaSegundo').val();
    if (claveBoveda == claveBovedaSegundo) {
        var infoBoveda = "claveBoveda=" + claveBoveda +
            '&claveInicialBoveda=1';

        $.ajax({
            type: 'POST',
            url: '../controller/controlador_funcionarios.php',
            data: infoBoveda
        }).done(function(data) {
            if (data == 1) {
                location.reload()

            } else {
                $.smkAlert({
                    text: 'Se presento un problema',
                    type: 'danger'
                });
            }
        });
    } else {
        $.smkAlert({
            text: 'Las claves no coinciden',
            type: 'warning'
        });
    }

});

$('#btn-claveBoveda').click(function() {
        var validar = new FormData();
        validar.append('clave',$('#claveBovedaPrimero').val());
        validar.append('verificarBoveda','1');
    $.ajax({
        type: 'POST',
        url: 'app/controller/controlador_funcionarios.php',
        data: validar,
        processData: false,
        contentType: false,
    }).done(function(data) {
        if (data == 1) {
            $('#claveBovedaModal').modal('toggle');
            /* location.href ="app/view/boveda.php"; */
            $('#submitBovedaModal').click();
        } else {
            document.getElementById('message').style.display = "block";
            console.log("esta mal la contrasena");
        }
    });
});

$('#btn-cancelarBoveda').click(function() {
    location.reload();
});