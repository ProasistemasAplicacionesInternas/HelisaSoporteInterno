$('input[type="password"]').not('#contrasena' && '#contrasenaActual').keyup(function () {
    var clave = $('#clave').val();
    var confirma = $('#confirma').val();
    var regExPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}/
    var restringir = /^\s+|\s+$/

   if (!regExPattern.test(clave)) {

        $('#valida').removeClass('text-success').addClass('text-danger').text('La contraseña debe incluir mayúsculas,minúsculas,caracteres y números.Debe tener como mínimo 10 caracteres.');
        document.getElementById("enviar").disabled = true;

    }else if (restringir.test(clave) || !confirma || !clave) {
        $('#valida').removeClass('text-success').addClass('text-danger').text('Las contraseñas no coinciden');
        document.getElementById("cambiar_contrasena").disabled = true;
    } else if (clave != confirma) {
            $('#valida').removeClass('text-success').addClass('text-danger').text('Las contraseñas no coinciden');
            document.getElementById("cambiar_contrasena").disabled = true;
        } else {
            $('#valida').removeClass('text-danger').addClass('text-success').text('');
            document.getElementById("cambiar_contrasena").disabled = false;
        }
    
});


$('#contrasenaActual').keyup(function(){
    var contrasenaActual = $('#contrasenaActual').val();

    if(contrasenaActual != ''){
        document.getElementById("validarContrasenaActual").disabled = false;
    }else{
        document.getElementById("validarContrasenaActual").disabled = true;
    }
})

$('#validarContrasenaActual').click(function(){
    $('#validaCA').removeClass('text-danger').addClass('text-secondary').text('Procesando...');
    var contrasenaActual = $('#contrasenaActual').val();
        var validar = new FormData();
        validar.append('clave',contrasenaActual);
        validar.append('verificarBoveda','1');
        $.ajax({
            type: 'POST',
            url: 'app/controller/controlador_funcionarios.php',
            data: validar,
            processData: false,
            contentType: false,
        }).done(function(data){
            if(data == 1){
                $('#ValidarcontrasenaActual-Div').css('display','none');
                $('#validarContrasenaActual').css('display','none');
                $('#continuarModificacion-Div').css('display','block');
            }else{
                $('#validaCA').removeClass('text-secondary').addClass('text-danger').text('Contraseña Incorrecta');
            }
        })

})

