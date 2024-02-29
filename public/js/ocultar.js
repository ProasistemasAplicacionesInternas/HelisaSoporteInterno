//<script>
function mostrarCampo() {
    var seleccion = document.getElementById("Mejora").value;
    var campoMejora = document.getElementById("campoMejora");

    if (seleccion === "Sii") {
        campoMejora.style.display = "block";
    } else {
        campoMejora.style.display = "none";
    }
}
//</script>