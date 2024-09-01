$(document).ready(function() {
    $('table.display').DataTable();
} );


/* Navega dentro del peticiones Acceso */
function redireccionar(redireccion){
    switch(redireccion){
        case 1: $("#contenido").load("app/view/peticiones_accesos.php");break;
        case 2: $("#contenido").load("app/view/peticiones_accesosDelegados.php");break;
        case 3: $("#contenido").load("app/view/peticiones_accesosPlataformas.php");break;
        case 4: $("#contenido").load("app/view/peticiones_accesosConsulta.php");break;
    }

}






/* Peticiones_accesosDelegados */
function revicionEstado(id_peticion){
    var data = "preSeleccionar=1&id_peticion=" + id_peticion;
    $.ajax({
        type:'POST',
        url:'app/controller/controlador_peticionesAccesos.php',
        data:data
    }).done(function(respuesta){
        if(respuesta == 0){
            $.smkAlert({
                text: 'Error Interno.',
                type: 'danger'
            }); 
            redireccionar(2);
        }else if(respuesta == 8 || respuesta == 2){
            $.smkAlert({
                text: 'Un usuario a tomado la peticion antes que Tu.',
                type: 'warning'
            }); 
            redireccionar(2);
        }else{
            $('#seleccionar' + id_peticion).click();
        }
    })
}

function liberarPeticion(id_peticion){
    var data = 'liberarPeticion=1&id_peticion=' + id_peticion;
   $.ajax({
        type:'POST',
       url:'app/controller/controlador_peticionesAccesos.php',
       data:data
    }).done(function(respuesta){
        if(respuesta == 2){
            $.smkAlert({
            text: 'El ticket Cambio su estado antes de Poder liberarse.',
            type: 'warning'
            }); 
            redireccionar(2);
        }else if(respuesta == 1){
            redireccionar(2)
        }else{
            $.smkAlert({
            text: 'Error Interno.',
            type: 'danger'
            }); 
            redireccionar(2);
        }
   })
}



 