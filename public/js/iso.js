var fechaI = document.getElementById('selectorFecha');
var ticketI = document.getElementById('selectorTicket');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#criterio').on('change', function() {
    if (this.value == '' || this.value == undefined) {
        fechaI.style.display = 'none'
        ticketI.style.display = 'none'
    } else if (this.value == 1) {
        fechaI.style.display = 'inline'
        ticketI.style.display = 'none'
    }else if(this.value == 2){
        ticketI.style.display = 'inline'
        fechaI.style.display = 'none'
    }
});

$('#criterio').trigger('change');

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
        "opens": "right"
    }, function rango(start, end) {
        var inicio = start.format('DD-MM-YYYY');
        var final = end.format('DD-MM-YYYY');
        document.getElementById('fechaInicial').value = inicio;
        document.getElementById('fechaFinal').value = final;
        console.log(document.getElementById('fechaInicial').value = inicio);
    });
});