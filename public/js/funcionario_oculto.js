var campoOculto = document.getElementById('encargado');
var campos = document.getElementsByClassName('ocultar');
var casillas = document.getElementsByClassName('requerido');
$('#af_estado').on('change', function () {
    if (this.value == 14 ) {
        campoOculto.style.display='inline';
        document.getElementById("af_responsable").required = true;
        document.getElementById("af_fechaAsignacion").required = true;
    }
    else{
        campoOculto.style.display = 'none';
        document.getElementById("af_responsable").required = false;
        document.getElementById("af_fechaAsignacion").required = false;
        document.getElementById("af_responsable").value = null;
        document.getElementById("af_fechaAsignacion").value = null;
        
    }
});
$('#af_estado').trigger('change');