$('#restablecer-cuenta').click(function(){
       
		var datosClave = 'contrasena='+$('#contrasena').val()+
		'&usuario='+$('#usuario').val()+				
		'&validar_contrasena=1';

		$.ajax({
			type: 'POST',
			url: '../controller/modifica_usuario.php',
			data: datosClave

		}).done(function(data){
			console.log(datosClave);
			console.log(data);
			if (data==1){
			window.location="../../login.php";			
			}else if (data == 2) {
			location.reload();
			}else{
				$.smkAlert({
					text: 'error',
					type: 'danger'
				});
			}
		});
});