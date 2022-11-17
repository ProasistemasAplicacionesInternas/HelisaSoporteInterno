<?php
  if(isset($_SESSION['usuario']) || isset($_POST['noQr'])){
    session_unset();
    session_destroy();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/login.css" media="screen" type="text/css">
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="public/img/ico.png" />
</head>
<body>

    <style type="text/css">
    #importante .modal-content {
       border-radius: 20px;
    }

    #importante .modal-header {
        padding: 17px 0px 6px 190px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    #importante .modal-footer {
        padding: 23px;
    }

    #importante input {
        background: #e6007e !important;
        border-color:#e6007e !important; 
    }

    #medidas {
        float: right;
        width: 13%;
        margin: 2% 17% 0% -16%;
    }

    </style>
 <?php if(isset($_GET['V4ll@/y874c']) != 1 && isset($_GET['V4ll@/y874c']) != 2): ?>

    <div class="modal fade" id="importante" tabindex="-1" role="dialog" aria-labelledby="basicModal" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-md">
           <div class="modal-content">
                <div class="modal-header">        
                    <h6>¡IMPORTANTE!</h6>
                    
                </div>
                <div class="modal-body">  
                <p>El ingreso a la plataforma es solo para usuarios autorizados, se solicita no suministrar los datos de acceso a terceros.</p>                
                </div>   
                <div class="modal-footer" style="">
                    <input type="button" style=" " value="Continuar" id="alerta" name="alerta" class=" btn btn-primary alerta" >       
                 </div>                
            </div>
        </div>
    </div>

      <?php endif; ?>

    <?php if(isset($_GET['V4ll@/y874c']) && $_GET['V4ll@/y874c'] == 2): ?>
    <div id="invalido">
        <p>Su cuenta ha sido bloqueada, por favor restablezca contraseña</p>
    </div> 

    <?php endif; ?>

    <div id="medidas"></div>

	<div class="container">

        <div class="row align-items-center">
            <div class="col-md-4 mt-5 offset-2">
                <img src="public/img/www.png" alt="">
            </div>
            <div class="col-md-6 mt-5"  style="top: 34px">
                <form class="form-group" action="app/controller/controlador_funcionarios.php" method="post">
                    <div class="form-group"><input type="text" class="form-control" placeholder="usuario" id="f_user" name="f_user" required autofocus autocomplete="off"></div>
                    
                    <div class="form-group"><input type="password" class="form-control" placeholder="contrase&ntilde;a" id="f_password" name="f_password" required></div>

                     <div style="margin-bottom: 2%">
                        <a href="app/view/funcionario_correo.php">¿Olvido su contrase&ntilde;a?</a>
                    </div>     

                    <input type="submit" class="btn btn-info" value="Ingresar" id="ingresar" name="ingresar">
                    
                </form>
            </div>
        </div>
    </div>
    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/popper.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>
</html>

<script>
   $(document).ready(function()
   {
    
      $("#importante").modal("show");


      $("#alerta").on('click',function(){        
      $("#importante").modal("hide");

      });
        
   });   
</script>