function marcaRevisado(value) {
    var nroSolicitud = '&nroSolicitud=' + value + '&marcaRevisado=1';
    $.ajax({
        type: 'post',
        url: 'app/controller/controladorPeticionSeguridad.php',
        data: nroSolicitud
    }).done(function(data) {
        console.log('Dato recibido del servidor: ' + data);
        console.log('dato num solicitud:' + value);

        if (data == 1) {
            $('#infoPeticionSeguridad').load('app/view/peticionesSg.php');
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
