<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="../../public/css/contenido.css?v1" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/consulta_peticion.css"> 
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/buttons.dataTables.min.css" media="screen">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/v4-shims.css"> 

</head>

<body>
    <?php
        ini_set("session.cookie_lifetime","18000");
        ini_set("session.gc_maxlifetime","18000");
        header('Cache-Control: no cache');
        session_cache_limiter('private_no_expire'); 

        session_start();

        if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){

             header('location:../../login.php');
        }

        require('../controller/control_consulta_peticionesmai.php');
      
 
      $datos= new PeticionMai();
   
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
            
            <div class="col">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <th style="width:40px;">Nro Solicitud</th>
                        <th style="width:80px;">Fecha Solicitud</th>
                        <th style="width:40px;">Usuario Solicitud</th>
                        <th style="width:40px;">Categoria</th>
                        <th style="width:40px;">Descripcion</th>
                        <th style="width:40px;">Estado</th>
                        <th style="width:40px;">Fecha Atendido</th>
                        <th style="width:40px;">Usuario Atendio</th>
                        <th style="width:20px;">Conclusiones</th>
                    </thead>
                    <tbody>
                    <?php foreach ($listaConsulta as $datos) : ?>
                        <?php if (!empty($datos->getConclusiones_peticionMai())) : ?>
                            <tr>
                                <td>
                                    <span id="id_peticion<?php echo $datos->getId_peticionMai(); ?>">
                                        <?php echo $datos->getId_peticionMai(); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo $datos->getFecha_peticionMai(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getUsuario_creacionMai(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getProducto_peticionMai(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getDescripcion_peticionMai(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getEstado_peticionMai(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getFecha_atendidoMai(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getUsuario_atencionMai(); ?>
                                </td>
                                <td>
                                    <?php echo nl2br(htmlspecialchars($datos->getConclusiones_peticionMai())); ?>
                                    <br>
                                    <a href="#" style="color: red; font-size: smaller;" onclick="toggleConclusiones('<?php echo $datos->getId_peticionMai(); ?>');">Ver todas las conclusiones</a>
                                    <div id="conclusiones_<?php echo $datos->getId_peticionMai(); ?>" style="display: none;">
                                        <!-- Aquí no se mostrará en una tabla, sino en formato de texto -->
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require('crear_comentarios.php') ?>
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
    <script src="../../public/js/comentario.js"></script>
    <script src="../../public/js/crear_comentario.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/conclusiones.js"></script>
</body>
</html>