const numPlataformas = 300;

$(document).ready(function(){
    limpiarInputsClave();
    consultarAccesosPltaformasAsignadas($('#funcionario').val());
})

$('div.checkbox-group.required :checkbox').on('change',function(){
    if($('div.checkbox-group.required :checkbox:checked').length > 0){
        $('#crear_peticion_accesos').prop('disabled', false);
    }else{
        $('#crear_peticion_accesos').prop('disabled', true);
    }
})

function plataformasIngreso(funcionario){
    $('#crear_peticion_accesos').prop('disabled', true);
    var data = "consultarPlataformasIngreso=1&usuario=" + funcionario;
    $.ajax({
        type:"POST",
        url:"../controller/controlador_peticionesAccesos.php",
        data:data
    }).done(function(respuesta){
        $('div.checkbox-group.required :checkbox').prop('checked', false);

        let arreglo = respuesta.split(',');
        arreglo.forEach(function(arreglo,index){
            /* console.log('[' + index + '] : [' + arg + ']'); */
            $('#plataformas' + arreglo).prop('checked', true);
        })
        $('div.checkbox-group.required :checkbox').trigger('change');
    })
}

$('#funcionarioAlterno').on('change',function(){
    limpiarChecks();
    limpiarInputsClave();
    if($('#funcionarioAlterno').val() == 0){
        consultarAccesosPltaformasAsignadas($('#funcionario').val());
    }else{
        consultarAccesosPltaformasAsignadas($('#funcionarioAlterno').val());
    }
    $('#tipo').val(1);
    $('#tipo').trigger('change');
})

$('#plataformasDesignadas').click(function(){
    if($('#funcionarioAlterno').val() == 0){
        plataformasIngreso($('#funcionario').val());
    }else{
        plataformasIngreso($('#funcionarioAlterno').val());
    }
})

function limpiarChecks(){
    $('div.checkbox-group.required :checkbox').prop('checked', false);
    $('div.checkbox-group.required :checkbox').trigger('change');
}



$('#buscador').on('keyup', function() {
    $('#verSeleccionados').show();
    $('#verTodas').hide();
    var buscador = $('#buscador').val();

    if (buscador.trim() === '') {

        if($('#tipo').val() == 1){
            mostrarTodasPltaformas();
        }else if($('#tipo').val() == 2){ 
            plataformasAsignadasChekbox();//mejorar
        } 
        
    } else {
        if($('#tipo').val() == 1){
            
            const removeAccents = (str) => {
                return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            } 

            for(x=1;x<numPlataformas;x++){
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
        }else if($('#tipo').val() == 2){

            if($('#funcionarioAlterno').val() == 0){
                usuario = $('#funcionario').val();
            }else{
                usuario = $('#funcionarioAlterno').val();
            }
            var data = 'consultarAccesosPlataformas=2&usuario=' + usuario + "&tipo=2";
            $.ajax({
                type:"POST",
                url:"../controller/controlador_peticionesAccesos.php",
                data: data
            }).done(function(respuesta){
                for(x=0;x<numPlataformas;x++){
                    $('#td' + x).hide();
                }

                const removeAccents = (str) => {
                    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                }

                var arreglo = respuesta.split(',');
                arreglo.forEach(function(valor,index){
                    var texto = $('#td'+valor).text();
                    texto_f = removeAccents(texto.toUpperCase());
                    buscador_f = removeAccents(buscador.toUpperCase());
                    resultado = texto_f.includes(buscador_f);
                    if(resultado === true){
                        $('#td' + valor).show();
                    }
                })
        
            })
        }else if($('#tipo').val() == 3){

            if($('#funcionarioAlterno').val() == 0){
                usuario = $('#funcionario').val();
            }else{
                usuario = $('#funcionarioAlterno').val();
            }
            var data = 'consultarAccesosPlataformas=2&usuario=' + usuario + "&tipo=2";
            $.ajax({
                type:"POST",
                url:"../controller/controlador_peticionesAccesos.php",
                data: data
            }).done(function(respuesta){
                for(x=0;x<numPlataformas;x++){
                    $('#td' + x).hide();
                }

                const removeAccents = (str) => {
                    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                }

                var arreglo = respuesta.split(',');
                arreglo.forEach(function(valor,index){
                    var texto = $('#td'+valor).text();
                    texto_f = removeAccents(texto.toUpperCase());
                    buscador_f = removeAccents(buscador.toUpperCase());
                    resultado = texto_f.includes(buscador_f);
                    if(resultado === true){
                        $('#td' + valor).show();
                    }
                })
        
            })
        }else if($('#tipo').val() == 4){

            if($('#funcionarioAlterno').val() == 0){
                usuario = $('#funcionario').val();
            }else{
                usuario = $('#funcionarioAlterno').val();
            }
            var data = 'consultarAccesosPlataformas=4&usuario=' + usuario + "&tipo=4";
            $.ajax({
                type:"POST",
                url:"../controller/controlador_peticionesAccesos.php",
                data: data
            }).done(function(respuesta){
                for(x=0;x<numPlataformas;x++){
                    $('#td' + x).hide();
                }

                const removeAccents = (str) => {
                    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                }

                var arreglo = respuesta.split(',');
                arreglo.forEach(function(valor,index){
                    var texto = $('#td'+valor).text();
                    texto_f = removeAccents(texto.toUpperCase());
                    buscador_f = removeAccents(buscador.toUpperCase());
                    resultado = texto_f.includes(buscador_f);
                    if(resultado === true){
                        $('#td' + valor).show();
                    }
                })
        
            })
        }
    }
});


$('#verSeleccionadosIcon').click(function(){
    $('#verSeleccionadosIcon').hide();
    $('#verTodasIcon').show();
    $('#resultable').removeClass('table-striped');
    
    ocultarTodasPlataformas();

    for(x=0;x<numPlataformas;x++){
        if($('#plataformas' + x).prop('checked')){
            $('#td' + x).show();
        }
    }

});

function limpiarInputsClave(){
    $('#verSeleccionadosIcon').show();
    $('#verTodasIcon').hide();
    $('#resultable').addClass('table-striped');
    $('#buscador').val('');
    mostrarTodasPltaformas();
}

$('#verTodasIcon').click(function (){
    $('#verSeleccionadosIcon').show();
    $('#verTodasIcon').hide();
    $('#resultable').addClass('table-striped');
    
    if($('#tipo').val() == 1){
       mostrarTodasPltaformas();
    }else if($('#tipo').val() == 2){
        plataformasAsignadasChekbox()
    }else if($('#tipo').val() == 3){
        plataformasAsignadasChekbox()
    }
    // else if($('#tipo').val() == 4){
    //     plataformasInactivasChekbox()
    // }
    
})

function consultarAccesosPltaformasAsignadas(usuario){
    var data = 'consultarAccesosPlataformas=2&usuario=' + usuario + "&tipo=1";
    $.ajax({
        type:"POST",
        url:"../controller/controlador_peticionesAccesos.php",
        data: data
    }).done(function(respuesta){
        $('#accesosUsuario').empty();
        if(respuesta != ''){
            var arreglo = respuesta.split('/,,/');
            arreglo.forEach(function(valor,index){
                var asignacion= '<tr>';
                var arreglo2 = valor.split('/--/');
                arreglo2.forEach(function(valor2,index2){
                    asignacion += "<td style='max-width:12vh;overflow:hidden;' title='" + valor2 + "'>"  + valor2 + "</td>";
                })
                asignacion += "</tr>";
                $('#accesosUsuario').append(asignacion);
            })
        }else{
            $('#accesosUsuario').append("<tr><td style='max-width:5vh'>Sin asignaccion</td><td style='max-width:5vh'>Sin Asignaciones</td></tr>");
        }
    })
}


$('#tipo').on('change',function(){
    $('#buscador').val('');
    $('#verSeleccionadosIcon').show();
    $('#verTodasIcon').hide();
    limpiarChecks();
    $('#resultable').addClass('table-striped');

    if($('#tipo').val() == 1){
        $('#plataformasDesignadas').show();
        mostrarTodasPltaformas();
    }else if ($('#tipo').val() == 2 || $('#tipo').val() == 3){
        $('#plataformasDesignadas').hide();
        plataformasAsignadasChekbox();
        setTimeout(function(){
            seleccionarTodas();
            $('div.checkbox-group.required :checkbox').trigger('change');
        },200);
        
    }else if ($('#tipo').val() == 4) {
        $('#plataformasDesignadas').hide();
        plataformasInactivasChekbox();
        setTimeout(function(){
            seleccionarTodas();
            $('div.checkbox-group.required :checkbox').trigger('change');
        },200);
    }
})

function mostrarTodasPltaformas(){
    for(x=0;x<numPlataformas;x++){
        $('#td' + x).show();
    }
}

function ocultarTodasPlataformas(){
    for(x=0;x<numPlataformas;x++){
        $('#td' + x).hide();
    }
}


function plataformasAsignadasChekbox(){
        if($('#funcionarioAlterno').val() == 0){
        usuario = $('#funcionario').val();
    }else{
        usuario = $('#funcionarioAlterno').val();
    }

    var data = 'consultarAccesosPlataformas=2&usuario=' + usuario + "&tipo=2";
    $.ajax({
        type:"POST",
        url:"../controller/controlador_peticionesAccesos.php",
        data: data
    }).done(function(respuesta){
        var arreglo = respuesta.split(',');
        for(x=0;x<numPlataformas;x++){
            $('#td' + x).hide();
        }
        arreglo.forEach(function(valor,index){
            $('#td' + valor).show();
        })

    })
}
function plataformasInactivasChekbox(){
    if($('#funcionarioAlterno').val() == 0){
        usuario = $('#funcionario').val();
    }else{
        usuario = $('#funcionarioAlterno').val();
    }

    var data = 'consultarAccesosPlataformas=4&usuario=' + usuario + "&tipo=4";
    $.ajax({
        type:"POST",
        url:"../controller/controlador_peticionesAccesos.php",
        data: data
    }).done(function(respuesta){
        var arreglo = respuesta.split(',');
        for(x=0;x<numPlataformas;x++){
            $('#td' + x).hide();
        }
        arreglo.forEach(function(valor,index){
            $('#td' + valor).show();
        })

    })
}


function seleccionarTodas(){
    for(x=1;x<numPlataformas;x++){
        if($('#td'+x).is(':visible') && $('#td'+x).css("visibility") != "hidden" && $('#td'+x).css("opacity") > 0){
            var plataforma = document.getElementById('plataformas'+x);
            plataforma.checked = true;
        }

    }
}

$('#seleccionarTodasIcon').click(function(){
    seleccionarTodas();
})
function LimpiarInputsyChecks(){
    $('#verSeleccionadosIcon').hide();
    $('#verTodasIcon').show();
    $('#resultable').removeClass('table-striped');
    
    ocultarTodasPlataformas();

    for(x=0;x<numPlataformas;x++){
        if($('#plataformas' + x).prop('checked')){
            $('#td' + x).show();
        }
    }
    }
