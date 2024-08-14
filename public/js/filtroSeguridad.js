var fechaI = document.getElementById('selectorCategoriaSg');
var ticketI = document.getElementById('selectorEstadoSg');
var estadoI = document.getElementById('selectorTicketSg');

$('#criterioSg').on('change', function () {
    fechaI.style.display = 'none';
    ticketI.style.display = 'none';
    estadoI.style.display = 'none';

    if (this.value == '1') {
        fechaI.style.display = 'block';
    } else if (this.value == '2') {
        ticketI.style.display = 'block';
    } else if (this.value == '3') {
        estadoI.style.display = 'block';
    }
});

$('#criterioSg').trigger('change');
