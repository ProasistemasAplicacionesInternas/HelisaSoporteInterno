
$(document).ready(function () {
    $(document).on('click', '#btn-crearComentario', function () {

        var id = $(this).val();
        var id_peticion = $('#id_peticion' + id).text();       
               console.log(id_peticion.trim());
        $('#crearComentario').modal('show');
        $('#id_peticion').val(id_peticion.trim());
        
       
    });
});