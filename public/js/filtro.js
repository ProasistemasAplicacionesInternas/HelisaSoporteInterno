var fechaF = document.getElementById('selectorFecha');
var ticketF = document.getElementById('selectorTicket');
var programador = document.getElementById('selectorProgramador');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#criterio').on('change', function() {
    if (this.value == '' || this.value == undefined) {
        fechaF.style.display = 'none';
        ticketF.style.display = 'none';
        programador.style.display = 'none';
    } else if (this.value == 1) {
        fechaF.style.display = 'inline'
        ticketF.style.display = 'none';
        programador.style.display = 'none';
    } else if (this.value == 3) {
        ticketF.style.display = 'inline';
        fechaF.style.display = 'none';
        programador.style.display = 'none';
    } else if(this.value == 4){
        ticketF.style.display = 'none';
        programador.style.display = 'inline';
    }
});



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

        "startDate": "01/03/2022",
        "endDate": "30/03/2022",
        "opens": "rigth"
    }, function rango(start, end) {
        var inicio = start.format('DD-MM-YYYY');
        var final = end.format('DD-MM-YYYY');
        document.getElementById('fechaInicial').value = inicio;
        document.getElementById('fechaFinal').value = final;
        console.log(document.getElementById('fechaInicial').value = inicio);
    });


});


$('#area').on('change', function() {
    if (this.value == '' || this.value == undefined) {
        $('#criterio-div').css('display','none');
        $('#criterio').css('display','none');
        $('#criterio').val('');
        $('#areaF1').val('');
        $('#areaF2').val('');
        $('#areaF3').val('');
    } else{
        $('#criterio-div').css('display','inline');
        $('#criterio').css('display','inline');
        $('#criterio').val('');
        $('#areaF1').val($('#area').val());
        $('#areaF2').val($('#area').val());
        $('#areaF3').val($('#area').val());
    } 
    $('#criterio').trigger('change');
});

$('#area').trigger('change');

