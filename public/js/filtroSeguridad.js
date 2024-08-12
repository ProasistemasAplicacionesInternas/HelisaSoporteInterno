var fechaI = document.getElementById('selectorCategoriaSg');
var ticketI = document.getElementById('selectorEstadoSg');
var estadoI = document.getElementById('selectorTicketSg');

$('#criterioSg').on('change', function () {
    // Ocultar todos los elementos primero
    fechaI.style.display = 'none';
    ticketI.style.display = 'none';
    estadoI.style.display = 'none';

    // Mostrar el elemento correspondiente basado en la selección
    if (this.value == '1') {
        fechaI.style.display = 'block'; // Mostrar selector de categoría
    } else if (this.value == '2') {
        ticketI.style.display = 'block'; // Mostrar selector de estado
    } else if (this.value == '3') {
        estadoI.style.display = 'block'; // Mostrar selector de ticket
    }
});

// Disparar el evento change al cargar la página para que muestre la opción correcta si ya está seleccionada
$('#criterioSg').trigger('change');
