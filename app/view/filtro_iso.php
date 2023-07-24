<?php
ini_set("session.cookie_lifetime", "18000");
ini_set("session.gc_maxlifetime", "18000");

session_start();

if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {

    header('location:../../login.php');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h6>Elija el criterio para la consulta de ISO</h6>
            </div>
        </div>
        <div class="col-3">
            <select class="custom-select" name="criterio" id="criterio">
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Consultar por fecha</option>
                <option value="2">Consultar por Peticion</option>
            </select>
        </div>
        <div class="row mt-3" id="selectorFecha">
            <div class="col-12">
                <h6>Seleccione el rango de fechas para generar la consulta</h6>
            </div>
            <div class="col-3">
                <form action="app/view/peticiones_iso.php" method="post" onsubmit="rango()" target="_blank">
                    <div class="form-group">
                        <input type="text" id="fechaFiltro" name="fechaFiltro" class="form-control" placeholder="Seleccione la fecha" required autocomplete="off">
                    </div>
                    <input type="hidden" id="fechaInicial" name="fechaInicial">
                    <input type="hidden" id="fechaFinal" name="fechaFinal">
                    <input type="submit" id="btn-consultarFechaI" name="btn-consultarFechaI" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
        <div class="row" id="selectorTicket">
            <div class="col-12">
                <h6>Número de Peticion</h6>
            </div>
            <div class="col-3">
                <form action="app/view/peticiones_iso.php" target="_blank" method="post">
                    <div class="form-group">
                        <input type="hidden" id="usuario_actual" name="usuario_actual" value="<?php echo $_SESSION['usuario']; ?>">
                        <input type="text" id="peticionFiltro" name="peticionFiltro" class="form-control" placeholder="Numero de Peticion" required autocomplete="off">
                    </div>
                    <input type="submit" id="btn-consultarTicketI" name="btn-consultarTicketI" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
    </div>
    <script src="public/js/iso.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>