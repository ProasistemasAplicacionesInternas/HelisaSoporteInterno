function marcarevisado(value){
		data =  value;
        
        var nroSolicitud = '&nro_solicitud='+(value) + '&marcarRevisado=1';
        $.ajax({
	    		type: 'post',
	            url: 'app/controller/controlador_peticion.php',
	            data: nroSolicitud
	    	}).done(function(data){
                if(data==1){
                  $('#infoPeticionFuncionario').load('app/view/peticionFuncionario.php');
	    		     $.smkAlert({
                        text: 'La solicitud fue revisada',
                        type: 'warning'
                    });  
                }else{
                    alert("No fue posible marcar como revisado");
                }
	    		
    	});
    }