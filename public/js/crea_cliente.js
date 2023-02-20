//Crea input para los accesos de manera dinamica

$(document).ready(function () {
    var consecutivo = 0;

    $('#btn-creaAcceso').click(function () {
        if (consecutivo <= 10000) {
            consecutivo = consecutivo + 1;
            var acceso = document.getElementById("acceso");
            var input_acceso = document.createElement("input");
            var contrasena = document.getElementById("contrasena");
            var input_contrasena = document.createElement("input");
            var fecha = document.getElementById("fechaAcceso");
            var input_fecha = document.createElement("input");
            var tipo_acceso = document.getElementById("tipo_acceso");//////**********************************
            var input_tipoAcceso = document.createElement("input");/////**********************************

            input_acceso.type = 'text';
            $(input_acceso).addClass('form-control my-2 info acceso');
            $(input_acceso).attr('required', true);
            $(input_acceso).attr('maxlength','20');
            $(input_acceso).prop('id', 'acceso' + consecutivo);

            input_contrasena.type = 'text';
            $(input_contrasena).addClass('form-control my-2 info acceso');
            $(input_contrasena).attr('required','true');
            $(input_contrasena).attr('maxlength','20');
            $(input_contrasena).prop('id', 'clave' + consecutivo);

            input_fecha.type = 'date';
            $(input_fecha).addClass('form-control my-2 info acceso');
            $(input_fecha).attr('required', true);
            $(input_fecha).prop('id', 'fecha' + consecutivo);

            input_tipoAcceso.type = 'text'; /////**********************************
            $(input_tipoAcceso).addClass('form-control my-2 info acceso');
            $(input_tipoAcceso).attr('required', true);
            $(input_tipoAcceso).attr('maxlength','20');
            $(input_tipoAcceso).prop('id', 'tipo_acceso' + consecutivo);

        }
        acceso.appendChild(input_acceso);
        contrasena.appendChild(input_contrasena);
        fecha.appendChild(input_fecha);
        tipo_acceso.appendChild(input_tipoAcceso); /////**********************************
    });

    
    
//Valida los campos del formulario    
    
    $('#btn-eliminaAcceso').click(function () {
        if (consecutivo != 0) {
            $('#acceso' + consecutivo).remove();
            $('#clave' + consecutivo).remove();
            $('#fecha' + consecutivo).remove();
             $('#tipo_acceso' + consecutivo).remove(); /////**********************************
            consecutivo = consecutivo - 1;
        }
    });

    $('#btn-guardar').click(function () {
        var arrayAcceso = [];
        var numeroInput = document.getElementsByClassName('acceso');
        var numeroAcceso = (numeroInput.length) / 3; 
        $('.acceso').each(function () {
            arrayAcceso.push($(this).attr("id") + "=" + encodeURIComponent($(this).val()));
        });

        if ($('#form-creaCliente').smkValidate()) {
            var infoCliente = arrayAcceso.join("&") +
                '&nit=' + $('#nit').val() +
                '&nombre=' + escape($('#nombre').val()) +
                '&ciudad=' + $('#ciudad').val() +
                '&telefono=' + $('#telefono').val() +
                '&correo=' + $('#correo').val() +
                '&contacto1=' + $('#contacto1').val() +
                '&contacto2=' + $('#contacto2').val() +
                '&niif=' + $('#niif').val() +
                '&nomina=' + $('#nomina').val() +
                '&ph=' + $('#ph').val() +
                '&generador=' + $('#generador').val() + 
                '&mm2016=' + $('#mm2016').val()+
                '&mm2017=' + $('#mm2017').val()+
                '&mm2018=' + $('#mm2018').val()+
                '&mm2019=' + $('#mm2019').val()+
                '&fecha=' + $('#fecha').val() +
                '&servidor=' + $('#servidor').val() +
                '&producto=' + $('#producto').val() +
                '&estado=' + $('#estado').val() +
                '&cantidad=' + numeroAcceso +
                '&crear=1';
           console.log(infoCliente);
            $.ajax({
                type: 'POST',
                url: '../controller/control_clientes.php',
                data: infoCliente

            }).done(function (data) {
                if (data == 1) {
                    window.location='../../dashboard.php';
                    
                    $('#form-creaCliente').smkClear();
                } else if (data == 3) {
                    $.smkAlert({
                        text: 'El cliente ya existe. Verifique',
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
