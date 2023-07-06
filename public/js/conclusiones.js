var conclusionesCargadas = [];

function toggleConclusiones(id) {
    var conclusionesRow = document.getElementById('conclusiones_' + id);
    if (conclusionesRow.style.display === 'none') {
        conclusionesRow.style.display = 'block';

        if (!conclusionesCargadas.includes(id)) {
            conclusionesCargadas.push(id);

            $.ajax({
                url: '../../app/controller/control_consulta_peticionesmai.php',
                type: 'POST',
                data: {
                    id_peticionmai: id
                },
                success: function(response) {
                    var conclusionesAnteriores = JSON.parse(response);
                    var conclusionesDiv = document.getElementById('conclusiones_' + id);
                    conclusionesDiv.innerHTML = ''; // Limpiar el contenido existente

                    for (var i = 0; i < conclusionesAnteriores.length; i++) {
                        var conclusion = conclusionesAnteriores[i];
                        var paragraph = document.createElement('p');
                        paragraph.textContent = conclusion;
                        conclusionesDiv.appendChild(paragraph);
                    }
                }
            });
        }
    } else {
        conclusionesRow.style.display = 'none';
    }
}
