$(document).ready(function(){
    let group = $('#m_grupoActivo').val()
    if(group == 3 ){
        $('#repoweringButton').show()
    }else if(group == 1){
        $('#repoweringButton').show()
    }else if(group == 13){
        $('#repoweringButton').show()
    }else if(group == 14){
        $('#repoweringButton').show()
    }else{
        $('#repoweringButton').hide()
    }

})


$('#repotentiationSelect').on('change',function(){
    let status = $('#repotentiationSelect').val();
    if (status== "No"){
        console.log("uno")
        $('#datos_adicionales').hide()
    }else if (status=="Si"){
        $('#datos_adicionales').show()
    }
    
})
