function check(value){
		data =  value;
        
        var nro_solicitud = '&nro_solicitud='+(value) + '&solicitudLiberada=1';
        $.ajax({
	    		type: 'post',
	            url: 'app/controller/controlador_peticionmai.php',
	            data: nro_solicitud
	    	}).done(function(data){
	    		
	    		$('#infosMai').load('app/view/liberar_solicitudesMai.php');
	    		
    	});
    }