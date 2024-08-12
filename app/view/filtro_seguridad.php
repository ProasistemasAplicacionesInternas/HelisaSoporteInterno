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
                <h6>Elija el criterio para la consulta</h6>
            </div>
        </div>
        <div class="col-3">
            <select class="custom-select" name="criterioSg" id="criterioSg">
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Consultar por categoria</option>
                <option value="2">Consultar por estado</option>
                <option value="3">consultar por Nro de ticket</option>
            </select>
        </div>
            <form action="app/view/solicitudFinalizadoSg.php" method="POST">
                <div class="row mt-3" id="selectorCategoriaSg">
                    <div class="col-12">
                        <h6>Seleccione una categoria para realizar la consulta</h6>
                    </div>
                    <div class="col-3">
                        <select class="custom-select" name="estadoFiltroCategoria" id="estadoFiltroCategoria">
                            <option value="" selected>Seleccione un estado</option>
                            <option value="23">Cambios sustanciales (cambio de finalidad en las BD)</option>
                            <option value="24">Encargado del tratamientos de las BD</option>
                            <option value="25">Clasificación o tipos de datos personales</option>
                        </select>
                    </div>
                    <div class="col-3 mt-2">
                        <input type="submit" id="btn-consultarCategoria" name="btn-consultarCategoria" class="btn btn-info" value="Consultar">
                    </div>
                </div>
            <form action="app/view/solicitudFinalizadoSg.php" method="POST">
                <div class="row mt-3" id="selectorEstadoSg">
                    <div class="col-12">
                        <h6>Seleccione un estado para realizar la consulta</h6>
                    </div>
                    <div class="col-3">
                        <select class="custom-select" name="estadoFiltroEs" id="estadoFiltroEs">
                            <option value="" selected>Seleccione un estado</option>
                            <option value="3">Pendiente</option>
                            <option value="2">Resuelto</option>
                            <option value="22">En Proceso</option>
                        </select>
                    </div>
                    <div class="col-3 mt-2">
                        <input type="submit" id="btn-consultarEstado" name="btn-consultarEstado" class="btn btn-info" value="Consultar">
                    </div>
                </div>
            </form>

        <div class="row mt-3" id="selectorTicketSg">
            <div class="col-12">
                <h6>Número de Ticket</h6>
            </div>
            <div class="col-3">
                <form action="app/view/solicitudFinalizadoSg.php" target="_blank" method="post">
                    <div class="form-group">
                        <input type="hidden" id="usuario_actual" name="usuario_actual" value="<?php echo $_SESSION['usuario']; ?>">
                        <input type="text" id="peticionFiltro" name="peticionFiltro" class="form-control" placeholder="numero_peticion" required autocomplete="off">
                    </div>
                    <input type="submit" id="btn-consultarTicketI" name="btn-consultarTicketI" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
    </div>
    <script src="public/js/filtroSeguridad.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>