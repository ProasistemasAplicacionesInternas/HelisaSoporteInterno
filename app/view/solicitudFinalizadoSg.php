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
    ini_set("session.cookie_lifetime", "18000");
    ini_set("session.gc_maxlifetime", "18000");
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');

    session_start();
    $_SESSION['id_roles'];
    if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {

        header('location:../../login.php');
    }

    require_once("../model/crudPeticionesSg.php");
    require('../controller/controllerFinalizadaSg.php');

    $datos3 = new PeticionSg();

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
                        <th style="width:60px;">Nro Ticket</th>
                        <th style="width:35px;">Usuario Solicitud</th>
                        <th style="width:75px;">Fecha Solicitud</th>
                        <th style="width:75px;">Area</th>
                        <th style="width:150px;">Categoria</th>
                        <?php if ($_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 11) {
                            echo "<th style='width:35px;'>Estado</th>";
                        } ?>
                        <th style="width:35px;">Usuario Atendido</th>
                        <th style="width:75px;">Fecha Atendido</th>
                        <th style="width:80px;">Descripcion Solicitud</th>
                        <?php if ($_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 11) {
                            echo "<th style='width:80px;'>Ver Conclusiones</th>";
                        }
                        ?>
                        <?php if ($_SESSION['id_roles'] == 11 || $_SESSION['id_roles'] == 7) {
                            echo "<th style='width:35px;'>Conclusiones</th>";
                        } ?>
                        <th style="width:10px;" colspan="2">Documentos</th>

                    </thead>
                    <tbody>
                        <?php if (isset($listaConsulta) && !empty($listaConsulta)) : ?>
                            <?php foreach ($listaConsulta as $datos) : ?>
                                <tr>
                                    <td>
                                        <span id="id_peticion<?php echo $datos->getIdPeticionSg(); ?>">
                                            <?php echo $datos->getIdPeticionSg(); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php echo $datos->getUsuarioCreacionSg(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getFechaPeticionSg(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getAreaFuncionario(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getCategoriaSg(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getEstadoPeticionSg(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getUsuarioAtencionSg(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getFechaAtendidoSg(); ?>
                                    </td>
                                    <td>
                                        <?php echo $datos->getDescripcionPeticionSg(); ?>
                                    </td>


                                    <?php if ($_SESSION['id_roles'] == 11 || $_SESSION['id_roles'] == 7) { ?>
                                        <td>
                                            <button class="btn btn-outline-primary verConclusion" data-toggle="modal" data-target="#verConclusionSg" data-backdrop="static" data-keyboard="false" id="btn-verConclusion" name="btn-verConclusion" onclick="verConclusionesSg(<?= $datos->getIdPeticionSg() ?>)"><span>Ver Conclusión</span></button>
                                        </td>
                                    <?php } ?>

                                    <td>
                                        <?php if ($_SESSION['id_roles'] == 11 || $_SESSION['id_roles'] == 7) {
                                            echo $datos->getConclusionesPeticionSg();
                                        } ?>
                                    </td>
                                    <td>
                                    <td>
                                        <button class="btn btn-outline-primary Documentos" data-toggle="modal" data-target="#documentModal" data-backdrop="static" id="btn-traerImagenes" name="btn-traerImagenes" onclick="mostrarDocumentos(<?= $datos->getIdPeticionSg() ?>)">Documentos</button>
                                    </td>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <?php require('verComentariosSg.php') ?>
    <?php require('verDocumentosSg.php') ?>

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
    <script src="../../public/js/verComentariosSg.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>

</html>