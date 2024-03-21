$(document).ready(function () {
  lastUvtYear();
});

function lastUvtYear() {
  $.ajax({
    url: "../controller/controllerUvts.php",
    type: "POST",
    data: { actionsUvts: "lastYear" },
    dataType: "json",
    success: function (data) {
      var yearUvt = (document.getElementById("yearUvt").value = data.year_uvt);
      var yearUvt = (document.getElementById("valueUvt").value =
        data.value_uvt);
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX:", error);
    },
  });
}

function abrirModal(id) {
  $("#obsModal").modal("show");
  peticionAjaxMaintenance(id);
}

function peticionAjaxMaintenance(id) {
  $.ajax({
    url: "../controller/controlador_mantenimientos.php",
    type: "POST",
    dataType: "json",
    data: {
      actionsMaintenance: "findByIdAsset",
      asset: id,
    },
    success: function (response) {
      drawInfoMaintenances(response);
    },
    error: function (error) {
      console.log("Error en la solicitud AJAX de actualización:", error);
    },
  });
}

function drawInfoMaintenances(data) {
  var resultadosContainer = document.getElementById("contentObsertations");
  resultadosContainer.innerHTML = "";
  $.each(data, function (index, maintenance) {
    var textarea = $("<textarea>", {
      class: "form-control",
      id: "exampleFormControlTextarea1",
      rows: 3,
      text: maintenance.descripcion_mantenimiento,
      disabled: true
    });
    var html =
      '<div id="block_maintenance">' +
      '<div class="row">' +
      '<div class="col-3">' +
      '<div class="form-group">' +
      '<label for="fecha_mantenimiento">Fecha</label>' +
      '<span class="form-control">' + maintenance.fecha_mantenimiento + '</span>' +
      "</div>" +
      "</div>" +
      '<div class="col-5">' +
      '<div class="form-group">' +
      '<label for="responsable_mantenimiento">Responsable</label>' +
      '<span class="form-control">' + maintenance.responsable_mantenimiento + '</span>' +
      "</div>" +
      "</div>" +
      '<div class="col-3">' +
      '<div class="form-group">' +
      '<label for="costo_mantenimiento">Costo</label>' +
      '<span class="form-control">' + maintenance.costo_mantenimiento + '</span>' +
      "</div>" +
      "</div>" +
      "</div>" +
      "<div class='row'>" +
      '<div class="col-2">' +
      '<div class="form-group">' +
      '<label for="mejora_mantenimiento">Mejora?</label>' +
      '<span class="form-control">' + maintenance.mejora + '</span>' +
      "</div>" +
      "</div>" +
      '<div class="col-2">' +
      '<div class="form-group">' +
      '<label for="repotenciacion_mantenimiento">Repotenciación?</label>' +
      '<span class="form-control">' + maintenance.repotenciacion + '</span>' +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="row">' +
      '<div class="col-12">' +
      '<div class="form-group">' +
      '<label for="exampleFormControlTextarea1">Descripción</label>' +
      textarea.prop("outerHTML") +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "<hr class='lineas'>";
    resultadosContainer.innerHTML += html;
  });
}

function cerrarObservaciones() {
  document.getElementById("observacionesAnt").style.display = "none";
}

function calcularTipoActivo() {
  var costoCompra = document.getElementById("costoCompra").value;

  // Convierto el valor a un número
  costoCompra = parseFloat(costoCompra.replace(".", "."));

  // Verificar si es un número válido
  if (!isNaN(costoCompra)) {
    // Realizo la division por el uvt, en este caso 47065
    var valorUvt = $("#valueUvt").val();
    console.log(valorUvt);
    var resultado = costoCompra / valorUvt;

    // aquí determino el rango de los uvts
    var descripcion = "";
    if (resultado >= 0 && resultado <= 10.5) {
      descripcion = "Activos controlados de menor valor";
    } else if (resultado >= 10.6 && resultado <= 50) {
      descripcion = "Activos fijos controlados de menor cuantía";
    } else if (resultado > 50) {
      descripcion = "Activos fijos de mayor cuantía";
    }

    // Muestro el resultado en el campo "tipoAct" que es el tipo de activo
    document.getElementById("tipoAct").value = descripcion;
  } else {
    // Se mostrara este mensaje de error si no digitan números si no palabras
    document.getElementById("tipoAct").value = "Solo se aceptan numeros";
  }
}
