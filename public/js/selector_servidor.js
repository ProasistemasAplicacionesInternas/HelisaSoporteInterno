$(document).ready(function () {
    $(document).on('click', '.modifica-servidor', function () {
        var id = $(this).val();
        var id_servidor = $('#id_servidor' + id).text();
        var descripcion = $('#descripcion' + id).text();
        var direccion = $('#direccion' + id).text();
        

        $('#modifica-servidor').modal('show');
        $('#id_servidor').val(id_servidor);
        $('#descripcion').val(descripcion);
        $('#direccion').val(direccion);
        
    });
});
