$(document).ready(function(){
    generar_departamentosInternos();
    
})

function generar_departamentosInternos(){

    $.getJSON("../controller/controlador_departamentosInternos.php","generarDepartamentosInternos=1",
    function(respuesta){
        var registros = [];
        plantilla = "<option value='' selected>Seleccione Un Departamento Interno</option>"
        registros.push(plantilla);
        $.each(respuesta,function(llave,valor){
            if(llave >= 0){
                if(valor.estado == 5 || $('#departamentoIntAuxiliar').val() == valor.id_departamento){
                    var plantilla = "<option value='" + valor.id_departamento + "'";
                    if($('#departamentoIntAuxiliar').val() == valor.id_departamento){
                        plantilla += "selected";
                    }
                    plantilla += ">" + valor.descripcion + "</option>";
                    registros.push(plantilla);
                }
            }
        })
        $('#f_departamentosInt').append(registros.join(""));
    });
}


$('#f_departamentosInt').on('change',function(){
        var filtro_departamentos = $('#f_departamentosInt').val();
        $.getJSON("../controller/controlador_areas.php","generarAreas=1",
        function(respuesta){
            var registros = [];
            $('#f_area').empty();
            var plantilla = "<option value=''>Seleccione un Area</option>";
            registros.push(plantilla);
            $.each(respuesta,function(llave,valor){
                if(llave >= 0){
                    if(filtro_departamentos != 0 ){
                        if(filtro_departamentos == valor.id_departamento){
                            var plantilla = "<option value='" + valor.id_area + "'";
                            plantilla += ">" + valor.descripcion + "</option>";
                            registros.push(plantilla);
                        }
                    }else{
                        var plantilla = "<option value='" + valor.id_area + "'";
                        plantilla += ">" + valor.descripcion + "</option>";
                        registros.push(plantilla);
                    }
                }
            })
            $('#f_area').append(registros.join(""));
        });


})


$('#f_area').on('change',function(){
    var filtro_area = $('#f_area').val();
        $.getJSON("../controller/controlador_cargos.php","generarcargos=1",
        function(respuesta){
            var registros = [];
            $('#f_cargo').empty();
            var plantilla = "<option value=''>Seleccione un Cargo</option>";
            registros.push(plantilla);
            $.each(respuesta,function(llave,valor){
                if(llave >= 0){
                    if(valor.estado == 5){
                        if(filtro_area != 0 ){
                            if(filtro_area == valor.id_area){
                                var plantilla = "<option value='" + valor.id_cargo + "'";
                                plantilla += ">" + valor.descripcion + "</option>";
                                registros.push(plantilla);
                            }
                        }else{
                            var plantilla = "<option value='" + valor.id_cargo + "'";
                            plantilla += ">" + valor.descripcion + "</option>";
                            registros.push(plantilla);
                        }
                    }
                }
            })
            $('#f_cargo').append(registros.join(""));
        });
})


$('#f_cargo').on('change',function(){
    var evaluar_cargo = $('#f_cargo').val();
    if($('#f_area').val() === null || $('#f_area').val() === 0 || $('#f_area').val() ==='' || $('#f_area').val() === undefined){
        var evaluar_area = 0;
    }else{
        var evaluar_area = $('#f_area').val();
    }
    var evaluar_departamento =  $('#departamentoInt').val();

        if(evaluar_cargo != 0 && evaluar_cargo != null){
            $.getJSON("../controller/controlador_cargos.php","consultarCargo=" + evaluar_cargo,
            function(respuesta){
                $.each(respuesta,function(llave,valor){
                    if(llave >= 0){
                        if(valor.id_departamento != evaluar_departamento){
                            $('#f_departamentosInt').val(valor.id_departamento);
                        }
                        if(valor.id_area != evaluar_area){
                            var filtro_departamentos = $('#f_departamentosInt').val();
                            $.getJSON("../controller/controlador_areas.php","generarAreas=1",
                            function(respuesta){
                                var registros = [];
                                $('#f_area').empty();
                                var plantilla = "<option value=''>Seleccione un Area</option>";
                                registros.push(plantilla);
                                $.each(respuesta,function(llave,valor2){
                                    if(llave >= 0){
                                        if(filtro_departamentos != 0 ){
                                            if(filtro_departamentos == valor2.id_departamento){
                                                var plantilla = "<option value='" + valor2.id_area + "'";
                                                if(valor.id_area == valor2.id_area){
                                                    plantilla += "selected";
                                                }
                                                plantilla += ">" + valor2.descripcion + "</option>";
                                                registros.push(plantilla);
                                            }
                                        }else{
                                            var plantilla = "<option value='" + valor2.id_area + "'";
                                            if(valor.id_area == valor2.id_area){
                                                plantilla += "selected";
                                            }
                                            plantilla += ">" + valor2.descripcion + "</option>";
                                            registros.push(plantilla);
                                        }
                                    }
                                })
                                $('#f_area').append(registros.join(""));
                            });
                        }
                        

                    }
                })
            })
        }
})