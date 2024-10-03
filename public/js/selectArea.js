
    let userRole = document.getElementById('area').getAttribute('data-role');

    document.getElementById('area').addEventListener('change', function() {
        let selectedValue = this.value;
        let optionsSelect = document.getElementById('criterio');

        optionsSelect.innerHTML = '<option value="" selected>Seleccione una opción</option>';

        if (selectedValue === '1') {
            if (userRole == 1) {
                optionsSelect.innerHTML += '<option value="1">Consultar por fecha</option>';
                optionsSelect.innerHTML += '<option value="3">Consultar por Peticion</option>';
            } else if (userRole == 5) {
                optionsSelect.innerHTML += '<option value="1">Consultar por fecha</option>';
                optionsSelect.innerHTML += '<option value="3">Consultar por Peticion</option>';
            } else {
                optionsSelect.innerHTML += '<option value="1">Consultar por fecha</option>';
                optionsSelect.innerHTML += '<option value="3">Consultar por Peticion</option>';
            }
        } else if (selectedValue === '2') {
            if (userRole == 1) {
                optionsSelect.innerHTML += '<option value="1">Consultar por fecha</option>';
                optionsSelect.innerHTML += '<option value="3">Consultar por Peticion</option>';
                optionsSelect.innerHTML += '<option value="4">Consultar por Programador</option>';
            } else if (userRole == 5) {
                optionsSelect.innerHTML += '<option value="1">Consultar por fecha</option>';
                optionsSelect.innerHTML += '<option value="3">Consultar por Peticion</option>';
                optionsSelect.innerHTML += '<option value="4">Consultar por Programador</option>';
            } else {
                optionsSelect.innerHTML += '<option value="1">Consultar por fecha</option>';
                optionsSelect.innerHTML += '<option value="3">Consultar por Peticion</option>';
            }
        }
    });

