$(document).ready(function() {
    $(document).on('click', '.ticket-modal', function() {
        let id = $(this).val();
        let nombre = $('#nombre' + id).text();
        let telefono = $('#telefono' + id).text();
        let contacto = $('#contacto' + id).text();
        let solicitud = $('#solicitud' + id).text();
        let ticket = $('#ticket' + id).text();
        let conclusion = $('#conclusion' + id).text();

        $('#ticket-modal').modal('show');
        $('#nombre').val(nombre);
        $('#telefono').val(telefono);
        $('#contacto').val(contacto);
        $('#solicitud').val(solicitud);
        $('#ticket').val(ticket);
        $('#conclusion').val(conclusion);


    });
});