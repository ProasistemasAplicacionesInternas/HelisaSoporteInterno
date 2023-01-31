var fechaF = document.getElementById('selectorFecha');
var usuarioF = document.getElementById('selectorUsuario');
var fechaUsuario = document.getElementById('checks');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#criterio').on('change', function() {
    if (this.value == '' || this.value == undefined) {
        fechaF.style.display = 'none';
        usuarioF.style.display = 'none';
        fechaUsuario.style.display = 'none';
    } else if (this.value == 1) {
        fechaF.style.display = 'inline'
        usuarioF.style.display = 'none';
        fechaUsuario.style.display = 'none';

    } else if (this.value == 3) {
        usuarioF.style.display = 'inline';
        fechaF.style.display = 'none';
        fechaUsuario.style.display = 'none';
    }
});

$('#criterio').trigger('change');

$('#todo').on('change', function() {
    fechaUsuario.style.display = 'none';
});

$('#fechaU').on('change', function() {
    fechaUsuario.style.display = 'inline';
});

$('#todo').trigger('change');
$('#fechaU').trigger('change');


$(function() {

    $('#fechaFiltro').daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aceptar",
            "cancelLabel": "Cancelar",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },

        "startDate": "01/01/2022",
        "endDate": "30/01/2022",
        "opens": "rigth"
    }, function rango(start, end) {
        var inicio = start.format('DD-MM-YYYY');
        var final = end.format('DD-MM-YYYY');
        document.getElementById('fechaInicial').value = inicio;
        document.getElementById('fechaFinal').value = final;
        console.log(document.getElementById('fechaInicial').value = inicio);
    });

    $('#fechaUsuario').daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aceptar",
            "cancelLabel": "Cancelar",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },

        "startDate": "01/01/2022",
        "endDate": "30/01/2022",
        "opens": "rigth"
    }, function rango(start, end) {
        var inicio = start.format('DD-MM-YYYY');
        var final = end.format('DD-MM-YYYY');
        document.getElementById('fechaIn').value = inicio;
        document.getElementById('fechaFin').value = final;
        console.log(document.getElementById('fechaIn').value = inicio);
    });


});