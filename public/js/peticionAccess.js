/* peticciones_accceso */
function revisado(value){
    peticion =  value;
    var data = 'id_peticion='+ peticion + '&modificarRevisado=1';
    $.ajax({
        type: 'post',
        url: 'app/controller/controlador_peticionesAccesos.php',
        data: data
    }).done(function(data){
        if(data==1){
            $('#contenido').load('app/view/peticiones_accesos.php');
            $.smkAlert({
                text: 'La solicitud fue revisada',
                type: 'success'
            });  
        }else{
            $.smkAlert({
                text: 'No fue posible marcar como revisado',
                type: 'warning'
            });  
        }
                
    });
}