$(document).ready(function() {
    $(document).on('click', '.cliente-modal', function() {
        let id = $(this).val();
        let codigo_cliente = $('#codigo_cliente' + id).text();
        let nombre = $('#nombre' + id).text();
        let identidad = $('#identidad' + id).text();
        let estado = $('#id_estado' + id).text();


        $('#cliente-modal').modal('show');
        $('#codigo_cliente').val(codigo_cliente);
        $('#nombre').val(nombre);
        $('#identidad').val(identidad);
        $('#id_estado').val(estado);



    });
});