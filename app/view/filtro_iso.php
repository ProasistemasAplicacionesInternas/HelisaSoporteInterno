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
    </div>
    <script src="public/js/iso.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>
