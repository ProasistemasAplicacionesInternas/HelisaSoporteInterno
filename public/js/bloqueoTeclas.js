//Anular tecla f12
$(document).keydown(function (event) {

    var script = (event.keyCode ==83 && event.keyCode == 67 && event.keyCode == 82 && 
        event.keyCode == 73 && event.keyCode == 80 && event.keyCode == 84);
    //FUNCIONAN
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I     
        return false;
    }  if (event.ctrlKey && event.shiftKey && event.keyCode == 74) { // Prevent Ctrl+Shift+j    
        return false;
    } if (event.ctrlKey && event.keyCode === 85){ // Prevent Ctrl+Shift+U
        console.log('EVENTO 123467');
        return false;
    }  if (event.ctrlKey && event.keyCode == 86){ // Prevent Ctrl + v
        return false;
    }  if (event.shiftKey && event.keyCode == 226){ // '>' signos para bloquear scripts
        return false;
    }  if (event.keyCode == 226){ // '<' signos para bloquear scripts
        return false;
    } 
    if(event.keyCode == 91 && event.keyCode == 86 ){ // Windows + V
        return false;
    } if (event.shiftKey && event.keyCode == 188){// bloquear ';'
        return false;
    }
    //NO FUNCIONA AÚN
    if(event.keyCode == 18 && event.keyCode == 102 && event.keyCode == 98){
        return '';
    }  
    /* console.clear();
    console.log(event.altKey);
    console.log(event.keyCode == 102);
    console.log(event.keyCode == 98 || event.keyCode == 96);
    console.log(event.keyCode == 50 || event.keyCode == 54); */
    
});
//Anular click derecho
	document.oncontextmenu = function(){
    return false}



    
