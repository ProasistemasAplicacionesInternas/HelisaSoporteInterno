var campoOculto = document.getElementById('activoSoporte');

var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#p_categoria').on('change', function () {
    if (this.value == 16 ) {
        campoOculto.style.display='inline';
        document.getElementById("p_activo").required = true;
    }
    else{
        campoOculto.style.display = 'none';
        document.getElementById("p_activo").required = false;
    }
});

$('#p_categoria').trigger('change');