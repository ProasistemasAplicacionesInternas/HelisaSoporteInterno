$(document).ready(function () {
    $(document).on('click', '.inactiva-usuario', function () {
        var id = $(this).val();
        var id_usuario = $('#id_usuarioX' + id).text();
        

        $('#inactiva-usuario').modal('show');
        $('#id_usuarioI').val(id_usuario);
        
        
       
    });
});