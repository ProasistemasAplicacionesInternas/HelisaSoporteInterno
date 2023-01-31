$(document).ready(function(){
    $('#f_centroCostos').trigger('change');
    $('#f_cargo').trigger('change');
    var x = $('#f_cargo').val();
    $('#f_area').trigger('change');
    $('#f_cargo').val(x);
})


$('#f_centroCostos').on('change', function(){

    if($('#f_centroCostos').val() != 0 && $('#f_centroCostos').val() != null && $('#f_centroCostos').val() != undefined && $('#f_centroCostos').val() != ''){
        var params = {
            consultarCentroCostosxID: + $('#f_centroCostos').val(),
            consultarcodigo: 1
        };

        $.ajax({
            type: 'POST',
            url: '../controller/controlador_centroCostos.php',
            data: params,
        }).done(function(data){
            $('#centroCostosCodigo').val(data);
        })
        
    }
})


$('#f_departamentosInt').on('change', function(){

    if($('#f_departamentosInt').val() != 0){
        $(".areaCP" ).css('display','none'); 

        var id_departamento = $('#f_departamentosInt').val();
        
        var areaVisibles = "areaCS" + id_departamento;

        $("." + areaVisibles).css('display','block');
    }else{
        $(".areaCP" ).css('display','block');
    }
    $('#f_area').val('');
})

$('#f_area').on('change', function(){

    if($('#f_area').val() != 0){
        $(".cargoCP" ).css('display','none'); 

        var id_area = $('#f_area').val();
        
        var cargoVisibles = "cargoCS" + id_area;

        $("." + cargoVisibles).css('display','block');
    }else{
        $(".cargoCP" ).css('display','block');
    }
    $('#f_cargo').val('');

})


$('#f_cargo').on('change', function(){

    var id_cargo = $('#f_cargo').val();

    if(id_cargo != 0 && id_cargo != null && id_cargo != undefined && id_cargo != ''){
        $(".areaCP" ).css('display','none'); 

        var data_cargo = "consultarCargo=" + id_cargo + "&consultarIDdepartamentoxCargo=1";
        $.ajax({
            type: 'POST',
            url: '../controller/controlador_cargos.php',
            data: data_cargo,
        }).done(function(data){
            $('#f_departamentosInt').val(data);
            var areaVisibles = "areaCS" + data;
            $("." + areaVisibles).css('display','block');
        });

        var data_cargoB = "consultarCargo=" + id_cargo + "&consultarIDareaxCargo=1";
        $.ajax({
            type: 'POST',
            url: '../controller/controlador_cargos.php',
            data: data_cargoB,
        }).done(function(data2){
            $('#f_area').val(data2);
        });
    }

})




    