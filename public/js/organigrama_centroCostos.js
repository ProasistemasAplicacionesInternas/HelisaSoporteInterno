
$('#crear_centroCostos').click(function(){
    var descripcionCrear = $('#modal_descripcionCrear').val();
    var codigoCrear = $('#modal_codigoCrear').val();

    if(descripcionCrear == '' || descripcionCrear == null){
        $.smkAlert({
            text: 'El titulo del Centro de costos no puede estar vacio.',
            type: 'warning'
        });
    }else if(codigoCrear == 0 || descripcionCrear == null || codigoCrear.length > 12 || codigoCrear.length < 8){
        $.smkAlert({
            text: 'El codigo del Centro de Costos no puede estar vacio, tener mas de 12 digitos o menos de 8.',
            type: 'warning'
        });
    }else{
        var crearCentroCostos = "crearCentroCostos=1&descripcion=" + descripcionCrear +
        "&codigo=" + codigoCrear;
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_centroCostos.php",
            data: crearCentroCostos,
        }).done(function(data){
            if(data == 1){
                $('.close').click();
                $("#contenido").load("app/view/organigrama_centroCostos.php");
            }else if(data == 2){
                $.smkAlert({
                    text: 'El codigo del Centro de Costos ya se encuantra registrado, designele otro.',
                    type: 'warning'
                });
            }else{
                $('#modal_descripcionCrear').val("");
                $('#modal_codigoCrear').val("");
                $('.close').click();
                $.smkAlert({
                    text: 'Se presento un problema intente de nuevo',
                    type: 'danger'
                });
            }
        })
    }
}) 





