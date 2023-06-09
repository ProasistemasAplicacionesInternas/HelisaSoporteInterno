$(document).ready(function(){
  $("#btn-comentar").on('click',function(){

        if ($('#form-comentario').smkValidate()) {

            var infoComentario = '&id_peticion=' + $('#id_peticion').val() +            
            '&comentario=' + $('#comentario').val() +
            '&crear_comentario=1';              

           console.log(infoComentario);
            $.ajax({
                type: 'POST',
                url: '../controller/controlador_peticion.php',
                data: infoComentario

            }).done(function (data) {

                console.log(data)
                if (data == 1) {
                	location.reload();                 
                  ("#crearComentario").modal('hide');
                                      
                } else {
                    $.smkAlert({
                        text: 'Se presento un problema intente de nuevo',
                        type: 'danger'
                    });
                }

            });
        }
  });

});
