//Crea input para los accesos de manera dinamica

$(document).ready(function () {
    var consecutivo = 0;

    $('#btn-creaUsuario').click(function () {
        if (consecutivo <= 10000) {
            consecutivo = consecutivo + 1;
            var usuario = document.getElementById("usuario");
            var input_usuario = document.createElement("input");
            var tipoUsuario = document.getElementById("tipoUsuario");
            var input_tipoUsuario = document.createElement("input");/////**********************************

            input_usuario.type = 'text';
            $(input_usuario).addClass('form-control my-2 info acceso');
            $(input_usuario).attr('required', true);
            $(input_usuario).attr('maxlength','20');
            $(input_usuario).prop('id', 'usuario' + consecutivo);

            input_tipoUsuario.type = 'text';
            $(input_tipoUsuario).addClass('form-control my-2 info acceso');
            $(input_tipoUsuario).attr('required','true');
            $(input_tipoUsuario).attr('maxlength','20');
            $(input_tipoUsuario).prop('id', 'tipoUsuario' + consecutivo);

        }
        usuario.appendChild(input_usuario);
        tipoUsuario.appendChild(input_tipoUsuario); /////**********************************
    });

    
    
//Valida los campos del formulario    
    
    $('#btn-eliminaUsuario').click(function () {
        if (consecutivo != 0) {
            $('#usuario' + consecutivo).remove();
            $('#tipoUsuario' + consecutivo).remove(); /////**********************************
            consecutivo = consecutivo - 1;
        }
    });

    $('#btn-guardar').click(function () {
        var arrayAcceso = [];
        var numeroInput = document.getElementsByClassName('acceso');
        var numeroUsuario = (numeroInput.length) / 3; 
        $('.acceso').each(function () {
            arrayAcceso.push($(this).attr("id") + "=" + encodeURIComponent($(this).val()));
        });

        if ($('#form-creaServidor').smkValidate()) {
            console.log(arrayAcceso)
            var infoServidor = arrayAcceso.join("&") +
                '&serial_servidor=' + $('#serial_servidor').val() +
                '&activo_fijo=' + $('#activo_fijo').val() +
                '&marca_servidor=' + $('#marca_servidor').val() +
                '&fisico_servidor=' + $('#fisico_servidor').val() +
                '&nombre_servidor=' + $('#nombre_servidor').val() +
                '&ubicacion_servidor=' + $('#ubicacion_servidor').val() +
                '&IP_servidor=' + $('#IP_servidor').val() +
                '&IP_publica=' + $('#IP_publica').val() +
                '&puerto_servidor=' + $('#puerto_servidor').val() +
                '&fecha_compra_servidor=' + $('#fecha_compra_servidor').val()+
                '&memoria_servidor=' + $('#memoria_servidor').val() + 
                '&disco_servidor=' + $('#disco_servidor').val()+
                '&procesador_servidor=' + $('#procesador_servidor').val()+
                '&dominio_servidor=' + $('#dominio_servidor').val()+
                '&responsable_servidor=' + $('#responsable_servidor').val()+
                '&usuarioAdministrador=' + $('#usuarioAdministrador').val()+
                '&usuarioEstandar=' + $('#usuarioEstandar').val()+
                '&sistema_operativo=' + $('#sistema_operativo').val() +
                '&programas_instalados=' + $('#programas_instalados').val() +
                '&uso=' + $('#uso').val() +
                '&tiempo_uso=' + $('#tiempo_uso').val() +
                '&backup=' + $('#backup').val() +
                '&frecuencia_backup=' + $('#frecuencia_backup').val() +
                '&persona_genera=' + $('#persona_genera').val() +
                '&persona_entrega=' + $('#persona_entrega').val() +
                '&cargo_entrega=' + $('#cargo_entrega').val() +
                '&fecha_entrega=' + $('#fecha_entrega').val() +
                '&persona_recibe=' + $('#persona_recibe').val() +
                '&cargo_recibe=' + $('#cargo_recibe').val() +
                '&fecha_recibe=' + $('#fecha_recibe').val() +
                '&tipoServidor=' + $('#tipoServidor').val() +
                '&cantidad=' + numeroUsuario +
                '&crear=1';
           console.log(infoServidor);
            $.ajax({
                type: 'POST',
                url: '../controller/control_servidor.php',
                data: infoServidor

            }).done(function (data) {
                if (data == 1) {
                    window.location='../../dashboard.php';
                    
                    $('#form-creaServidor').smkClear();
                } else if (data == 3) {
                    $.smkAlert({
                        text: 'El servidor ya existe. Verifique',
                        type: 'warning'
                    });
                } else {
                    $.smkAlert({
                        text: 'Se presento un problema intente de nuevo',
                        type: 'danger'
                    });
                }

            });
        }
    });




});
