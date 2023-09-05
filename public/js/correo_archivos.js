$(document).on("change", 'input[type="file"]', function () {
  var arreglo = this.files;
  console.log(arreglo);
  if (arreglo.length > 1) {
    $.smkAlert({
      text:
        "Solo puede subir un archivo, usted esta subiendo: " + arreglo.length,
      type: "danger",
    });
    this.value = "";
    return "error";
  } else {
    var fileSize = this.size;
    var y = arreglo[0].size;
    console.log(y);
    if (arreglo[0].size > 4000000) {
      $.smkAlert({
        text: "El archivo pesa: " + y + "kb y solo se soporta 4000kb (4mb)",
        type: "danger",
      });
      this.value = "";
      return "error";
    }
  }
});

$(document).ready(function () {
  $("#imagenDiv").css("display", "none");
});

$("#p_estado").on("change", function () {
  if ($("#p_estado").val() == 2) {
    $("#imagenDiv").css("display", "inline");
  } else {
    $("#imagenDiv").css("display", "none");
  }
});
