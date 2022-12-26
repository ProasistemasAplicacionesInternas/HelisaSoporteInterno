var datosActivos = document.getElementById('datos_adicionales');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#af_categoria').on('change', function () {
    if (this.value == 1 ) {
        datosActivos.style.display='inline';
        document.getElementById("af_ram").required = true;
        document.getElementById("af_discoDuro").required = true;
        document.getElementById("af_procesador").required = true;
        document.getElementById("af_so").required = true;
        document.getElementById("af_licenciaSo").required = true;
        document.getElementById("af_dominio").required = true;
        document.getElementById("af_aplicaciones").required = true;
        document.getElementById("af_office").required = true;
        document.getElementById("af_antivirus").required = true;
                
    }else if (this.value == 3 ) {
        datosActivos.style.display='inline';
        document.getElementById("af_ram").required = true;
        document.getElementById("af_discoDuro").required = true;
        document.getElementById("af_procesador").required = true;
        document.getElementById("af_so").required = true;
        document.getElementById("af_licenciaSo").required = true;
        document.getElementById("af_dominio").required = true;
        document.getElementById("af_aplicaciones").required = true;
        document.getElementById("af_office").required = true;
        document.getElementById("af_antivirus").required = true;
            
    }else if (this.value == 13 ) {
        datosActivos.style.display='inline';
        document.getElementById("af_ram").required = true;
        document.getElementById("af_discoDuro").required = true;
        document.getElementById("af_procesador").required = true;
        document.getElementById("af_so").required = true;
        document.getElementById("af_licenciaSo").required = true;
        document.getElementById("af_dominio").required = true;
        document.getElementById("af_aplicaciones").required = true;
        document.getElementById("af_office").required = true;
        document.getElementById("af_antivirus").required = true;
       
    }else if (this.value == 14 ) {
        datosActivos.style.display='inline';
        document.getElementById("af_ram").required = true;
        document.getElementById("af_discoDuro").required = true;
        document.getElementById("af_procesador").required = true;
        document.getElementById("af_so").required = true;
        document.getElementById("af_licenciaSo").required = true;
        document.getElementById("af_dominio").required = true;
        document.getElementById("af_aplicaciones").required = true;
        document.getElementById("af_office").required = true;
        document.getElementById("af_antivirus").required = true;
       
    }
    else{
        datosActivos.style.display = 'none';
        document.getElementById("af_ram").required = false;
        document.getElementById("af_discoDuro").required = false;
        document.getElementById("af_procesador").required = false;
        document.getElementById("af_so").required = false;
        document.getElementById("af_licenciaSo").required = false;
        document.getElementById("af_dominio").required = false;
        document.getElementById("af_aplicaciones").required = false;
        document.getElementById("af_office").required = false;
        document.getElementById("af_antivirus").required = false;
                
    }
});


$(document).ready(function(){
    $('#af_categoria').trigger('change');

    var auxiliarGrupo = 0;
    if($('#auxiliarCategoriaMod').val() != undefined && $('#auxiliarCategoriaMod').val() != null && $('#auxiliarCategoriaMod').val() !=0 && $('#auxiliarCategoriaMod').val() != ''){
        console.log($('#auxiliarCategoriaMod').val());
        auxiliarGrupo = $('#auxiliarCategoriaMod').val();
    }
    
    var data_usuario = 'usuario='+$('#nombre_usu').val()+'&buscar_rol=1';
    $.ajax({
        type: 'POST',
        url: '../controller/control_usuario.php',
        data: data_usuario,
    }).done(function(data){
        if(data == 300){
            $.smkAlert({
                text: 'error de validacion de usuario, esto puede generar errores, Inicie sesion nuevamente.',
                type: 'danger'
            });
        }else if(data==1 || data==6 || data==9){
            $("#af_areaCreacion option[value='Infraestructura']").attr("selected",true);
            $("#af_areaCreacion").attr("disabled",true);
        }else if(data==2){
            $("#af_areaCreacion option[value='Administración']").attr("selected",true);
            $("#af_areaCreacion").attr("disabled",true);
        }

        $('#af_areaCreacion').trigger('change');
        if(auxiliarGrupo != 0){
            $("#af_categoria").val(auxiliarGrupo);
            $('#af_categoria').trigger('change');
        }
    });
})


$('#af_areaCreacion').on('change', function(){
    var areaCreacion = $('#af_areaCreacion').val();
    $("#af_categoria").val('');
    $('#af_categoria').trigger('change');

    

    if(areaCreacion == 'Infraestructura'){
        $('#af_serial').attr('readonly',false);
        $(".administracion").css('display','none');
        $(".infraestructura").css('display','block'); 
    }else if(areaCreacion == 'Administración'){
        $('#af_serial').val('N/A');
        $('#af_serial').attr('readonly',true);
        $(".administracion").css('display','block');
        $(".infraestructura").css('display','none'); 
    }else{
        $(".administracion").css('display','none');
        $(".infraestructura").css('display','none');    
    }

})











