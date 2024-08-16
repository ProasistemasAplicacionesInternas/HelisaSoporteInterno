<?php
ini_set("session.cookie_lifetime", 180000);
ini_set("session.gc_maxlifetime", 180000);


session_start();
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header('location:login.php');
}
if (!isset($_SESSION['id_roles'])) {
    header('location:login.php');
}
if (!isset($_SESSION['status_connect'])) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Interno</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/dashboard.css" media="screen" type="text/css">
    <link rel="stylesheet" href="public/css/daterangepicker.css" media="screen" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/v4-shims.css">
    <link rel="icon" type="image/png" href="public/img/ico.png" />
    <script src="https://kit.fontawesome.com/af5bdaf378.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="public/img/logoHelisa.png" alt="">
            </div>
            <div class="col-md-2 col d-flex justify-content-end">
                <span>
                    <?= $_SESSION['usuario']; ?>
                </span>
                <a href="../model/datos_usuario.php" data-toggle="modal" data-target="#datos-usuario" data-backdrop="static"><img src="public/img/configura.png" alt=""></a>
                <a href="#" onclick="showBox(); closeBoxOnOutsideClick();"><img class="icon" src="public/img/iconoVersiones.png"></a>
                <a href="app/controller/cerrar.php"><img src="public/img/salir.png" alt=""></a>
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
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) {
                            echo '<a  style="cursor: pointer;" class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="public/img/user.png" alt="" class="ml-3"><span>Soportes</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a href="#" id="solicitudes_internasAdmin"><img src="public/img/soporte.png" alt="" class="ml-3" onclick:>Aplicaciones</a>

                            <a href="#" id="solicitudes_infraestructuraAdmin""><img src=" public/img/soporte.png" alt="" class="ml-3" onclick:>Infraestructura</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="public/img/atendiendo.png" alt="" class="ml-3"><span>Liberar Soporte</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="#" id="liberar_maiAdmin"><img src="public/img/atendiendo.png" alt="" class="ml-3" onclick:>Aplicaciones</a>
                            <a href="#" id="liberarAdmin"><img src="public/img/atendiendo.png" alt="" class="ml-3" onclick:>Infraestructura</a>
                        </div>
                    </div>
                    <?php if ($_SESSION['id_roles'] == 3 || $_SESSION['id_roles'] == 5) {
                        echo '<a href="#" id="solicitudes_internas"><img src="public/img/soporte.png" alt="" class="ml-3" onclick:>Solicitudes Internas</a>';
                    } ?>

                    <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 5) {
                        echo '<a href="#" id="requerimientos"><img src="public/img/soporte.png" alt="" class="ml-3" onclick:>Requerimientos</a>';
                    } ?>

                    <?php if ($_SESSION['id_roles'] == 5) {
                        echo '<a href="#" id="liberar_mai"><img src="public/img/atendiendo.png" alt="" class="ml-3" onclick:>Atendiendo</a>';
                    } ?>


                    <?php if ($_SESSION['id_roles'] == 9 || $_SESSION['id_roles'] == 6) {
                        echo '<a href="#" id="asistencia"><img src="public/img/soporte.png" alt="" class="ml-3" onclick:>Soportes</a>';
                    } ?>

                    <?php if ($_SESSION['id_roles'] == 9 || $_SESSION['id_roles'] == 6) {
                        echo '<a href="#" id="liberar"><img src="public/img/atendiendo.png" alt="" class="ml-3" onclick:>Atendiendo</a>';
                    } ?>

                    <div class="dropdown">
                        <?php
                        if (
                            $_SESSION['id_roles'] == 1 ||
                            $_SESSION['id_roles'] == 5 ||
                            $_SESSION['id_roles'] == 6 ||
                            $_SESSION['id_roles'] == 7 ||
                            $_SESSION['id_roles'] == 8 ||
                            $_SESSION['id_roles'] == 9
                        ) {
                            echo '<a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="public/img/consultas.png" alt="" class="ml-3">
                                    <span>Consultas</span>
                                </a>';
                        }
                        ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            if (
                                $_SESSION['id_roles'] == 1 ||
                                $_SESSION['id_roles'] == 6 ||
                                $_SESSION['id_roles'] == 7 ||
                                $_SESSION['id_roles'] == 9 ||
                                $_SESSION['id_roles'] == 5
                            ) {
                                echo '<a href="#" id="consultarPeticiones" class="dropdown-item">
                                        <img src="public/img/consultas.png" alt="" class="ml-3">
                                        Consultas-Ticket
                                    </a>';
                            }
                            ?>

                            <?php
                            if (
                                $_SESSION['id_roles'] == 1 ||
                                $_SESSION['id_roles'] == 7 ||
                                $_SESSION['id_roles'] == 8 ||
                                $_SESSION['id_roles'] == 5
                            ) {
                                echo '<a href="#" id="consultarIso" class="dropdown-item">
                                        <img src="public/img/consultas.png" alt="" class="ml-3">
                                        Consultas-ISO
                                    </a>';
                            }
                            ?>

                            <?php
                            if (
                                $_SESSION['id_roles'] == 1 ||
                                $_SESSION['id_roles'] == 5
                            ) {
                                echo '<a href="#" id="consultarRequerimiento" class="dropdown-item">
                                        <img src="public/img/consultas.png" alt="" class="ml-3">
                                        Consultas-Requerimientos
                                    </a>';
                            }
                            ?>

                            <?php
                            if (
                                $_SESSION['id_roles'] == 1 ||
                                $_SESSION['id_roles'] == 6 ||
                                $_SESSION['id_roles'] == 7 ||
                                $_SESSION['id_roles'] == 9 ||
                                $_SESSION['id_roles'] == 5
                            ) {
                                echo '<a href="#" id="comentariosPeticiones" class="dropdown-item">
                                        <img src="public/img/Comentarios.png" alt="" class="ml-3">
                                        Comentarios
                                    </a>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 6 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="public/img/user.png" alt="" class="ml-3"><span>Funcionarios</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 6 || $_SESSION['id_roles'] == 9) {
                                echo '<a href="#" id="funcionarios"><img src="public/img/user.png" alt="" class="ml-3">Activos</a>';
                            } ?>

                            <?php /*if ($_SESSION['id_roles']==1 || $_SESSION['id_roles']==7 || $_SESSION['id_roles']==9) {echo '<a href="#" id="funcionarios_Inactivos"><img src="public/img/inactivos.png" alt="" style="width: 27px; margin: 0px 9px" class="ml-4">Inactivos</a>';}*/ ?>
                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                                echo '<a href="#" id="funcionarios_Inactivos"><img src="public/img/inactivos.png" alt="" style="width: 27px; margin: 0px 9px" class="ml-4">Inactivos por Intentos</a>';
                            } ?>

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) {
                                echo '<a href="#" id="funcionarios_Retirados"><img src="public/img/inactivos.png" alt="" style="width: 27px; margin: 0px 9px" class="ml-4">Inactivos por Retiro</a>';
                            } ?>

                        </div>
                    </div>


                    <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                        echo '<a href=#"" id="servidores"><img src="public/img/servidores.png" alt="" class="ml-3" style="padding-left:5px; padding-right:5px;"><span>Servidores</span></a>';
                    } ?>

                    <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                        echo '<a href="#" id="maquinas"><img src="public/img/maquinas.png" alt="" class="ml-3" style="padding-left:5px; padding-right:5px;"><span>M&aacute;quinas</span></a>';
                    } ?>

                    <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 2 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 6 || $_SESSION['id_roles'] == 9) {
                        echo '<a href="#" id="activos"><img src="public/img/clientes.png" alt="" class="ml-3">Activos Fijos</a>';
                    } ?>

                    <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 2 || $_SESSION['id_roles'] == 6 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 8 || $_SESSION['id_roles'] == 9) {
                        echo '<a href="#" id="control_actividades"><img src="public/img/cartera.png" alt="" class="ml-3">Control Actividades</a>';
                    } ?>


                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="public/img/user.png" alt="" class="ml-3"><span>Usuarios</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                                echo '<a href="#" id="usuarios"><img src="public/img/user.png" alt="" class="ml-3"><spam>Activos</spam></a>';
                            } ?>

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                                echo '<a href="#" id="usuarios_inactivos"><img src="public/img/user.png" alt="" class="ml-3"><spam>Inactivos</spam></a>';
                            } ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0% 10%;"> <i class="fab fa-readme" class="ml-3" style="font-size: 18px;margin: 0% 2%;color: #6b6b6b;"></i><span style="margin: 0% 0% 0% 4%;">Registros</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-width:15rem !important; width: 100%">

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) {
                                echo '<a href="#" id="ingresos"><i class="fas fa-user-clock" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Ingresos-Usuarios</spam></a>';

                                echo '<a href="#" id="ingresos-funcionarios"><i class="fas fa-user-clock" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Ingresos-Funcionarios</spam></a>';

                                echo '<a href="#" id="accesos"><i class="fas fa-user-clock" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Accesos-Usuarios</spam></a>';

                                echo '<a href="#" id="accesos-funcionarios"><i class="fas fa-user-clock" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Accesos-Funcionarios</spam></a>';
                            } ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9 || $_SESSION['id_roles'] == 10) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0% 10%;"> <i class="fa fa-code-fork" class="ml-3" style="font-size: 18px;margin: 0% 2%;color: #6b6b6b;"></i><span style="margin: 0% 0% 0% 4%;">Organigrama</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-width:15rem !important; width: 100%">

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9 || $_SESSION['id_roles'] == 10) {
                                echo '<a href="#" id="departamentos"><i class="fa fa-code-fork" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Departamentos</spam></a>';
                            } ?>

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9 || $_SESSION['id_roles'] == 10) {
                                echo '<a href="#" id="areas"><i class="fa fa-code-fork" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Áreas</spam></a>';
                            } ?>

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9 || $_SESSION['id_roles'] == 10) {
                                echo '<a href="#" id="cargos"><i class="fa fa-code-fork" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Cargos</spam></a>';
                            } ?>

                            <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 9) {
                                echo '<a href="#" id="centroCostos"><i class="fa fa-code-fork" class="ml-3" style="font-size: 15px;margin: 2%;"></i><spam style="font-size: 14px;margin-left: 4%;">Centros de Costos</spam></a>';
                            } ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 1) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin: 0% 10%;"> <i class="fas fa-sitemap fa-2x mr-2"  class="ml-3" style="font-size: 18px;margin: 0% 2%;color: #6b6b6b;"></i><span>Gestión de Procesos</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-width:15rem !important; width: 100%">

                            <?php if ($_SESSION['id_roles'] == 7 || $_SESSION['id_roles'] == 1) {
                                echo '<a href="#" id="gestion_accesos"><i class="fas fa-sign-in-alt fa-lg mr-1"></i><spam style="font-size: 14px;margin-left: 4%;">Gestión de Accesos</spam></a>';
                            } ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1 || $_SESSION['id_roles'] == 7) {
                            echo '<a class=" dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;  color: gray;"><i class="fa fa-desktop" class="ml-3" style="font-size: 15px; margin: 0% 0% 0% 10%;"></i><span style="font-size: 12px;margin-left: 3%;">Plataformas</span></a>';
                        } ?>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a href="#" id="plataformasActivas"><i alt="" class="fa fa-circle ml-3 " onclick:></i><span class="ml-2">Plataformas Activas</span></a>

                            <a href="#" id="plataformasInactivas"><i alt="" class="fa fa-circle-o ml-3 " onclick:></i><span class="ml-2" s>Plataformas Inactivas</span></a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <?php if ($_SESSION['id_roles'] == 1) {
                            echo '<a href=#"" id="uvts"><img class="ml-3" style="padding-left:5px; padding-right:5px;"><i class="fa-solid fa-stamp"  class="ml-3" style="font-size: 18px;margin: 0% 2%;color: #6b6b6b;"></i><span>Uvts</span></a>';
                        } ?>
                        <?php if ($_SESSION['id_roles'] == 1) {
                            echo '<a href=#"" id="categories"><img class="ml-3" style="padding-left:5px; padding-right:5px;"><i class="fa-solid fa-chalkboard-user"  class="ml-3" style="font-size: 18px;margin: 0% 2%;color: #6b6b6b;"></i><span> Categorías</span></a>';
                        } ?>
                    </div>
                </nav>
            </div>

            <div class="col-10" id="contenido">
                <div class="container mt-5">
                    <div class="row">

                        <?php require_once('app/view/contenido_board.php') ?>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/moment.min.js"></script>
    <script src="public/js/daterangepicker.js"></script>
    <script src="public/js/popper.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/navega.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>

    <?php require('app/view/actualiza_usuario.php'); ?>

    <script>
        $(document).ready(function() {
            var refreshId = setInterval(function() {

                $('#infos2').load('app/view/liberar_soportes.php'); //actualizacion constante de la pestaña liberar
                $('#infos3').load('app/view/consultar_peticiones.php'); //actualizacion constante de la pestaña soportes
                $('#infoServicios').load('app/view/contenido_board.php'); //actualizacion constante de la pantalla principal informativa
                $('#infosSolicitudesInternas').load('app/view/solicitudes_internas.php');
                $('#infosMai').load('app/view/liberar_solicitudesmai.php');
            }, 1000);
        });
    </script>
    <script>
    $(document).ready(function(){
        $('#actualizar').click(function(){
            $('#tabla-body').load('app/view/requerimientos.php #tabla-body');
        });
    });
</script>

    <script src="public/js/valida_usuario.js?jk"></script>
    <script src="public/js/version.js"></script>
</body>

</html>