/************* Consulta Inicial **************/
$(document).ready(function () {
  consultUvtAll();
});

function consultUvtAll() {
  var dataUvt = "actionsCategoriesAssets=consultAll";

  $.ajax({
    type: "POST",
    url: "app/controller/controllerCategoryAssets.php",
    data: dataUvt,
    success: function (response) {
      var parsedResponse = JSON.parse(response);

      var table = '<table class="table table-bordered table-auto">';
      table +=
        "<thead><tr class='custom-font'><th>Año UVT</th><th>Valor UVT</th><th>Acciones</th></tr></thead>";
      table += "<tbody>";

      for (var i = 0; i < parsedResponse.length; i++) {
        table += "<tr>";
        table +=
          "<td class='custom-font'>" + parsedResponse[i].year_uvt + "</td>";
        table +=
          "<td class='custom-font editable' contenteditable='true' data-id='" +
          parsedResponse[i].year_uvt +
          "'>" +
          parsedResponse[i].value_uvt +
          "</td>";
        table +=
          "<td><button class='btn btn-primary' onclick='actualizarUvt(" +
          parsedResponse[i].year_uvt +
          ")'>Actualizar</button></td>";
        table += "</tr>";
      }

      table += "</tbody></table>";

      $("#tablaResultados").html(table);

      $(".editable").dblclick(function () {
        $(this).attr("contenteditable", "true").focus();
      });
    },
    error: function (error) {
      console.error("Error en la solicitud:", error);
    },
  });
}

function formatNumberWithPoints(number) {
  return number.toLocaleString();
}
/************* Fin consulta Inicial**************/

/************* Editar Uvt ***************/
function actualizarUvt(yearUvt) {
  var nuevoValor = $("td[data-id='" + yearUvt + "']").text();

  $.ajax({
    type: "POST",
    url: "app/controller/controllerCategoryAssets.php",
    data: {
      actionsCategoriesAssets: "update",
      yearUvt: yearUvt,
      valueUvt: nuevoValor,
    },
    success: function (response) {
      consultUvtAll();
      $.smkAlert({
        text: "Modificación Exitosa!",
        type: "success",
      });
    },
    error: function (error) {
      console.error("Error en la solicitud de actualización:", error);
    },
  });
}
/************* Fin Editar Uvt ***************/

/****** Crear UVT ******/
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
          consultUvtAll();
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
  errorElement.style.color = "red";
}

function limpiarError(elemento) {
  var errorElement = elemento.nextElementSibling;
  if (errorElement !== null) {
    console.log("errorElement", errorElement);
    errorElement.innerHTML = "";
    elemento.classList.remove("error-field");
  }
}

function limpiarFormulario() {
  var campos = document.querySelectorAll("#formsUvts [required]");
  campos.forEach(function (campo) {
    campo.value = "";
    campo.classList.remove("error-field");
    var errorElement = campo.nextElementSibling;
    if (errorElement && errorElement.classList.contains("error-message")) {
      errorElement.innerHTML = "";
    }
  });
}
/************** Fin Crear Uvts ********************/
