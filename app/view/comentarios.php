<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="../../public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/consulta_peticion.css"> 
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/buttons.dataTables.min.css" media="screen">

</head>

<body>
    <?php
        ini_set("session.cookie_lifetime","18000");
        ini_set("session.gc_maxlifetime","18000");

        session_start();

        if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){

             header('location:../../login.php');
        }

        require('../controller/control_comentarios.php');
      
 
      $datos= new Peticion();
   
    ?>
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/logo.png" alt="">
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row mt-2">
        </div>
        <div class="row" class="dataConsulta">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consultas</h6>
            </div>
            <div class="col">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <th style="width:40px;">Nro Solicitud</th>
                        <th style="width:80px;">Nro Peticion</th>
                        <th style="width:40px;">Fecha Registro</th>
                        <th style="width:40px;">Usuario Solicitud</th>
                        <th style="width:40px;">Comentario</th>                                                                     
                      
                    </thead>
                    <tbody>
                        <?php foreach($listaConsultaCom as $datos): ?>
                        <tr>
                            <td>           
                              <span id="id_peticion<?php echo $datos->getP_nropeticion(); ?>">
                                <?php echo $datos->getP_nropeticion(); ?>
                              </span>
                            </td>
                            <td>
                                <?php echo $datos->getPeticion_co(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_fechapeticion(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_usuario(); ?>
                            </td>                           
                            <td>
                                <?php echo $datos->getP_conclusiones(); ?>
                            </td>
                        
                                            
                        </tr>

                        <?php endforeach; ?>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/datatables.min.js"></script>
    <script src="../../public/js/dataTables.buttons.min.js"></script>
    <script src="../../public/js/buttons.flash.min.js"></script>
    <script src="../../public/js/jszip.min.js"></script>
    <script src="../../public/js/pdfmake.min.js"></script>
    <script src="../../public/js/vfs_fonts.js"></script>
    <script src="../../public/js/buttons.html5.min.js"></script>
    <script src="../../public/js/buttons.print.min.js"></script>
    <script src="../../public/js/tablas.js"></script>
    <script src="../../public/js/moment.min.js"></script>
    <script src="../../public/js/daterangepicker.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>

</html>
