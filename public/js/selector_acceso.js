$(document).ready(function() {
    $(document).on('click', '.detalleAcceso', function() {
        let id = $(this).val();
        let tipo = $('#tipo_accesosA' + id).text();
        let codigo = $('#codigos' + id).text();
        let nombre = $('#nombreUsuario' + id).text();
        let clave = $('#claves' + id).text();
        let estado = $('#estadosA' + id).text();
        let fecha = $('#fechas' + id).text();
        $('#detalleAcceso').modal('show');
        $('#tipo_accesos').val(tipo);
        $('#codigos').val(codigo);
        $('#nombreUsuario').val(nombre);
        $('#claves').val(clave);
        $('#estadoA').val(estado);
        $('#fechas').val(fecha);



    });
});

$('#btn-cambiosAcceso').click(function() {
    if ($('#form-acceso').smkValidate()) {
        var infoAcceso = "codigos=" + $('#codigos').val() +
            '&nombreUsuario=' + encodeURIComponent($('#nombreUsuario').val()) +
            '&claves=' + encodeURIComponent($('#claves').val()) +
            '&fechas=' + $('#fechas').val() +
            '&tipo_accesos=' + $('#tipo_accesos').val() +
            '&estadoA=' + $('#estadoA').val() +
            '&modificaAcceso=1';

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