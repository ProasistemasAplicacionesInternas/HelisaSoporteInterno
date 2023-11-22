
    function validarBoton(usuario, id){
        $.ajax({
            type:"POST",
            url: "app/controller/controladorSeleccionar.php",
            data: "seleccionar_peticionmai="+ usuario,
            dataType: "html",
            success: function (data){
                if (data==0){
                 $('#seleccionar_peticionmai' + id).click();
                   
                }else{
                    $.smkAlert({
                        text: 'ya tiene la petición ' + data + ' seleccionada' ,
                        type: 'danger'
                });
                }
            }
        });
    }
