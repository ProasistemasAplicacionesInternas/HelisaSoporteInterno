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
            var yearUvt = document.getElementById("yearUvt").value = data.year_uvt;
            var yearUvt = document.getElementById("valueUvt").value = data.value_uvt;
        },
        error: function (error) {
          console.log("Error en la solicitud AJAX:", error);
        },
      });
}


function abrirModal() {
  document.getElementById("modal").style.display = "block";
}

function cerrarModal() {
  document.getElementById("modal").style.display = "none";
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
