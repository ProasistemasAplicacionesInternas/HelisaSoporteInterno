function verConclusionesSg(id_peticion) {
  var verConclusion = "peticion1=" + id_peticion + "&verConclusion=1";
  $.ajax({
    type: "POST",
    url: "../controller/controlComentariosSg.php",
    data: verConclusion,
  }).done(function (data) {
    if (data.includes("Error") || data.includes("No se encontraron registros")) {
      console.error(data);
      alert(data);
    } else {
      arrPrin = data.split("/,/");
      arrPrin.pop();

      $("#js").empty();

      arrPrin.forEach((element) => {
        arrSec = element.split("/-/");

        var id_observacion = arrSec[0];
        var id_ticket = arrSec[1];
        var fecha = arrSec[2];
        var usuario_creacion = arrSec[3];
        var descripcion_observacion = arrSec[4];

        var htmlCadena = `<tr style="width:100%"> 
                  <td>${id_observacion}</td>
                  <td>${id_ticket}</td>
                  <td>${fecha}</td>
                  <td>${usuario_creacion}</td>
                  <td style="max-width:200px; padding:20px; height:20px;">${descripcion_observacion}</td>
              </tr>`;

        $("#js").append(htmlCadena);
      });

      $('#verConclusionSg').modal('show');
    }
  }).fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Error en la solicitud: ", textStatus, errorThrown);
    alert("Hubo un problema al intentar recuperar las conclusiones. Por favor, intente nuevamente.");
  });
}

function mostrarDocumentos(ticketId) {
  $.ajax({
    type: "POST",
    url: "../controller/controlComentariosSg.php",
    data: { peticion1: ticketId, verDocumentos: 1 },
    success: function (response) {
      var archivos = JSON.parse(response);
      var listaDocumentos = $("#listaDocumentos");
      var ticketCodigo = $("#ticketCodigo");

      listaDocumentos.empty();
      ticketCodigo.text(ticketId);

      if (archivos.length > 0) {
        archivos.forEach(function (archivo) {
          var filePath = "../../documentSg/" + archivo;
          var html = `<li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span>${archivo}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="${filePath}" target="_blank" class="ml-3">Ver Documento</a>
                                </div>
                            </li>`;
          listaDocumentos.append(html);
        });
      } else {
        listaDocumentos.append("<p>No se ha subido ningún archivo relacionado con este ticket.</p>");
      }
    },
    error: function () {
      alert("Hubo un problema al intentar recuperar los documentos. Por favor, intente nuevamente.");
    }
  });
}

