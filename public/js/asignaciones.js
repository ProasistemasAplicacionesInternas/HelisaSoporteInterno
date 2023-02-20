function verClave(id,plataforma){
    $('#modal_id').val(id);
    $('#modal_descripcion').val(plataforma);

    $('#modal_clave').val('');
    $('#modal_clave2').val('')
    $('#modal_ver').css('display','block');
    $('#modal_modificar').css('display','none');
    $('#modal_texto').text('');
    $('#modal_clave').css('display','block');
    $('#modal_clave2').css('display','none');
}

$('#modal_ver').click(function(){
    $('#modal_ver').attr('disabled',true);
    $('#modal_texto').removeClass('text-danger').addClass('text-secondary').text('Procesando...');
    setTimeout(function(){
        var validar = new FormData();
        validar.append('clave',$('#modal_clave').val());
        validar.append('verificarBoveda','1');
        $.ajax({
            type: 'POST',
            url: '../controller/controlador_funcionarios.php',
            data: validar,
            processData: false,
            contentType: false,
            async: false
        }).done(function(respuesta){
            if(respuesta == 1){
                $('#modal_ver').css('display','none');
                $('#modal_modificar').css('display','block');
                $('#modal_texto').removeClass('text-danger').addClass('text-secondary').text('');

                var data = 'consultarClaveAccesoPlataforma=1&id_accesoPlataforma=' + $('#modal_id').val();
                $.ajax({
                    type: 'POST',
                    url: '../controller/controlador_peticionesAccesos.php',
                    data:data,
                    async: false
                }).done(function(respuesta2){
                    $('#modal_clave').css('display','none');
                    $('#modal_clave2').css('display','block');
                    $('#modal_clave2').val(respuesta2);
                })

            }else{
                $('#modal_texto').removeClass('text-secondary').addClass('text-danger').text('Contraseña Incorrecta');
            }
            $('#modal_ver').attr('disabled',false);
        })
    },1000);
   
})

$('#modal_modificar').click(function(){
    var clave = $('#modal_clave2').val();
    var id_accesoPLataforma = $('#modal_id').val();
    var data = "modificarClaveAccesosPlataforma=1&clave=" + clave + "&id_accesoPlataforma=" + id_accesoPLataforma;
    $.ajax({
        type:"POST",
        url:"../controller/controlador_peticionesAccesos.php",
        data:data
    }).done(function(respuesta){
        console.log(respuesta);
        if(respuesta==1){
            $('.close').click();
            $.smkAlert({
                text: 'Clave Modificada',
                type: 'success'
            });
        }else{
            $('.close').click();
            $.smkAlert({
                text: 'Error Interno',
                type: 'danger'
            });
        }
    })
})