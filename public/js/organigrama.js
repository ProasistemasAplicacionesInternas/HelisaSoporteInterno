function modalDepartamento(id,descripcion,estado){
    $('#modal_id').val(id);
    $('#modal_descripcion').val(descripcion);
    $("#modal_estado").val(estado);

}

$("#modal_estado").on('change',function(){
    var validaPersonas = $("#modal_estado").val();
    var variable =  $('#modal_id').val();
    if(validaPersonas == 6){
        parametro = "consultarDepartamentoxID=" + variable + "&consultarPersonas=1";
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_departamentosInternos.php",
            data:parametro,
        }).done(function(data){
            if(data > 0){
                $('.close').click();
                $.smkAlert({
                    text: 'En el Departamento aun se encuentran funcionarios asociados, antes de inactivarlo deberá modificar dichos funcionario.',
                    type: 'warning'
                });
            }
        })
    }
})


$('#modal_guardar').click(function(){
    var id = $('#modal_id').val();
    var descripcion = $('#modal_descripcion').val();
    var estado = $("#modal_estado").val();

    if(descripcion == '' || descripcion==null || (estado != 5 && estado !=6)){
        $.smkAlert({
            text: 'Los datos introducidos son erroneos, verifiquelos e intente nuevamente',
            type: 'danger'
        });
    }else{
        var datos = "id_departamento=" + id + 
        "&descripcion=" + descripcion +
        "&estado=" + estado +
        "&modificarDespartamentoInt=1";

        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_departamentosInternos.php",
            data:datos,
        }).done(function(data){
            if(data == 1){
                $('.close').click();
                $("#contenido").load("app/view/organigrama.php");
            }else if(data == 2){
                $.smkAlert({
                    text: 'El Titulo del departamento ya se encuantra registrado, designele otro.',
                    type: 'warning'
                });
            }else{
                $('.close').click();
                $.smkAlert({
                    text: 'Se presento un problema intente de nuevo',
                    type: 'danger'
                });
            }
        })
    }
    
})


$('#crear_departamento').click(function(){
    var descripcionCrear = $('#modal_descripcionCrear').val();

    if(descripcionCrear == '' || descripcionCrear == null){
        $.smkAlert({
            text: 'El titulo del departamento no puede estar vacio.',
            type: 'danger'
        });
    }else{
        var crearDepartamento = "crearDespartamentoInt=1&descripcion=" + descripcionCrear;
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_departamentosInternos.php",
            data: crearDepartamento,
        }).done(function(data){
            if(data == 1){
                $('#modal_descripcionCrear').val("");
                $('.close').click();
                $("#contenido").load("app/view/organigrama.php");
            }else if(data == 2){
                $.smkAlert({
                    text: 'El Titulo del departamento ya se encuantra registrado, designele otro.',
                    type: 'warning'
                });
            }else{
                $('#modal_descripcionCrear').val("");
                $('.close').click();
                $.smkAlert({
                    text: 'Se presento un problema intente de nuevo',
                    type: 'danger'
                });
            }
        })
    }
})

function redireccionar(redireccion){
    var redireccionar = "setRedireccionamiento=1&numRedireccionamiento=" + redireccion;
    $.ajax({
        async : false,
        type:'POST',
        url: "app/controller/control_redireccionamiento.php",
        data: redireccionar,
    })
    $("#contenido").load("app/view/organigrama_areas.php");
}




