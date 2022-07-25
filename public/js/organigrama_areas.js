function modalArea(id,descripcion,estado,departamento){
    $('#modal_id').val(id);
    $('#modal_descripcion').val(descripcion);
    $("#modal_estado").val(estado);


    parametro = "consultarDepartamentoxID=" + departamento + "&consultarEstado=1";
    $.ajax({
        async : false,
        type:'POST',
        url: "app/controller/controlador_departamentosInternos.php",
        data:parametro,
    }).done(function(data){
        if(data == 5){
            $("#modal_departamentoAsignado").val(departamento);
        }else{
            $.smkAlert({
                text: 'El Departamento se encuentra Inactivo. Si debe hacer una modificacion debera cambiar el area de departamento.',
                type: 'warning'
            });
        }
    })
    
    
}

$("#modal_estado").on('change',function(){
    var validaPersonas = $("#modal_estado").val();
    var variable =  $('#modal_id').val();
    if(validaPersonas == 6){
        parametro = "consultarArea=" + variable + "&consultarPersonas=1";

        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_areas.php",
            data:parametro,
        }).done(function(data){
            if(data > 0){
                $('.close').click();
                $.smkAlert({
                    text: 'En el área aun se encuentran funcionarios asociados, antes de inactivarlo deberá modificar dichos funcionario.',
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
    var departamento = $("#modal_departamentoAsignado").val();

    if(descripcion == '' || descripcion==null || (estado != 5 && estado !=6) || departamento == undefined || departamento == 0){
        $.smkAlert({
            text: 'Los datos introducidos son erroneos, verifiquelos e intente nuevamente',
            type: 'danger'
        });
    }else{
        var datos = "id_area=" + id + 
        "&descripcion=" + descripcion +
        "&estado=" + estado +
        "&departamento=" + departamento +
        "&modificarArea=1";

        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_areas.php",
            data:datos,
        }).done(function(data){
            if(data == 1){
                $('.close').click();
                $("#filtro_departamentos").trigger('change');
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



$('#crear_area').click(function(){
    var descripcionCrear = $('#modal_descripcionCrear').val();
    var departamentoCrear = $('#modal_departamentoCrear').val();

    if(descripcionCrear == '' || descripcionCrear == null){
        $.smkAlert({
            text: 'El titulo del Area no puede estar vacio.',
            type: 'danger'
        });
    }else if(departamentoCrear == null || departamentoCrear == 0){
        $.smkAlert({
            text: 'Se debe elegir un departamento.',
            type: 'danger'
        });
    }else{
        var crearArea = "crearArea=1&descripcion=" + descripcionCrear +
        "&departamento=" + departamentoCrear;
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_areas.php",
            data: crearArea,
        }).done(function(data){
            if(data == 1){
                $('#modal_descripcionCrear').val("");
                $('.close').click();
                $("#filtro_departamentos").trigger('change');
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
    $("#contenido").load("app/view/organigrama_cargos.php");
}


$("#filtro_departamentos").on('change',function(){
    var filtro_departamentos = $('#filtro_departamentos').val();

    if(filtro_departamentos != 0){
        var redireccionar = "setRedireccionamiento=1&numRedireccionamiento=" + filtro_departamentos;
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/control_redireccionamiento.php",
            data: redireccionar,
        })
        $("#contenido").load("app/view/organigrama_areas.php");
    }else{
        $("#contenido").load("app/view/organigrama_areas.php");
    }
    
})



