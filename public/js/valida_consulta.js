$(document).ready(function () {
    $('#consultar').click(function () {
        var campo = $('#ticket').val();
        var restringir = /^\s+|\s+$/
        if (restringir.test(campo) || campo == '' || campo == undefined) {

            /*$("#ruta").load(" #ruta");*/
            $('#alert button').after('<span>No existe o no digito un número de Ticket valido !Intente Nuevamente¡</span>');
            $('#alert').fadeIn('slow');
            document.getElementById("consultar").disabled = true;

            setTimeout(function () {

                document.getElementById("consultar").disabled = false;
                $("#alerta").load(" #alerta");

            }, 3000);


        } else {

            $('#data').fadeIn('slow');

        }
    });
});
