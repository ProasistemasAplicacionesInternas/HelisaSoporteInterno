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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/v4-shims.css">
</head>

<body>
    <?php
    ini_set("session.cookie_lifetime", "18000");
    ini_set("session.gc_maxlifetime", "18000");
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');

    session_start();
    $_SESSION['id_roles'];

    if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {

        header('location:../../login.php');
    }

    require('../controller/control_peticiones_finalizadas.php');
    require('../controller/devolverComentario.php');


    $datos = new Peticion();

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
                <h6><a href="../../dashboard.php"><img src="../../public/img/atras.png" style="margin-right: 10px; margin-bottom: 5px;"></a>Consultas</h6>
            </div>
            <div class="col">
                <table class="table table-striped" id="tabla">
                    <thead>
                        <th>Nro Petición</th>
                        <th>Fecha Petición</th>
                        <th>Usuario Petición</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Fecha Atendido</th>
                        <th>Usuario Atendio</th>
                        <th>Estado</th>
                        <th>Conclusiones</th>
                        <?php if ($_SESSION['id_roles'] == 8 || $_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 5) { ?>
                            <th>Imagen</th>
                            <th>Agregar comentario</th>
                            <th>Ver comentarios</th>
                            <th style="display: none;">Comentarios</th>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php foreach ($listaConsulta as $datos) : ?>
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
                                    <?php echo $datos->getP_estado(); ?>
                                </td>
                                <td>
                                    <?php echo $datos->getP_conclusiones(); ?>
                                </td>
                                <?php if ($_SESSION['id_roles'] == 8 || $_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 5) { ?>
                                    <td>
                                        <?php if ($datos->getP_cargarimagen() != null && $datos->getP_cargarimagen() != '2') : ?>
                                            <span style="display: none;"><?php echo $datos->getP_cargarimagen(); ?></span>
                                            <a href="../../cartas/<?= $datos->getP_cargarimagen() ?>" target="_blank" id="imagen" name="imagen">
                                                <button class="far fa-images" id="imagenPetFinal"></button>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-success verConclusion" data-toggle="modal" data-target="#crearComentario" data-backdrop="static" data-keyboard="false" id="btn-crearComentario" name="btn-crearComentario" value="<?php echo $datos->getP_nropeticion(); ?>">Crear comentarios</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary verComentarios" data-toggle="modal" data-target="#verComentarios" data-backdrop="static" data-keyboard="false" id="btn-verComentarios" name="btn-verComentarios" onclick="verComentarios(<?= $datos->getP_nropeticion() ?>)">Ver comentarios</button>
                                    </td>
                                    <td>
                                        <p style="display: none;"><?php echo devolverComentarios($datos->getP_nropeticion()); ?></p>
                                    </td>
                                <?php } ?>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require('verComentarios.php') ?>
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
    <script src="../../public/js/verConclusiones.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>

</html>