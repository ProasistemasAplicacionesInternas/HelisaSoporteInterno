function marcarevisado(value) {
    var nro_solicitud = '&nro_solicitud=' + value + '&marcarRevisado=1';
    $.ajax({
        type: 'post',
        url: 'app/controller/controladorPeticionSeguridad.php',
        data: nro_solicitud
    }).done(function(data) {
        console.log('Dato recibido del servidor: ' + data);

        if (data == 1) {
            $('#infoPeticionSeguridad').load('app/view/peticiones_sg.php');
            $.smkAlert({
                text: 'La solicitud fue revisada',
                type: 'warning'
            });
        } else {
            alert("No fue posible marcar como revisado");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error('Error en la solicitud AJAX: ', textStatus, errorThrown);
    });
}
