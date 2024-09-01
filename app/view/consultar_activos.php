<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="../../public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/consulta_peticion.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../../public/css/buttons.dataTables.min.css" media="screen">

</head>

<body>

    <?php
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario'])) {

        header('location:../../login.php');
    }

    require_once('../model/datos_activosFijos.php');
    require('../controller/control_activosFijos.php');

    $datos = new activosFijos();
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
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Activos Fijos </h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="crear_activos.php"><img src="../../public/img/nuevo.png" alt=""></a>
            </div>
            <div class="col">
                <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                        <th style="width:3px;">id</th>
                        <th style="width:50px;">Codigo Activo</th>
                        <th style="width:50px;">serial</th>
                        <th style="width:50px;">Nombre Activo</th>
                        <th style="width:50px;">Estado</th>
                        <th style="width:50px;">Responsable</th>
                        <th style="width:50px;">Fecha Asignado</th>
                        <th style="width:50px;">Modificar</th>
                        <th style="width:50px;">Mantenimiento</th>
                        <th style="width:50px;">Traslados</th>
                    </thead>
                    <?php foreach ($consultarActivo as $datos) : ?>
                        <tr>
                            <td>
                                <?php echo $datos->getAf_id() ?></td>
                            <td>
                                <?php echo $datos->getAf_codigo() ?></td>
                            <td>
                                <?php echo $datos->getAf_serial() ?></td>
                            <td>
                                <?php echo $datos->getAf_nombre() ?></td>
                            <td>
                                <?php echo $datos->getAf_descripcion_estado() ?></td>
                            <td>
                                <?php echo $datos->getAf_funcionario() ?></td>
                            <td>
                                <?php echo $datos->getAf_fechaAsignacion() ?></td>
                            <td>
                                <form action="modificar_activos.php" method="post">
                                    <input type="hidden" name="af_codigo" id="af_codigo" value="<?php echo $datos->getAf_codigo(); ?>">
                                    <input type="hidden" name="af_serial" id="af_serial" value="<?php echo $datos->getAf_serial(); ?>">
                                    <input type="hidden" name="af_marca" id="af_marca" value="<?php echo $datos->getAf_marca(); ?>">
                                    <input type="hidden" name="af_modelo" id="af_modelo" value="<?php echo $datos->getAf_modelo(); ?>">
                                    <input type="hidden" name="af_nombre" id="af_nombre" value="<?php echo $datos->getAf_nombre(); ?>">
                                    <input type="hidden" name="af_fechaCompra" id="af_fechaCompra" value="<?php echo $datos->getAf_fechaCompra(); ?>">
                                    <input type="hidden" name="af_categoria" id="af_categoria" value="<?php echo $datos->getAf_grupo(); ?>">
                                    <input type="hidden" name="af_estado" id="af_estado" value="<?php echo $datos->getAf_estado(); ?>">
                                    <input type="hidden" name="af_estado_descripcion" id="af_estado_descripcion" value="<?php echo $datos->getAf_descripcion_estado(); ?>">
                                    <input type="hidden" name="af_area" id="af_area" value="<?php echo $datos->getAf_area(); ?>">
                                    <input type="hidden" name="af_responsable" id="af_responsable" value="<?php echo $datos->getAf_funcionario(); ?>">
                                    <input type="hidden" name="af_fechaAsignacion" id="af_fechaAsignacion" value="<?php echo $datos->getAf_fechaAsignacion(); ?>">
                                    <input type="hidden" name="af_observaciones" id="af_observaciones" value="<?php echo $datos->getAf_observaciones(); ?>">
                                    <input type="hidden" name="af_ubicacion" id="af_ubicacion" value="<?php echo $datos->getAf_ubicacion(); ?>">
                                    <input type="hidden" name="af_ram" id="af_ram" value="<?php echo $datos->getAf_ram(); ?>">
                                    <input type="hidden" name="af_discoDuro" id="af_discoDuro" value="<?php echo $datos->getAf_disco(); ?>">
                                    <input type="hidden" name="af_procesador" id="af_procesador" value="<?php echo $datos->getAf_procesador(); ?>">
                                    <input type="hidden" name="hostName" id="hostName" value="<?php echo $datos->gethostName(); ?>">
                                    <input type="hidden" name="af_office" id="af_office" value="<?php echo $datos->getAf_licenciaOffice(); ?>">
                                    <input type="hidden" name="af_antivirus" id="af_antivirus" value="<?php echo $datos->getAf_licenciaAntivirus(); ?>">
                                    <input type="hidden" name="af_aplicaciones" id="af_aplicaciones" value="<?php echo $datos->getAf_aplicaciones(); ?>">
                                    <input type="hidden" name="af_licenciaSo" id="af_licenciaSo" value="<?php echo $datos->getAf_licenciaSO(); ?>">
                                    <input type="hidden" name="af_dominio" id="af_dominio" value="<?php echo $datos->getAf_dominio(); ?>">
                                    <input type="hidden" name="af_so" id="af_so" value="<?php echo $datos->getAf_sistemaOperativo(); ?>">
                                    <input type="hidden" name="af_areaCreacion" id="af_areaCreacion" value="<?php echo $datos->getAf_areaCreacion(); ?>">
                                    <input type="hidden" name="af_imagenActivo" id="af_imagenActivo" value="<?php echo $datos->getImagenactivo(); ?>">
                                    <input type="hidden" name="costoCompra" id="costoCompra" value="<?php echo $datos->getcostoCompra(); ?>">
                                    <input type="hidden" name="tipoAct" id="tipoAct" value="<?php echo $datos->gettipoAct(); ?>">
                                    <input type="hidden" name="vidaUtil" id="vidaUtil" value="<?php echo $datos->getvidaUtil(); ?>">
                                    <input type="hidden" name="estadoAct" id="estadoAct" value="<?php echo $datos->getestadoAct(); ?>">
                                    <input type="hidden" name="traCategoria" id="traCategoria" value="<?php echo $datos->gettraCategoria(); ?>">
                                    <input type="hidden" name="sede" id="sede" value="<?php echo $datos->getsede(); ?>">
                                    <input type="hidden" name="centroCostos" id="centroCostos" value="<?php echo $datos->getCentroCostos(); ?>">
                                    <input type="submit" value="Modificar Activo" name="modificar_activo" class="btn btn-info">
                                </form>
                            </td>

                            <td>
                                <form action="crear_mantenimientos.php" method="post">
                                    <input type="hidden" name="af_idA" id="af_idA" value="<?php echo $datos->getAf_id(); ?>">
                                    <input type="hidden" name="af_categoria" id="af_categoria" value="<?php echo $datos->getAf_grupo(); ?>">
                                    <input type="hidden" name="af_codigoA" id="af_codigoA" value="<?php echo $datos->getAf_codigo(); ?>">
                                    <input type="hidden" name="af_serialA" id="af_serialA" value="<?php echo $datos->getAf_serial(); ?>">
                                    <input type="hidden" name="af_ram" id="af_ram" value="<?php echo $datos->getAf_ram(); ?>">
                                    <input type="hidden" name="af_discoDuro" id="af_discoDuro" value="<?php echo $datos->getAf_disco(); ?>">
                                    <input type="hidden" name="af_procesador" id="af_procesador" value="<?php echo $datos->getAf_procesador(); ?>">
                                    <input type="hidden" name="af_so" id="af_so" value="<?php echo $datos->getAf_sistemaOperativo(); ?>">
                                    <input type="hidden" name="af_licenciaSo" id="af_licenciaSo" value="<?php echo $datos->getAf_licenciaSO(); ?>">
                                    <input type="hidden" name="af_dominio" id="af_dominio" value="<?php echo $datos->getAf_dominio(); ?>">
                                    <input type="hidden" name="estadoAct" id="estadoAct" value="<?php echo $datos->getestadoAct(); ?>">
                                    <input type="submit" value="Realizar Mantenimiento" name="mantenimiento" class="btn btn-success">
                                </form>
                            </td>

                            <td>
                                <form id="formTraslados_<?php echo $datos->getAf_id(); ?>" action="crear_traslados.php" method="post">
                                    <input type="hidden" name="af_responsableB" id="af_responsableB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getAf_funcionario(); ?>">
                                    <input type="hidden" name="af_fechaAsignacionB" id="af_fechaAsignacionB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getAf_fechaAsignacion(); ?>">
                                    <input type="hidden" name="af_nombreB" id="af_nombreB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getAf_nombre(); ?>">
                                    <input type="hidden" name="af_idB" id="af_idB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getAf_id(); ?>">
                                    <input type="hidden" name="af_codigoB" id="af_codigoB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getAf_codigo(); ?>">
                                    <input type="hidden" name="af_serialB" id="af_serialB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getAf_serial(); ?>">
                                    <input type="hidden" name="af_identidadB" id="af_identidadB_<?php echo $datos->getAf_id(); ?>" value="<?php echo $datos->getIdentidad_funcionario(); ?>">
                                    <input type="submit" value="Registrar Traslado" name="traslados" class="btn btn-warning" onclick="validarFormulario(event, <?php echo $datos->getAf_id(); ?>)">
                                </form>
                            </td>

                        </tr>
                    <?php
                    endforeach;
                    ?>
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
    <script src="../../public/js/consultaTransferencia.js"></script>
</body>

</html>