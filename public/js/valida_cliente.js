$(document).ready(function () {

    $("#crea_identidad").focus();

    $('#crea_identidad').focusout(function () {

        if ($('#crea_identidad').val() != "") {
            $.ajax({
                type: "POST",
                url: "app/controller/control_valida_cliente.php",
                data: "crea_identidad=" + $('#crea_identidad').val(),
                dataType: "html",
                success: function (data) {
                    if (data == 1) {
                        $('#mensaje').removeClass('text-success').addClass('text-danger').text('Este cliente ya existe Verifique');
                        document.getElementById("guardar").disabled = true;
                    } else {
                        $('#mensaje').removeClass('text-danger').addClass('text-success').text('');
                        document.getElementById("guardar").disabled = false;
                    }

                }
            });
        }
    });
});
