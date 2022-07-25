var descripcionOculta = document.getElementById('descripcionActiva_Div');

$('#f_estado').on('change',function(){

    if(this.value == 5){
        descripcionOculta.style.display = 'block';
        document.getElementById('descripcionActiva').required = true;
    }else{
        descripcionOculta.style.display = 'none';
        document.getElementById('descripcionActiva').required = false;
    }
    
});

$('#f_estado').trigger('change');
