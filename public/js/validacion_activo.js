$('#crear_activoFijo').click(function(){
	if( $('#formulario').smkValidate()) {
		var datosActivo = 'af_codigo='+$('#af_codigo').val()+
		'&af_serial='+$('#af_serial').val()+
		'&af_marca='+$('#af_marca').val()+
		'&af_modelo='+$('#af_modelo').val()+
		'&af_nombre='+$('#af_nombre').val()+
		'&af_areaCreacion='+$('#af_areaCreacion').val()+
		'&af_fechaCompra='+$('#af_fechaCompra').val()+
		'&af_categoria='+$('#af_categoria').val()+
		'&af_estado='+$('#af_estado').val()+
		'&af_area='+$('#af_area').val()+
		'&af_ubicacion='+$('#af_ubicacion').val()+
		'&af_responsable='+$('#af_responsable').val()+
		'&af_fechaAsignacion='+$('#af_fechaAsignacion').val()+
		'&af_ram='+$('#af_ram').val()+
		'&af_discoDuro='+$('#af_discoDuro').val()+
		'&af_procesador='+$('#af_procesador').val()+
		'&af_so='+$('#af_so').val()+
		'&af_licenciaSo='+$('#af_licenciaSo').val()+
		'&af_dominio='+$('#af_dominio').val()+
		'&af_aplicaciones='+$('#af_aplicaciones').val()+
		'&af_office='+$('#af_office').val()+
		'&af_antivirus='+$('#af_antivirus').val()+
		'&af_observaciones='+$('#af_observaciones').val()+
		'&nombre_usu='+$('#nombre_usu').val()+
		'&crear=1';

		$.ajax({
			type: 'POST',
			url: '../controller/controlador_activosFijos.php',
			data: datosActivo
		}).done(function(data){
			if (data==1){
				$.smkAlert({
					text: 'Activo Creado Con Exito',
					type: 'success'
				});
				setTimeout(function(){ location.reload();; }, 800);
			}else if (data == 3) {
				$.smkAlert({
					text: 'El codigo o serial ya estan asignados a otro activo',
					type: 'warning'
				});
			}else{
				$.smkAlert({
					text: 'error',
					type: 'danger'
				});
			}
		});

	}
});