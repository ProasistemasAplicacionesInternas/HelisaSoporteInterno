<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/clientes.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
</head>

<body>
    <?php

   session_start();
   
   if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }     
  
        $f_identificacion=$_POST['f_identificacion']; 
        $f_nombre=$_POST['f_nombre'];
        $f_correo=$_POST['f_email'];
        $f_area=$_POST['f_area'];
        $f_cargo=$_POST['f_cargo'];
        $f_extension=$_POST['f_extension'];
        $f_usuario=$_POST['f_usuario'];
        $f_contrasena=$_POST['f_contrasena'];

  require_once('../controller/controlador_funcionarios.php');       

?>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
        <div class="container">
        <div class="row">
            <h6 class="mt-3">Eliminar Funcionario</h6>
            <div class="col-12 ml-5">

                <form action="../controller/controlador_funcionarios.php" method="post" class="form-group">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Identificacion</label>
                                <input type="text" id="f_identificacion" name="f_identificacion" class="form-control info" maxlength="25" autocomplete="off" value="<?php echo         $f_identificacion ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="f_nombre" name="f_nombre" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $f_nombre ?>" required readonly>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                    <div class="col-5">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="text" id="f_correo" name="f_correo" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $f_correo ?>" required readonly>
                            </div>
                    </div>

                    <div class="col-1">
                            <div class="form-group">
                                <label>Extension</label>
                                <input type="text" id="f_extension" name="f_extension" class="form-control info" maxlength="6" autocomplete="off" value="<?php echo $f_extension ?>" required readonly>
                            </div>
                    </div>

                    <div class="col-3">
                            <div class="form-group">
                                <label>Area</label>
                                <input type="text" id="f_area" name="f_area" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $f_area ?>" required readonly>
                            </div>
                    </div>

                    <div class="col-3">
                            <div class="form-group">
                                <label>Cargo</label>
                                <input type="text" id="f_cargo" name="f_cargo" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $f_cargo ?>" required readonly>
                            </div>
                    </div>
                    </div>


                    <div class="row">
                    <div class="col-6">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" id="f_usuario" name="f_usuario" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $f_usuario ?>" required readonly>
                            </div>
                    </div>

                    <div class="col-6">
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input type="text" id="f_contrasena" name="f_contrasena" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $f_contrasena ?>" required readonly>
                            </div>
                    </div>

                    <input type="submit" value="Eliminar Usuario" id="eliminar_funcionario" name="eliminar_funcionario" class="mt-4 btn btn-primary btn-sm btn-guardar btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    
    
    

</body>

</html>