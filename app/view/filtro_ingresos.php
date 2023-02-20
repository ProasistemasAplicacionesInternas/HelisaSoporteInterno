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
                <option value="3">Consultar por usuario</option>
            </select>
        </div>
        <div class="row mt-3" id="selectorFecha">
            <div class="col-12">
                <h6>Seleccione el rango de fechas para generar la consulta</h6>
            </div>
            <div class="col-3">
                <form action="app/view/ingresos.php" method="post" onsubmit="rango()" target="_blank">
                    <div class="form-group">
                        <input type="text" id="fechaFiltro" name="fechaFiltro" class="form-control" placeholder="Seleccione la fecha" required autocomplete="off">
                    </div>
                    <input type="hidden" id="fechaInicial" name="fechaInicial">
                    <input type="hidden" id="fechaFinal" name="fechaFinal">
                    <input type="submit" id="btn-consultarFecha" name="btn-consultarFecha" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>
    
        <div class="row" id="selectorUsuario">
          
            <div class="col-12">
                <form action="app/view/ingresos.php" method="post" onsubmit="rango()" target="_blank">
                    <div class="panel row">
                        <div class="col-3">  
                            <h6>Digite el usuario</h6>
                            <select class="custom-select" name="usuarioFiltro" id="usuarioFiltro" required>
                                <option value=""></option>
                                <?php
                                    foreach($lista_usuarios as $detalleUsuario){
                                        echo "<option value='".$detalleUsuario["usuario"]."'>".$detalleUsuario["usuario"] ."</option>" ;
 
                                    }  
                                ?>
                            </select>
                        </div>                    
                         <div class="col-3" id="checks">  
                            <h6>Seleccione la fecha</h6>

                            <input type="text" id="fechaUsuario" name="fechaUsuario" class="form-control" placeholder="Seleccione la fecha" required autocomplete="off">
                            <input type="hidden" id="fechaIn" name="fechaIn">
                            <input type="hidden" id="fechaFin" name="fechaFin">                        
                        </div>                       
                                    
                    </div>  
                      <div class="col-2 mt-3 mb-3" >
                            <label class="radio-inline">
                                <input type="checkbox" id="todo" onclick="uncheck()" name="todo" value="1" checked> Todo<br>
                            </label>
                            <label class="radio-inline">
                                <input type="checkbox" id="fechaU" onclick="uncheck()" name="fechaU" value="2" > Fecha<br>
                            </label>          
                        </div>                           
                    <input type="submit" id="btn-consultarUsuario" name="btn-consultarUsuario" class="btn btn-info" value="Consultar">
                </form>
            </div>
        </div>

    </div>
    <script src="public/js/filtro_ingreso.js?v2"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>

<script type="text/javascript">
    function uncheck(){
    var checkbox1 = document.getElementById("todo");
    var checkbox2 = document.getElementById("fechaU");
     checkbox1.checked=null;

    checkbox1.onclick = function(){
    if(checkbox1.checked != false){
       checkbox2.checked =null;
    }
}
checkbox2.onclick = function(){
    if(checkbox2.checked != false){
        checkbox1.checked=null;
    }
  }
}
</script>
