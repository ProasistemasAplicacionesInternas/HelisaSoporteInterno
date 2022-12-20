$(document).ready(function(){
    let group = $('#m_grupoActivo').val()
    if(group == 3 ){
        $('#repoweringButton').show()
    }else if(group == 1){
        $('#repoweringButton').show()
    }else if(group == 13){
        $('#repoweringButton').show()
    }else{
        $('#repoweringButton').hide()
    }

})


$('#repotentiationSelect').on('change',function(){
    let status = $('#repotentiationSelect').val();
    if (status== 1){
        console.log("uno")
        $('#datos_adicionales').hide()
    }else if (status==2){
        $('#datos_adicionales').show()
    }
    
})
