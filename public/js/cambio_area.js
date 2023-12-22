function productoCategoria(){
		var area = document.getElementById('area_peticion').value;
        var producto = document.getElementById('divProducto');
        var categoria = document.getElementById('divCategoria');
        var consultar_soporte = document.getElementById('divPeticion');
        var p_categoria = document.getElementById('p_categoria');
        var productoMai = document.getElementById('productoMai');
        var soporteMai = document.getElementById('soporteMai');
        var campoOculto = document.getElementById('activoSoporte');
        
       
        
        if(divNombre==2){console.log("Si sirve");}
    
        if(area==1){
            producto.style.display = "none";
            productoMai.required = false;
            categoria.style.display = "inline";
            p_categoria.required = true;
            consultar_soporte.style.display = "none";
            soporteMai.required = false;
            
        }else if(area==2){
            campoOculto.style.display = 'none';
            document.getElementById("p_activo").required = false;
            categoria.style.display = "none";
            p_categoria.required = false
            producto.style.display = "inline";
            productoMai.required = true;
            consultar_soporte.style.display = "inline";
            soporteMai.required = true;
          
        }else{
            categoria.style.display = "none";
            p_categoria.required = false;
            producto.style.display = "none";
            productoMai.required = false;
            consultar_soporte.style.display = "none";
            soporteMai.required = false;
           
            $.smkAlert({
                        text: 'Seleccione el área a la cual va dirigida la petición',
                        type: 'warning'
        });
        }
        
    }

    function imagenRequerida(){
        var tipoPeticion = document.getElementById('soporteMai').value;
        var imagen = document.getElementById('imagen[]');
        
        
        if (tipoPeticion == 2){
            imagen.required = true; 
            
        }else{
            imagen.required = false;
        }
        }
    function reqData(){
        var requerimiento = document.getElementById('soporteMai').value;
        var divNombre = document.getElementById('divNombre');
        var reqJustification = document.getElementById('reqJustification')

        if(requerimiento==2){
            divNombre.style.display= "inline";
            reqJustification.style.display= "inline";
            document.getElementById("req_Justification").required = true;
            document.getElementById("req_Name").required = true;
        }else{
            divNombre.style.display= "none";
            reqJustification.style.display= "none";
            document.getElementById("req_Justification").required = false;
            document.getElementById("req_Name").required = false;
        }
    }
   function retrocesoPagina(){
        history.back()
   }

    

    