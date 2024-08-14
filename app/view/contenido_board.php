<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {

    header('url:../login.php');
}

require_once __DIR__ . "../../model/crud_dashboard.php";

$info = new DatosBoard();


$data_soportesNuevos = $info->soportesNuevos();
$data_soportesPendientes = $info->soportesPendientes();
$data_soportesSeleccionados = $info->soportesSeleccionados();

$data_soportesNuevosMai = $info->soportesNuevosMai();
$data_soportesPendientesMai = $info->soportesPendientesMai();
$data_soportesSeleccionadosMai = $info->soportesSeleccionadosMai();

$data_requerimientosnuevosMai = $info->requerimientosNuevos();
$data_requerimientosPendientesMai = $info->requerimientosPendientes();
$data_requerimientosSeleccionadosMai = $info->requerimientosSeleccionados();

$dataSolicitudesNuevasSeguridad = $info->soporteNuevoSeguridad();
$dataSolicitudesPendientesSeguridad = $info->soportesPendienteSeguridad();
$dataSolicitudProcesoSeguridad = $info->soportesProcesoSeguridad();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
    <div class="container" id="infoServicios">
        <div class="row">
            <?php if ($_SESSION['id_roles'] == 3 || $_SESSION['id_roles'] == 5) { ?>
                <div class="col-6">
                    <h5 style="color:#5BB94B; font-size:1rem;"><u>Estado soporte aplicaciones internas </u></h5>
                    <h5 style="font-size:1rem;">Soportes nuevos:
                        <?php echo $data_soportesNuevosMai['soportes']; ?>
                    </h5>
                    <h5 style="font-size:1rem;">Soportes Pendientes:
                        <?php echo $data_soportesPendientesMai['soportes']; ?>
                    </h5>
                    <h5 style="font-size:1rem;">Soportes Seleccionados:
                        <?php echo $data_soportesSeleccionadosMai['soportes']; ?>
                    </h5 style="font-size:1rem;">
                    <h4 style="font-size:1rem;"><i class="far fa-eye fa-2x"></i> Soportes Por Atender:
                        <?php echo $total = $data_soportesNuevosMai['soportes'] + $data_soportesPendientesMai['soportes']; ?>
                    </h4>
                </div>
                <div class="col-6">
                    <h5 style="color:#5BB94B; font-size:1rem;"><u>Estado requerimientos aplicaciones internas </u></h5>
                    <h5 style="font-size:1rem;">Requerimientos nuevos:
                        <?php echo $data_requerimientosnuevosMai['soportes']; ?>
                    </h5>
                    <h5 style="font-size:1rem;">Requerimientos pendientes:
                        <?php echo $data_requerimientosPendientesMai['soportes']; ?>
                    </h5>
                    <h5 style="font-size:1rem;">Requerimientos seleccionados:
                        <?php echo $data_requerimientosSeleccionadosMai['soportes']; ?>
                    </h5>
                    <h4 style="font-size:1rem;"><i class="far fa-eye fa-2x"></i> Requerimientos por atender:
                        <?php echo $total = $data_requerimientosnuevosMai['soportes'] + $data_requerimientosPendientesMai['soportes']; ?>
                    </h4>
                </div>
            <?php } else if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) { ?>
                <div class="col-6">
                    <h5 style="color:#5BB94B"><u>Estado soporte infraestructura</u></h5>
                    <h5>Soportes nuevos:
                        <?php echo $data_soportesNuevos['soportes']; ?>
                    </h5>
                    <h5>Soportes pendientes:
                        <?php echo $data_soportesPendientes['soportes']; ?>
                    </h5>
                    <h5>Soportes seleccionados:
                        <?php echo $data_soportesSeleccionados['soportes']; ?>
                    </h5>
                    <h4><i class="far fa-eye fa-2x"></i> Soportes por atender:
                        <?php echo $total = $data_soportesNuevos['soportes'] + $data_soportesPendientes['soportes']; ?>
                    </h4>
                </div>

                <div class="col-6">
                    <h5 style="color:#5BB94B"><u>Estado Soporte Aplicaciones Internas</u></h5>
                    <h5>Soportes Nuevos
                        <?php echo $data_soportesNuevosMai['soportes']; ?>
                    </h5>
                    <h5>Soportes Pendientes
                        <?php echo $data_soportesPendientesMai['soportes']; ?>
                    </h5>
                    <h5>Soportes Seleccionados
                        <?php echo $data_soportesSeleccionadosMai['soportes']; ?>
                    </h5>
                    <h4><i class="far fa-eye fa-2x"></i> Soportes Por Atender
                        <?php echo $total = $data_soportesNuevosMai['soportes'] + $data_soportesPendientesMai['soportes']; ?>
                    </h4>
                </div>

            <?php } else if ($_SESSION['id_roles'] == 11) { ?>
                <div class="col-6">
                    <h5 style="color:#5BB94B"><u>Estado Solicitudes Seguridad</u></h5>
                    <h5>Solicitudes Nuevas
                        <?php echo $dataSolicitudesNuevasSeguridad['soportes']; ?>
                    </h5>
                    <h5>Solicitudes Pendientes
                        <?php echo $dataSolicitudesPendientesSeguridad['soportes']; ?>
                    </h5>
                    <h5>Soportes en Proceso
                        <?php echo $dataSolicitudProcesoSeguridad['soportes']; ?>
                    </h5>
                    <h4><i class="far fa-eye fa-2x"></i> Soportes Por Atender
                        <?php echo $total = $dataSolicitudesNuevasSeguridad['soportes'] + $dataSolicitudesPendientesSeguridad['soportes'] + $dataSolicitudProcesoSeguridad ['soportes']; ?>
                    </h4>
                </div>

            <?php } else if ($_SESSION['id_roles'] != 2) { ?>
                <div class="col-6">
                    <h5 style="color:#5BB94B"><u>Estado Soporte Infraestructura</u></h5>
                    <h5>Soportes Nuevos
                        <?php echo $data_soportesNuevos['soportes']; ?>
                    </h5>
                    <h5>Soportes Pendientes
                        <?php echo $data_soportesPendientes['soportes']; ?>
                    </h5>
                    <h5>Soportes Seleccionados
                        <?php echo $data_soportesSeleccionados['soportes']; ?>
                    </h5>
                    <h4><i class="far fa-eye fa-2x"></i> Soportes Por Atender
                        <?php echo $total = $data_soportesNuevos['soportes'] + $data_soportesPendientes['soportes']; ?>
                    </h4>
                </div>
            <?php } ?>

        </div>

    </div>
</body>

</html>