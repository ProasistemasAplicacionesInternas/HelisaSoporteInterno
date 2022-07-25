/*------------------@jefferson.correa--------------------*/

$(document).ready(function() {
    $(document).on('click', '.crear-maquina', function() {
        let id = $(this).val();
        let nombre_servidor = $('#nombre_servidor' + id).text();
        let id_servidorS = $('#id_servidor' + id).text();

        $('#crear-maquina').modal('show');
        $('#codigoServidor').val(id_servidorS);
        $('#nombre_servidor').val(nombre_servidor);


    });
});
/*------------------@jefferson.correa--------------------*/