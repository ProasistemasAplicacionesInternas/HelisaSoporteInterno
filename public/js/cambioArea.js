function productoCategoria() {

    var producto = document.getElementById('divProducto');
    var categoria = document.getElementById('divCategoria');
    var categoriaSg = document.getElementById('divCategoriaSg');
    var consultarSoporte = document.getElementById('divPeticion');
    var pCategoria = document.getElementById('pCategoria');
    var pCategoriaSg = document.getElementById('pCategoriaSg');
    var productoMai = document.getElementById('productoMai');
    var soporteMai = document.getElementById('soporteMai');
    var campoOculto = document.getElementById('activoSoporte');
    var area = document.getElementById('areaPeticion').value;

    const selectElement = document.getElementById('areaPeticion');
    const selectedValue = selectElement.value;
    console.log('Valor seleccionado al cargar la página:', selectedValue);

  /* if (divNombre == 2) { console.log("Si sirve"); } */

    if (area == 1) {
        categoria.style.display = "inline";
        pCategoria.required = true;
        consultarSoporte.style.display = "none";
        soporteMai.required = false;

    } else if (area == 2) {
        campoOculto.style.display = 'none';
        document.getElementById("pActivo").required = false;
        producto.style.display = "inline";
        productoMai.required = true;
        consultarSoporte.style.display = "inline";
        soporteMai.required = true;

    } else if (area == 3) {
        categoriaSg.style.display = "inline";
        pCategoriaSg.required = true;
        consultarSoporte.style.display = "none";
    }

}

function imagenRequerida() {
  var tipoPeticion = document.getElementById("soporteMai").value;
  var imagen = document.getElementById("imagen[]");

  if (tipoPeticion == 2) {
    imagen.required = true;
  } else {
    imagen.required = false;
  }
}

function reqData() {
  var requerimiento = document.getElementById("soporteMai").value;
  var divNombre = document.getElementById("divNombre");
  var reqJustification = document.getElementById("reqJustification");

  if (requerimiento == 2) {
    divNombre.style.display = "inline";
    reqJustification.style.display = "inline";
    document.getElementById("reqJustification").required = true;
    document.getElementById("reqName").required = true;
  } else {
    divNombre.style.display = "none";
    reqJustification.style.display = "none";
    document.getElementById("reqJustification").required = false;
    document.getElementById("reqName").required = false;
  }
}

function retrocesoPagina() {
  history.back();
}

window.addEventListener("load", function () {
  productoCategoria();
});
