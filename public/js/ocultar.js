function mostrarCampo() {
    var seleccion = document.getElementById("mejora").value;
    var campoMejora = document.getElementById("campoMejora");

    if (seleccion === "Si") {
        campoMejora.style.display = "block";
    } else {
        campoMejora.style.display = "none";
    }
}
