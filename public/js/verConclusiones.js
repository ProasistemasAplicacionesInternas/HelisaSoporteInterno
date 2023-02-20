function verConclusiones(id_peticion){

        var verConclusion ='peticion1=' + id_peticion + '&verConclusion=1';
    $.ajax({
        type: 'POST',
        url: '../controller/control_comentarios.php',
        data: verConclusion

    }).done(function(data){
        
        //ARRAY QUE VIENE DESDE EL CONTROLADOR COMO STRING, ACA LO VAMOS A CONVERTIR EN UN ARRAY
        arrPrin = data.split("/,/");
        arrPrin.pop(); 
     

        arrPrin.forEach(element => {
            arrSec = element.split("/-/");
            

            var id_observacion = arrSec[0];
            var id_ticket = arrSec[1];
            var fecha = arrSec[2];
            var usuario_creacion = arrSec[3];
            var descripcion_observacion = arrSec[4];

            htmlCadena = 

            `<tr style="width:100%"> 
            <td>${id_observacion}</td>
            <td>${id_ticket}</td>
            <td>${fecha}</td>
            <td>${usuario_creacion}</td>
            <td style="max-width:200px; padding:20px; height:20px;">${descripcion_observacion}</td>
            </tr>`;
            $(document).ready(function(){
                $("button").click(function(){
                $("#js").empty();
                });
            });
            $('#js').append(htmlCadena);
            
        });
    });
}