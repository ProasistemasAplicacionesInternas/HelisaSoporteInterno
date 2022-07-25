<?php
            ini_set("session.cookie_lifetime","18000");
            ini_set("session.gc_maxlifetime","18000");

            session_start();
   
            if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){
       
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
                <h6>Elija el area de la consulta</h6>
            </div>
        </div>
        <div class="col-3">
            <select class="custom-select" name="area" id="area">
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Infraestructura</option>
                <option value="2">Aplicaciones Internas</option>
            </select>
        </div>
    
        <div class="row mt-5" id="criterio-div">
            <div class="col-12">
                <h6>Elija el criterio para la consulta</h6>
            </div>
        </div>
        <div class="col-3">
            <select class="custom-select"  name="criterio" id="criterio">
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Consultar por fecha</option>
                <option value="3">Consultar por Peticion</option>
            </select>
        </div>
        <div class="row mt-3" id="selectorFecha">
            <div class="col-12">
                <h6>Seleccione el rango de fechas para generar la consulta</h6>
            </div>
            <div class="col-3">
                <form action="app/view/peticiones_finalizadas.php" target="_blank" method="post" onsubmit="rango()">
                    <div class="form-group">
                        <input type="text" id="fechaFiltro" name="fechaFiltro" class="form-control" placeholder="Seleccione la fecha" required autocomplete="off">
                    </div>
                    <input type="hidden" id="areaF1" name="areaF1">
                    <input type="hidden" id="fechaInicial" name="fechaInicial">
                    <input type="hidden" id="fechaFinal" name="fechaFinal">
                    <input type="submit" id="btn-consultarFecha" name="btn-consultarFecha" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
    
        <div class="row" id="selectorTicket">
           <div class="col-12">
                <h6>Digite el número de Peticion</h6>
            </div>
            <div class="col-3">
                <form action="app/view/peticiones_finalizadas.php" target="_blank" method="post" onsubmit="rango()">
                    <div class="form-group">
                        <input type="text" id="peticionFiltro" name="peticionFiltro" class="form-control" placeholder="Numero de Peticion" required autocomplete="off">
                    </div>
                    <input type="hidden" id="areaF2" name="areaF2">
                    <input type="submit" id="btn-consultarTicket" name="btn-consultarTicket" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
        
    </div>
    <script src="public/js/filtro.js?v2"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>
