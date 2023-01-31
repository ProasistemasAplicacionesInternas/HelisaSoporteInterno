$(document).ready(function(){
    let req_name = document.getElementById('req_nombre').value;
    let req_justificacion = document.getElementById('req_justificacion').value;
    let div_name = document.getElementById('div_nombre');
    let div_justificacion = document.getElementById('div_justificacion');
    console.log(req_name);

    if (req_name && req_justificacion == "" ) {
        div_name.style.display= "none";
        div_justificacion.style.display= "none";
    }else{
        div_name.style.display="inline";
        div_justificacion.style.display="inline";
    }
    
})