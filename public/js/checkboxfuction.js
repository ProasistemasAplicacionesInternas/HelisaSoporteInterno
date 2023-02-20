$(document).ready(function(){
    let estado = document.getElementById('estado_maquina').value;
    if (estado == 5) {
        document.getElementById('switch-label').checked = true ;
    }else{
        document.getElementById('switch-label').checked = false ;
    }
    
})
$("#switch-label").change(function() {
    let estado = document.getElementById('estado_maquina').value;
    if (estado == 5) {
        document.getElementById('estado_maquina').value = 6;
        console.log("Valor 5")
    }else{
        document.getElementById('estado_maquina').value = 5;
        console.log("Valor 6")
    }
})