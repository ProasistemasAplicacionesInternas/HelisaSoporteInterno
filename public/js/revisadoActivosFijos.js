function checkked(checkbox) {
    let row = checkbox.closest('tr');
    let codigo = row.querySelector('td:first-child').innerText;
    var nombre = row.querySelector('td:nth-child(4)').innerText;
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
  