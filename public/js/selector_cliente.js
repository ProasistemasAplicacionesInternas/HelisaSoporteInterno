$(document).ready(function() {
    $(document).on('click', '.cliente-modal', function() {
        var id = $(this).val();
        var nombre = $('#nombre' + id).text();
        var identidad = $('#identidad' + id).text();
        var correo = $('#correo' + id).text();
        var estado = $('#id_estado' + id).text();
        var servidor = $('#servidor' + id).text();


        $('#cliente-modal').modal('show');
        $('#nombre').val(nombre);
        $('#identidad').val(identidad);
        $('#correo').val(correo);
        $('#id_estado').val(estado);
        $('#servidor').val(servidor);


    });
});