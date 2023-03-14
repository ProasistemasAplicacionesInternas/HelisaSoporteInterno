$(document).ready(function(){
    var tabla = document.getElementById("data");
    var filas = tabla.getElementsByTagName("tr");
  
    for (var i = 0; i < filas.length; i++) {
      var primera_celda = filas[i].getElementsByTagName("td")[0];
      if (primera_celda) {
        var valor_primera_celda = primera_celda.textContent || primera_celda.innerText;
        console.log(valor_primera_celda);
        infoActivo= "activo="+ valor_primera_celda+"&consulta=1";
        console.log(infoActivo);
        (function(fila) {
          $.ajax({
            type: 'POST',
            url: 'app/controller/controlador_traslados.php',
            data: infoActivo
          }).done(function(data) {
            console.log(data);
            if (data == 2) { 
              var nueva_celda = fila.insertCell(-1);
              nueva_celda.classList.add("checkbox-cell");
              nueva_celda.innerHTML = '<input type="checkbox" onclick="checkked(this)" style="vertical-align: middle;"/>';
            }else{
              var nueva_celda = fila.insertCell(-1);
              nueva_celda.innerHTML = '<p>Aceptado</p>';
            }
          });
        })(filas[i]);
      }
    }
  });
  
  function checkked(checkbox) {
    let row = checkbox.closest('tr');
    if (row) { // Agrega esta verificación para evitar errores
      let codigo = row.querySelector('td:first-child').innerText;
      let nombre = row.querySelector('td:nth-child(3)').innerText;
      let infoActivo = 'activo=' + codigo + '&nombre=' + nombre + '&aceptaActivo=1';
      $.ajax({
        type: 'POST',
        url: 'app/controller/controlador_traslados.php',
        data: infoActivo
      }).done(function(data) {
        console.log(data)
        if (data == 1) {
          $.smkAlert({
            text: 'Se acepto el activo fijo',
            type: 'success'
          });
          setTimeout(() => {
            location.reload()
          }, 5000); 
        } else {
          $.smkAlert({
            text: 'Se presento un problema',
            type: 'danger'
          });
        }
      });
    }
  }