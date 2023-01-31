<?php $hora = $_GET['sTz@fg78:rTRsd4'];

date_default_timezone_set('America/Bogota');

$nuevafecha = strtotime ( '+12 hour' , strtotime ( $hora ) ) ;
$fecha = date ( 'Y-m-j H:i:s' , $nuevafecha );
$fecha_actual = date('Y-m-d H:i:s');

if($fecha_actual > $fecha){ 
     
     require_once('../controller/controlador_areas.php');
require_once('../controller/controlador_cargos.php');
require_once('../controller/control_tipo_accesos.php');

//*****************************************************************************************************//
//********************************PESTAÑA PARA RESTABLECER CONTRASEÑA**********************************//
//*****************************************************************************************************//

?>
<style type="text/css">
    .img {
        text-align: center;
    }

    .img img {
       margin-top: 4%;
       width: 350px;
    }
  
    .container-one {
        margin-top: 4%;
    }

    .container-one h5 {
        text-align: center;
        margin-top: 1%;
    }
      
</style>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Helisa | Soporte Infraestructura</title>
        <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../public/css/smoke.min.css">
        <link rel="stylesheet" href="../../public/css/funcionarios.css?n=1" media="screen" type="text/css">
        <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    </head>

    <body>        

        <header class="container-fluid">            
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>            
        </header>

        <div class="container-one">
            <div class="img">
               <img src="../../public/img/www.png" alt="">
            </div>
          <h5>Han pasado más de 12 horas, este link ha vencido</h5>
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
    
<?php   }else
    {
     
require_once('../controller/controlador_areas.php');
require_once('../controller/controlador_cargos.php');
require_once('../controller/control_tipo_accesos.php');

//*****************************************************************************************************//
//********************************PESTAÑA PARA RESTABLECER CONTRASEÑA**********************************//
//*****************************************************************************************************//

?>
<style type="text/css">
    .img {
        text-align: center;
    }

    .img img {
       margin-top: 4%;
       width: 350px;
    }

    .restablecer {
        display: block;
        text-align: center;
    }

    #botones-restablecer {
        align-items: center;
        justify-content: center;
    }

    #example input {
        margin: 4% 24%;
        border: 0;
        border-bottom: 1px solid #b3b3b3;
    }

    h6 {
        text-align: center;
    margin-bottom: 8% !important;
    }
    
      
</style>
  
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
            <div class="col-12" id="valida-div" style="width: 22%;text-align: center;float: right;margin: 5% 12% -1% -10%;   border: 1px solid #d9007f;padding: 13px;border-radius: 16px;box-shadow: 0px 0px 5px #bfbfbf;display: none">
            <label class="mt-2" id="valida" style="color: #000000!important;font-weight: 100;"></label>
           </div>   
           <form action="../controller/modifica_usuario.php" method="post">
              <div class="row restablecer">
                    <div class="col-md-6 col-ml-5  offset-md-3" id="example">
                        <h6>Para cambiar la contraseña,por favor digite su nueva clave</h6>
                        <div class="col-8">
                        <input type="password" name="contrasena" id="contrasena" class="form-control info" placeholder ="Nueva Contraseña" autocomplete="off"> 
                        </div>
                        <div class="col-8">
                        <input type="password" name="contrasena-validar" id="contrasena-validar" class="form-control info" placeholder ="Confirmar contraseña" autocomplete="off"> 
                        </div>
                        <input type="hidden" id="usuario" name="usuario" value ="<?php echo $_GET['8thhj45gb/uias@gh'] ?>">
                    </div>            
                    <div class="row mt-3 mb-5 col-12" id="botones-restablecer">
                        <div class="col-2">
                            <button type="button" class="btn btn-info" id="restablecer-cuenta" name="restablecer-cuenta">Guardar</button>
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
        <script src="../../public/js/validar_recuperacion.js"></script>
        <script src="../../public/js/valida_contrasena.js"></script>
        <script src="../../public/js/bloqueoTeclas.js"></script>
        
    </body>
</html>
    
<?php } ?>
