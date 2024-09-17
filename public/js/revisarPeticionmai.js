function marcarevisado(value){
		data =  value;
        
        var nro_solicitud = '&nro_solicitud='+(value) + '&marcarRevisado=1';
        $.ajax({
	    		type: 'post',
	            url: 'app/controller/controladorPeticionmai.php',
	            data: nro_solicitud
	    	}).done(function(data){
                if(data==1){
                  $('#infosPeticiones').load('app/view/peticionesMai.php');
	    		     $.smkAlert({
                        text: 'La solicitud fue revisada',
                        type: 'warning'
                    });  
                }else{
                    alert("No fue posible marcar como revisado");
                }
	    		
    	});
    }