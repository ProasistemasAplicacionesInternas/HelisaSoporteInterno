
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
        $_SESSION['id_roles'];
        if(!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])){

            header('location:../../login.php');
        }

        require('../controller/control_peticiones_finalizadas.php');

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
        <div class="row" class="dataConsulta">
            <div class="col-10 mt-4 pl-5 mb-2">
                <h6><a href="../../dashboard.php"><img src="../../public/img/atras.png"></a>Consultas</h6>
            </div>
            <div class="col">
                <table class="table table-responsive table-striped" id="tabla" style="text-align:center;">
                    <thead style="background-color: #96c7e9;">
                        <th style="width:70px;">Nro Ticket</th>
                        <th style="width:80px;">Fecha Solicitud</th>
                        <th style="width:40px;">Usuario Solicitud</th>
                        <th style="width:20px;">Categoria</th>
                        <th style="width:290px;">Descripcion</th>
                        <th style="width:80px;">Fecha Atendido</th>
                        <th style="width:40px;">Usuario Atendio</th>
                        <th style="width:40px;">Calificación</th>
                        <?php if($_SESSION['id_roles']==5 || $_SESSION['id_roles']==7 ){
                            echo "<th style='width:100px;'>Ver Conclusiones</th>";
                        } 
                        ?>
                        <th style="width:10px;">Imagen</th>                      
                    
                    </thead>
                    <tbody>
                        <?php foreach($listaConsulta as $datos): ?>
                        <tr>
                            <td>
                                <span id="id_peticion<?php echo $datos->getP_nropeticion(); ?>">
                                <?php echo $datos->getP_nropeticion(); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo $datos->getP_fechapeticion(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_usuario(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_categoria(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_descripcion(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_fechaatendido(); ?>
                            </td>
                            <td>
                                <?php echo $datos->getP_usuarioatiende(); ?>
                            </td>
                            <td>
                                <?php 
                                    $Calificacion = $datos->getCalificacion(); 
                                    if ( $Calificacion == 1) {
                                        echo "<a style='color:red;'>Pesimo</a>";
                                    }else if ( $Calificacion == 2) {
                                        echo "<a style='color:#ff7600;'>Malo</a>";
                                    }else if ( $Calificacion == 3) {
                                        echo "<a style='color:#0014ff;'>Regular</a>";
                                    }else if ( $Calificacion == 4) {
                                        echo "<a style='color:#377fc9;'>Bueno</a>";
                                    }else if ( $Calificacion == 5) {
                                        echo "<a style='color:#00d337;'>Excelente</a>";
                                    } else if ( $Calificacion == 0) {
                                        echo "<a style='font-weight: bold;'>No Calificado</a>";
                                    }
                                ?>
                            </td>
                            <?php if($_SESSION['id_roles']==5 || $_SESSION['id_roles']==7 ){ ?>
                                <td>
                                <button class="btn btn-outline-primary verConclusion" data-toggle="modal" data-target="#verConclusion" data-backdrop="static" data-keyboard="false" id="btn-verConclusion" name="btn-verConclusion" onclick="verConclusiones(<?= $datos->getP_nropeticion()?>)"><span>Ver Conclusión</span></button>    
                                </td>
                            <?php } ?>
                            <!-- <td>
                                <button type="button" class="btn btn-info crearComentario" data-toggle="modal" data-target="#crearComentario" data-backdrop="static" data-keyboard="false" id="btn-crearComentario" name="btn-crearComentario" value=" --><!-- "><span>Crear</span></button>    
                            </td> -->
                            <td>
                                <?php if ($datos->getP_cargarimagen() != null && $datos->getP_cargarimagen() != '2'): ?>
                                    
                                    <a href="../../cartas/<?=$datos->getP_cargarimagen()?>" target="_blank" id="imagen" name="imagen">
                                        <button class="far fa-images" id="imagenPetFinal" ></button>    
                                    </a>                                      
                                <?php endif; ?>
                            </td>                                            
                        </tr>

                        <?php endforeach; ?>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require('crear_comentarios.php') ?>
    <?php require('verConclusiones.php') ?>
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
    <script src="../../public/js/verConclusiones.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>

</html>
