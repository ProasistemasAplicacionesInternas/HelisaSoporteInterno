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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
</head>

<body>
    <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-11 mt-4 pl-5 mb-2">
                    <h6>Consulta Activos Fijos</h6>
                </div>
                <div class="col-1 mt-4 mb-2">
                    <a href="app/view/crear_activos.php"><img src="public/img/nuevo.png" alt=""></i></a>   
                </div>

        <div class="container">
            <div class="row mt-5">
            
                <div class="col-12">
                    <h6>Elija el criterio para la consulta de Activos Fijos</h6>
                </div>
            </div>
            <div class="col-3">
                <select class="custom-select" name="criterio" id="criterio">
                    <option value="" selected>Seleccione una opción</option>
                    <option value="1">Consultar por codigo de activo</option>
                    <option value="2">Consultar por nombre de activo</option>
                    <option value="3">Consultar por responsable</option>                
                </select>
            </div>
        
            <div class="row" id="selectorCodigo">
            <div class="col-12">
                    <h6>Digite el codigo del activo</h6>
                </div>
                <div class="col-3">
                    <form action="app/view/consultar_activos.php" target="_blank" method="post">
                        <div class="form-group">
                            <input type="text" id="codigoActivo" name="codigoActivo" class="form-control" placeholder="Codigo de Activo" required autocomplete="off">
                        </div>
                        <input type="submit" id="btn-consultarCodigo" name="btn-consultarCodigo" class="btn btn-info" value="Consultar">
                    </form>
                </div>
            </div>

            <div class="row" id="selectorNombre">
            <div class="col-12">
                    <h6>Digite el nombre del activo</h6>
                </div>
                <div class="col-4">
                    <form action="app/view/consultar_activos.php" target="_blank" method="post">
                        <div class="form-group">
                            <input type="text" id="nombreActivo" name="nombreActivo" class="form-control" placeholder="Nombre de Activo" required autocomplete="off">
                        </div>
                        <input type="submit" id="btn-consultarNombre" name="btn-consultarNombre" class="btn btn-info" value="Consultar">
                    </form>
                </div>
            </div>

            <div class="row" id="selectorResponsable">
            <div class="col-12">
                    <h6>Digite el nombre del responsable</h6>
                </div>
                <div class="col-5">
                    <form action="app/view/consultar_activos.php" target="_blank" method="post">
                        <div class="form-group">
                            <input type="text" id="responsable" name="responsable" class="form-control" placeholder="Responsable" required autocomplete="off">
                        </div>
                        <input type="submit" id="btn-consultarResponsable" name="btn-consultarResponsable" class="btn btn-info" value="Consultar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/filtro_activo.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>

    
</body>

</html>
