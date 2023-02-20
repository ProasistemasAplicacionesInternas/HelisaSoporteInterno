<?php 
require_once('../controller/controlador_areas.php');
require_once('../controller/controlador_cargos.php');
require_once('../controller/control_tipo_accesos.php');

//*****************************************************************************************************//
//********************************PESTAÑA PARA RESTABLECER CONTRASEÑA**********************************//
//*****************************************************************************************************//

?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Helisa | Soporte Infraestructura</title>
        <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../public/css/smoke.min.css">
        <link rel="stylesheet" href="../../public/css/funcionarios.css" media="screen" type="text/css">
        <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    </head>

    <body>        

        <header class="container-fluid">            
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>            
        </header>

        <div class="container">
            <div class="img">
               <img src="../../public/img/www.png" alt="">
            </div>
           <form action="../controller/controlador_funcionarios.php" method="post">
              <div class="row restablecer">
                    <div class="col-md-6 col-ml-5  offset-md-3">
                        <h5>Para restablecer la contraseña,<br>ingrese el usuario</h5>
                        <input type="text" name="usuario" id="usuario" class="form-control info" placeholder ="Usuario" autocomplete="off"> 
                    </div>            
                    <div class="row mt-3 mb-5 col-12" id="botones-restablecer">
                        <div class="col-2">
                            <button type="submit" class="btn btn-info" id="restablecer-correo" name="restablecer-correo">Enviar</button>
                        </div>
                        <div class="col-2">
                            <a href="../controller/cerrar_funcionarios.php" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
            </div>
        </form>
        </div> 
            
        <script src="../../public/js/jquery-3.3.1.min.js"></script>
        <script src="../../public/js/popper.js"></script>
        <script src="../../public/js/bootstrap.min.js"></script>
        <script src="../../public/js/smoke.min.js"></script>
        <script src="../../public/js/es.min.js"></script>
        <script src="../../public/js/validacion_funcionario.js"></script>
        <script src="../../public/js/bloqueoTeclas.js"></script>
        
    </body>
</html>