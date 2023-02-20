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

        "startDate": "01/04/2022",
        "endDate": "30/04/2022",
        "opens": "rigth"
    }, function rango(start, end) {
        var inicio = start.format('DD-MM-YYYY');
        var final = end.format('DD-MM-YYYY');
        document.getElementById('fechaInicial').value = inicio;
        document.getElementById('fechaFinal').value = final;
        console.log(document.getElementById('fechaInicial').value = inicio);
    });


});