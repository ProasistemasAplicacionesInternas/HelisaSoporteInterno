$("#saveYear").click(function () {
  var campos = document.querySelectorAll("#formsUvts [required]");

  if (fieldValidated(campos)) {
    var dataUvt =
      "yearUvt=" +
      $("#yearUvt").val() +
      "&valueUvt=" +
      $("#valueUvt").val() +
      "&actionsCategoriesAssets=create";
    $.ajax({
      type: "POST",
      url: "app/controller/controllerCategoryAssets.php",
      data: dataUvt,
    }).done(function (data) {
      switch (data) {
        case "1":
            limpiarFormulario();
          $.smkAlert({
            text: "Almacenado de Manera Exitosa!",
            type: "success",
          });
          break;
        case "2":
          $.smkAlert({
            text: "Ocurrio Un problema!",
            type: "danger",
          });
          break;
        case "3":
          $.smkAlert({
            text: "El año ya se encuentra Definido!",
            type: "warning",
          });
          break;
        default:
          break;
      }
    });
  }
});

function fieldValidated(fields) {
  for (var i = 0; i < fields.length; i++) {
    var field = fields[i];

    if (field.value.trim() === "" || field.length < 4) {
      mostrarError(field, "Este campo es obligatorio.");
      return false;
    }

    if (field.value.trim().length < 4) {
        mostrarError(field, "Al menos 4 dígitos.");
        return false;
      }
    
    limpiarError(field);
  }
  return true;
}

function mostrarError(elemento, mensaje) {
  var errorElement = elemento.nextElementSibling;
  if (!errorElement || !errorElement.classList.contains("error-message")) {
    errorElement = document.createElement("span");
    errorElement.className = "error-message";
    elemento.parentNode.insertBefore(errorElement, elemento.nextSibling);
  }
  errorElement.innerHTML = mensaje;
  errorElement.style.color = 'red';
}

function limpiarError(elemento){
    var errorElement = elemento.nextElementSibling;
    errorElement.innerHTML = ''; 
    elemento.classList.remove('error-field');
}

function limpiarFormulario() {
    var campos = document.querySelectorAll('#formsUvts [required]');
    campos.forEach(function(campo) {
        campo.value = '';
        campo.classList.remove('error-field');
        var errorElement = campo.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.innerHTML = '';
        }
    });
}
