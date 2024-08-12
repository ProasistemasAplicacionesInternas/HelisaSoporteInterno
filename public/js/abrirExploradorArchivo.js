function abrirExploradorArchivo(archivo, ticketId, columnaArchivo) {
    const archivoInput = document.getElementById(`archivoInput_${archivo}`);

    archivoInput.click();

    archivoInput.onchange = function() {
        const formData = new FormData();
        formData.append('archivo', archivo);
        formData.append('ticket_id', ticketId);
        formData.append('columna_archivo', columnaArchivo);
        formData.append('nuevoArchivo', archivoInput.files[0]);

        console.log(archivo, ticketId, columnaArchivo, archivoInput.files[0]);

        fetch('../controller/replaceDocument.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    console.log(data);
                    if (data.success) {
                        alert('Archivo reemplazado exitosamente.');
                        location.reload();
                    } else {
                        alert('Error al reemplazar el archivo: ' + data.message);
                    }
                } catch (error) {
                    console.error('ERROR. Respuesta no es JSON válida:', text);
                    alert('Ocurrió un error al intentar reemplazar el archivo.');
                }
            })
            .catch(error => {
                console.error('ERROR. Al reemplazar el archivo:', error);
                alert('Ocurrió un error al intentar reemplazar el archivo.');
            });
    };
}