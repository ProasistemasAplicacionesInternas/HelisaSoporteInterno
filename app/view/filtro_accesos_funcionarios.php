<?php
    ini_set("session.cookie_lifetime","18000");
    ini_set("session.gc_maxlifetime","18000");

    session_start();

    if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){

         header('location:../../login.php');
    } 

    require("../controller/modifica_usuario.php");   

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
            <select class="custom-select" name="criterio" id="criterio">
                <option value="" selected>Seleccione una opción</option>
                <option value="1">Consultar por fecha</option>
                <option value="3">Consultar por funcionario</option>
            </select>
        </div>
        <div class="row mt-3" id="selectorFecha" style="display: none;">
            <div class="col-12">
                <h6>Seleccione el rango de fechas para generar la consulta</h6>
            </div>
            <div class="col-3">
                <form action="app/view/accesos_funcionario.php" method="post" onsubmit="rango()" target="_blank">
                    <div class="form-group">
                        <input type="text" id="fechaFiltro" name="fechaFiltro" class="form-control" placeholder="Seleccione la fecha" required autocomplete="off">
                    </div>
                    <input type="hidden" id="fechaInicial" name="fechaInicial">
                    <input type="hidden" id="fechaFinal" name="fechaFinal">
                    <input type="submit" id="btn-consultarFecha" name="btn-consultarFecha" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
        <div class="row" id="selectorUsuario" style="display: none;">  
            <div class="col-12">
                <form action="app/view/accesos_funcionario.php" method="post" onsubmit="rango()" target="_blank">
                    <div class="panel row">
                        <div class="col-3">  
                            <h6>Digite el Funcionario</h6>
                            <select class="custom-select" name="usuarioFiltro" id="usuarioFiltro" required>
                                <option value=""></option>
                                <?php
                                    foreach($lista_funcionarios as $detalleUsuario){
                                        echo "<option value='".$detalleUsuario["usuario"]."'>".$detalleUsuario["usuario"] ."</option>" ;
 
                                    }  
                                ?>
                            </select>
                        </div>                                         
                    </div>    <br>                       
                    <input type="submit" id="btn-consultarUsuario" name="btn-consultarUsuario" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>

    </div>
    <script src="public/js/filtro_accesos.js?v2"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>