function modalCargo(id,descripcion,estado,area,auxiliarDp){
    limpiarInputsClave();
    $('#modal_id').val(id);
    $('#modal_descripcion').val(descripcion);
    $("#modal_estado").val(estado);
    $("#modal_auxiliarDp").val(auxiliarDp)
    parametro = "consultarArea=" + area + "&consultarEstadoArea=1";
    $.ajax({
        async : false,
        type:'POST',
        url: "app/controller/controlador_areas.php",
        data:parametro,
    }).done(function(data){
        if(data == 5){
            parametro = "consultarArea=" + area + "&consultarEstadoDepartamento=1";
            $.ajax({
                async : false,
                type:'POST',
                url: "app/controller/controlador_areas.php",
                data:parametro,
            }).done(function(data2){
                if(data2 == 5){
                    $('#modal_areaAsignado').val(area);
                }else{
                    $.smkAlert({
                        text: 'El Departamento se encuentra Inactivo. Si debe hacer una modificacion debera cambiar el cargo de area ha un area donde el departamento se encuentre Activo.',
                        type: 'warning'
                    });
                }
            })
        }else{
            $.smkAlert({
                text: 'El Area se encuentra Inactiva. Si debe hacer una modificacion debera cambiar el cargo de area.',
                type: 'warning'
            });
        }
    })

    var data = "consultarPlataformasxCargo=1&consultarCargo=" + id;
    $.ajax({
        async: false,
        type:"POST",
        url:"app/controller/controlador_cargos.php",
        data:data
    }).done(function(respuesta){
        $('div.checkbox-group.required :checkbox').prop('checked', false);
        let arreglo = respuesta.split(',');
        arreglo.forEach(function(arreglo,index){
            $('#plataformas' + arreglo).prop('checked',true);
        })
        
    })
    
}

function limpiarChecks(){
    $('div.checkbox-group.required :checkbox').prop('checked', false);
}

$("#modal_estado").on('change',function(){
    var validaPersonas = $("#modal_estado").val();
    var variable =  $('#modal_id').val();
    if(validaPersonas == 6){
        parametro = "consultarCargo=" + variable + "&consultarPersonas=1";
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_cargos.php",
            data:parametro,
        }).done(function(data){
            console.log(data);
            if(data > 0){
                $('.close').click();
                $.smkAlert({
                    text: 'En el Cargo aun se encuentran funcionarios asociados, antes de inactivarlo deberá modificar dichos funcionario.',
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
    var area = $("#modal_areaAsignado").val();
    var auxiliarDp = $('#modal_auxiliarDp').val();
    var plataformas = '';
    for(x=1;x<500;x++){
        if($('#plataformas' + x).prop('checked')){
            plataformas = plataformas + $('#plataformas' + x).val() + ',';
        }
    }    

    if(descripcion == '' || descripcion==null || (estado != 5 && estado !=6) || area == null || area == 0){
        $.smkAlert({
            text: 'Los datos introducidos son erroneos, verifiquelos e intente nuevamente',
            type: 'danger'
        });
    }else{
        var datos = "id_cargo=" + id + 
        "&descripcion=" + descripcion +
        "&estado=" + estado +
        "&area=" + area +
        "&auxiliarDp=" + auxiliarDp +
        "&plataformas=" + plataformas +
        "&modificarCargo=1";

        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_cargos.php",
            data:datos,
        }).done(function(data){
            if(data == 1){
                $('.close').click();
                $("#filtro_areas").trigger('change');
            }else if(data == 2){
                $.smkAlert({
                    text: 'El Titulo del Cargo ya se encuantra registrado, designele otro.',
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


$('#crear_cargo').click(function(){
    var descripcionCrear = $('#modal_descripcionCrear').val();
    var areaCrear = $('#modal_areaCrear').val();

    if(descripcionCrear == '' || descripcionCrear == null){
        $.smkAlert({
            text: 'El titulo del departamento no puede estar vacio.',
            type: 'danger'
        });
    }else if(areaCrear == null || areaCrear == 0){
        $.smkAlert({
            text: 'Se debe elegir un Area.',
            type: 'danger'
        });
    }else{
        var crearCargo = "crearCargos=1&descripcion=" + descripcionCrear +
        "&area=" + areaCrear;

        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/controlador_cargos.php",
            data: crearCargo,
        }).done(function(data){
            if(data == 1){
                $('#modal_descripcionCrear').val("");
                $('.close').click();
                $("#filtro_areas").trigger('change');
            }else if(data == 2){
                $.smkAlert({
                    text: 'El Titulo del Area ya se encuantra registrado, designele otro.',
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


$("#filtro_areas").on('change',function(){
    var filtro_areas = $('#filtro_areas').val();

    if(filtro_areas != 0){
        var redireccionar = "setRedireccionamiento=1&numRedireccionamiento=" + filtro_areas;
        $.ajax({
            async : false,
            type:'POST',
            url: "app/controller/control_redireccionamiento.php",
            data: redireccionar,
        })
        $("#contenido").load("app/view/organigrama_cargos.php");
    }else{
        $("#contenido").load("app/view/organigrama_cargos.php");
    }
    
})


/* Buscador */
$('#buscador').on('keyup', function() {
    $('#verSeleccionados').show();
    $('#verTodas').hide();
    var buscador = $('#buscador').val();

    if (buscador.trim() === '') {
        for(x=0;x<300;x++){
            $('#td' + x).show();
        }
    } else {
        for(x=1;x<300;x++){
            const removeAccents = (str) => {
                return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            } 

            var texto = $('#td'+x).text();
            texto_f = removeAccents(texto.toUpperCase());
            buscador_f = removeAccents(buscador.toUpperCase());
            resultado = texto_f.includes(buscador_f);
            if(resultado === false){
                $('#td' + x).hide();
            }else{
                $('#td' + x).show();
            }
            
        }
    }
});


$('#verSeleccionados').click(function(){
    $('#verSeleccionados').hide();
    $('#verTodas').show();
    for(x=0;x<300;x++){
        $('#td' + x).hide();
    }

    for(x=0;x<300;x++){
        if($('#plataformas' + x).prop('checked')){
            $('#td' + x).show();
        }
    }

});

function limpiarInputsClave(){
    $('#verSeleccionados').show();
    $('#verTodas').hide();
    var buscador = $('#buscador').val('');
    for(x=0;x<300;x++){
        $('#td' + x).show();
    }
}

$('#verTodas').click(function(){
    $('#verSeleccionados').show();
    $('#verTodas').hide();
    for(x=0;x<300;x++){
        $('#td' + x).show();
    }
})