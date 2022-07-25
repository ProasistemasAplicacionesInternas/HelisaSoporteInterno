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
        <div class="row mt-2">
        </div>
        <div class="row" class="dataConsulta">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6><a href="../../dashboard.php"><img src="../../public/img/atras.png"></a>Consultas</h6>
            </div>
            <div class="col">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <th style="width:40px;">Nro Solicitud</th>
                        <th style="width:80px;">Fecha Solicitud</th>
                        <th style="width:40px;">Usuario Solicitud</th>
                        <th style="width:40px;">Categoria</th>
                        <th style="width:40px;">Descripcion</th>
                        <th style="width:40px;">Fecha Atendido</th>
                        <th style="width:40px;">Usuario Atendio</th>
                        <th style="width:20px;">Conclusiones</th>
                        <th style="width:20px;">Calificación</th>
                        <th style="width:20px;">Comentarios</th>
                        <th style="width:20px;">Ver</th>
                        <th style="width:20px;">Imagen</th>                      
                      
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
                                <?= html_entity_decode($datos->getP_conclusiones()); ?>
                            </td>
                            <td>
                                <?php 
                                     $Calificacion = $datos->getCalificacion(); 
                                     if ( $Calificacion == 1) {
                                         echo "Pesimo";
                                     }else if ( $Calificacion == 2) {
                                         echo "Malo";
                                     }else if ( $Calificacion == 3) {
                                         echo "Regular";
                                     }else if ( $Calificacion == 4) {
                                         echo "Bueno";
                                     }else if ( $Calificacion == 5) {
                                         echo "Ecxelente";
                                     } else if ( $Calificacion == 0) {
                                         echo "No calificado";
                                     }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info crearComentario" data-toggle="modal" data-target="#crearComentario" data-backdrop="static" data-keyboard="false" id="btn-crearComentario" name="btn-crearComentario" value="<?php echo $datos->getP_nropeticion();?>"><span>Crear</span></button>    
                            </td>
                             <td>                                 
                                <form action="ver_comentario.php" method="post">
                                    <input type="hidden" name="peticion" value="<?php echo $datos->getP_nropeticion(); ?>">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Coment." name="comentar" id="comentar">
                                </form>                                                                     
                            </td>
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
</body>

</html>
