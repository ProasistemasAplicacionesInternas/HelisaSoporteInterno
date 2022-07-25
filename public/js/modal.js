$(function() {
        var popupTriggers = $('[data-popup-open]');

    popupTriggers.on('click', function(e)  {
        var targeted_popup_class = $(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').toggle(350);

        e.preventDefault();
    });

    popupTriggers.each(function(){
        var targeted_popup_class = $(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
    });

    $('[data-popup-close]').on('click', function(e) {
    
        if ($('#form-valida').smkValidate()) {
        	
        	var infoAcceso = "usuarios=" + $('#usuarios').val() +       
        '&claves=' + $('#claves').val() +       
        '&modificaAcceso=1' ;
          console.log(infoAcceso);
            $.ajax({
                type: 'POST',
                url: '../../app/controller/control_usuario.php',
                data: infoAcceso

            }).done(function (data) {

                if (data == 1) {

                        $.smkAlert({
                        text: 'Inicio de sesión correcto',
                        type: 'success'
                    });
		$('[data-popup').fadeOut(350);

		e.preventDefault();
                    
                } else if(data == 2){

                	 window.location='../../login.php';

                }  else {
                	
                    $.smkAlert({
                        text: 'Usuario o contraseña incorrectos',
                        type: 'danger'
                    });
                }
            });
        }

  

		
	});
});