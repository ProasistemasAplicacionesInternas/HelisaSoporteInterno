$(document).ready(function() {
    $(document).on('click', '.modifica-maquina', function() {
        var id = $(this).val();
        var id_maquina = $('#id_maquina' + id).text();
        var descripcion = $('#descripcion' + id).text();
        var direccion = $('#direccion' + id).text();
        var nombreServidor = $('#id_servidor' + id).text();
        $('#modifica-maquina').modal('show');
        $('#id_maquina').val(id_maquina);
        $('#descripcion').val(descripcion);
        $('#direccion').val(direccion);
        $('#id_servidor').val(nombreServidor);

    });
});