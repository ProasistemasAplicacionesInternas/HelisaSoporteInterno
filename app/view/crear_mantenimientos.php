<?php 
//*************************************************************************************//
//********************* FORMULARIO PARA LA CREACION DE FUNCIONARIOS *******************//
//*************************************************************************************//

	ini_set("session.cookie_lifetime",18000);
  	ini_set("session.gc_maxlifetime",18000);
   		session_start();

   	if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }
    $af_id=$_POST['af_idA'];
    $af_codigo=$_POST['af_codigoA'];
    $af_serial=$_POST['af_serialA'];

require_once('../controller/controlador_activosFijos.php');    
require('../controller/controlador_funcionarios.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/activosFijos.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
</head>

<body>

	<header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <h6 class="mt-3">Generar Mantenimiento</h6>
            <div class="col-12 ml-5">

                <form action="../controller/controlador_mantenimientos.php" method="post" class="form-group">
                    <div class="row">
                        <div class="col-1">
                            <div class="form-group">
                                <label>Id Activo</label>
                                <input type="text" id="m_idActivo" name="m_idActivo" class="form-control info" autocomplete="off" value="<?php echo $af_id?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Codigo Activo</label>
                                <input type="text" id="m_codigo" name="m_codigo" class="form-control info" maxlength="10" autocomplete="off" value="<?php echo $af_codigo?>" readonly>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Serial Activo</label>
                                <input type="text" id="m_serial" name="m_serial" class="form-control info" maxlength="10" autocomplete="off" value="<?php echo $af_serial?>" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Fecha Mantenimiento</label>
                                <input type="date" id="m_fecha" name="m_fecha" class="form-control info" value="" required>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Costo Mantenimiento</label>
                                <input type="text" id="m_costo" name="m_costo" class="form-control info" maxlength="10" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="m_descripcion" id="m_descripcion" cols="133" rows="5" required></textarea>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-5">
                            <input type="submit" value="Ingresar Mantenimiento" id="crear_mantenimiento" name="crear_mantenimiento" class="mt-4 btn btn-primary btn-sm btn-guardar">
                        </div>
                        <div class="col-4" > 
                            <a href="../../dashboard.php" class="mt-4 btn btn-danger" style="height:30px";  >Cancelar</a>
                        </div>
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