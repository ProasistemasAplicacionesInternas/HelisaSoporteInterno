var fechaF = document.getElementById('selectorFecha');
var ticketF = document.getElementById('selectorTicket');
var ticketT = document.getElementById('selectorTodos');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#criterio').on('change', function() {
    if (this.value == '' || this.value == undefined) {
        fechaF.style.display = 'none';
        ticketF.style.display = 'none';
        ticketT.style.display = 'none';
    } else if (this.value == 1) {
        fechaF.style.display = 'inline'
        ticketF.style.display = 'none';
        ticketT.style.display = 'none';
    }else if(this.value == 2){
        ticketT.style.display = 'inline';
        fechaF.style.display = 'none'
        ticketF.style.display = 'none';
    }else if (this.value == 3) {
        ticketF.style.display = 'inline';
        fechaF.style.display = 'none';
        ticketT.style.display = 'none';
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
        "startDate": "01/01/2022",
        "endDate": "31/03/2022",
        "opens": "rigth"
    }, function rango(start, end) {
        var inicio = start.format('DD-MM-YYYY');
        var final = end.format('DD-MM-YYYY');
        document.getElementById('fechaInicial').value = inicio;
        document.getElementById('fechaFinal').value = final;
        console.log(document.getElementById('fechaInicial').value = inicio);
    });
});