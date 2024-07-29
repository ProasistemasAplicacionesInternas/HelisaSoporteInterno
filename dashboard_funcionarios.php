<?php
ini_set("session.cookie_lifetime", 18000);
ini_set("session.gc_maxlifetime", 18000);

session_start();
$_SESSION['rol'];
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header('location:login_peticiones.php');
}
if (!isset($_SESSION['status_connect'])) {
    header('location:login_peticiones.php');
}
if (isset($_SESSION['init'])) {
    $_SESSION['init'] = 1;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/dashboard.css" media="screen" type="text/css">
    <link rel="stylesheet" href="public/css/daterangepicker.css" media="screen" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
    <link rel="icon" type="image/png" href="public/img/ico.png" />
    <link rel="stylesheet" href="public/css/smoke.min.css">
</head>

<body>
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="public/img/logo.png" alt="">
            </div>
            <div class="col-md-2 col d-flex justify-content-end">
                <span id='usuario'><?= $_SESSION['usuario']; ?></span>
                <a href="../model/datos_funcionarios.php" data-toggle="modal" data-target="#datos-funcionario" data-backdrop="static"><img src="public/img/configura.png" alt=""></a>
                <a href="#" onclick="showBox(); closeBoxOnOutsideClick();"><img class="icon" src="public/img/iconoVersiones.png"></a>
                <a href="app/controller/cerrar_loginF.php"><img src="public/img/salir.png" alt=""></a>
            </div>
        </div>
    </header>
    <div id="caja" style="display:none;">
        <div class="fila">
            <img class="icons" id="datoPlataforma" src="public/img/datoPlataforma.png"><span id="plataforma"></span>
        </div>
        <div class="fila">
            <img class="icons" id="datoAdmin" src="public/img/datoAdmin.png"><span id="administrador"></span>
        </div>
        <div class="fila">
            <img class="icons" id="datoVersion" src="public/img/datoVersion.png" alt=""><span id="version"></span>
        </div>
        <div class="fila">
            <img class="icons" id="datoFecha" src="public/img/datoFecha.png" alt=""><span id="fechaVersion"></span>
        </div>
    </div>
    <main class="container-fluid">
        <div class="row">

            <div class="col-2 mt-3 navega">
                <nav>
                    <div class="dropdown">
                        <a class=" dropdown-toggle" id="validationTicket" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                            <img src="public/img/soporte.png" class="ml-3">
                            <span>Solicitudes</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropTicket">
                            <a href="#" id="generar_solicitud"><img src="public/img/soporte.png" class="ml-3">Infraestructura</a>
                            <a href="#" id="vista_solicitudesmai"><img src="public/img/soporte.png" class="ml-3">Aplic. Internas</a>
                            <a href='#' id="vista_solicitudsg" ><img src="public/img/soporte.png" class="ml-3">Seguridad</a>
                        </div>
                    </div>

                    <a href="#" id="activos_asignados"><img src="public/img/soporte.png" alt="" class="ml-3" onclick:>
                        <span>Asignaciones</span>
                    </a>
                    <a id="validationBoveda" style="cursor: pointer;"><img src="public/img/soporte.png" alt="" class="ml-3" onclick:><!-- data-toggle="modal"  data-target="#claveBovedaModal" target="_blank" id='modalBovedaOpen'  // abre la modal con html-->
                        <span>Bóveda</span>
                    </a>

                    <?php if ($_SESSION['rol'] == 2) {
                        echo '<a href="#" id="control_actividades_administracion"><img src="public/img/cartera.png" alt="" class="ml-3">Control Actividades</a>';
                    } ?>

                    <div class="dropdown">
                        <a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;"> <img src="public/img/consultas.png" class="ml-3"><span>Consultar Solicitudes</span></a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a href="#" id="peticiones_funcionario"><img src="public/img/consultas.png" class="ml-3">Infraestructura</a>

                            <a href="#" id="peticionesmai_funcionario"><img src="public/img/consultas.png" class="ml-3">Aplic. Internas</a>

                        </div>
                    </div>

                    <div class="dropdown">
                        <a class="dropdown-toggle" style="cursor: pointer;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sitemap fa-2x ml-4 mr-2" style="color:#808080;"></i><span>Gestión De Procesos</span></a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="#" id="datosFuncionarios" hidden><i class="fa fa-user fa-2x ml-4 mr-2"></i><span>Datos Funcionarios</span></a>
                            <a href="#" id="accesos"><i class="fas fa-sign-in-alt fa-2x ml-4 mr-2"></i><span>Solicitud accesos</span></a>
                        </div>

                    </div>

                </nav>

            </div>
            <div class="col-10" id="contenido"><!-- //pendiente -->
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-6" hidden id='notificacionDirectores'>
                            <h5 style="color:#5BB94B; font-size:1rem;"><u>Estado peticiones Delegadas </u></h5>
                            <h5 style="font-size:1rem;">Peticiones nuevas:
                                <b id='D1'></b>
                            </h5>
                            <h5 style="font-size:1rem;">Peticiones pendientes:
                                <b id='D2'></b>
                            </h5>
                            <h5 style="font-size:1rem;">Peticiones seleccionadas:
                                <b id='D3'></b>
                            </h5>
                            <h4 style="font-size:1rem;"><i class="far fa-eye fa-2x"></i> Peticiones por atender:
                                <b id='D4'></b>
                            </h4>
                        </div>
                        <div class="col-6" hidden id='notificacionAdministradores'>
                            <h5 style="color:#5BB94B; font-size:1rem;"><u>Estado Soporte de Accesos </u></h5>
                            <h5 style="font-size:1rem;">Peticiones nuevas:
                                <b id='S1'></b>
                            </h5>
                            <h5 style="font-size:1rem;">Peticiones pendientes:
                                <b id='S2'></b>
                            </h5>
                            <h5 style="font-size:1rem;">Peticiones seleccionadas:
                                <b id='S3'></b>
                            </h5>
                            <h4 style="font-size:1rem;"><i class="far fa-eye fa-2x"></i> Peticiones por atender:
                                <b id='S4'></b>
                            </h4>
                        </div>
                        <div class="col-12">
                            <img src="public/img/www.png" alt="" class="ml-3" style="width: 75%; float: right; margin: 0% 25%; opacity:0.7;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <?php require('app/view/clave_acceso_boveda.php'); ?>
    <script src="public/js/modifica_boveda.js?6y5"></script>
    <script src="public/js/moment.min.js"></script>
    <script src="public/js/daterangepicker.js"></script>
    <script src="public/js/popper.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/navega_funcionarios.js"></script>
    <?php require('app/view/cambioContrasena_funcionarios.php'); ?>
    <script src="public/js/cambioContrasena_funcionarios.js?hh"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <script src="public/js/contenidoBoardFuncionarios.js"></script>
    <script src="public/js/version.js"></script>

</body>
<script type="text/javascript">
    $(document).keydown(function(event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });
    $(document).ready(function() {
        //Disable full page
        $("body").on("contextmenu", function(e) {
            return false;
        });

        //Disable part of page
        $("#id").on("contextmenu", function(e) {
            return false;
        });
    });
</script>

</html>