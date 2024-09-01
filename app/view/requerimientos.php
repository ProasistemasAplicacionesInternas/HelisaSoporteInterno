<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" href="public/css/plataformasEstilos.css">
    <link rel="stylesheet" href="public/css/botonActualizar.css">
    <link rel="stylesheet" href="public/css/fixed-top-right.css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <link rel="stylesheet" href="public/css/smoke.min.css">

</head>

<body>
    <?php
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {

        header('location:../../login.php');
    }

    require('../model/crud_peticionesmai.php');
    require('../model/datos_peticionesmai.php');

    $crud = new CrudPeticionesMai();
    $datos1 = new PeticionMai();

    $consultarRequerimientos = $crud->consultarRequerimientos();
    $ticketsHelisaCloud = $crud->clientesHelisaPlus();
    $ticketsHelisaPremium = $crud->clientesHelisaPremium();
    $ticketsHelisaReco = $crud->clientesHelisaReco();
    $ticketsHelisaSoporteInterno = $crud->clientesSoporteInterno();
    $ticketsHelisaDyMAI = $crud->clientesHelisaDymai();
    $ticketsHelisaCentroSoporte = $crud->clientesCentroSoporte();
    $ticketsHelisaCrmRegistro = $crud->CRMRegistro();
    $ticketsHelisaTalento = $crud->clientesHelisaTalento();
    $ticketsHelisaConekta = $crud->clientesHelisaConekta();
    $ticketsHelisaInstaladorComplementos = $crud->helisaComplementos();
    $ticketsHelisaAtento = $crud->helisaAtento();
    $ticketsAvivoChatbot = $crud->aivoChatbot();
    $ticketsCemex = $crud->Cemex();
    $ticketsHelisaTablero = $crud->helisaTablero();
    $ticketsRedireccionadoInfraestructura = $crud->reInfraestructura();

    ?>

    <div class="container-fluid " id="infoRequerimientos" name="infoRequerimientos">
        <div class="row">
            <div class="col-11 mt-4 pl-5">
                <h6>Requerimientos</h6>
            </div>
 
            <div class="fixed-top-right" id="total">
                <button class="boton-imagen" type="button" data-toggle="modal" data-target="#infoModal">
                    <img src="public/img/Grafico-64px.png" alt="total">
                </button>
            </div>

            <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel">Información de Tickets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <table class="tablaT">
                                    <thead>
                                        <tr>
                                            <th> Requerimiento</th>
                                            <th>Total Solicitudes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-left">Helisa Cloud</th>
                                            <?php foreach ($ticketsHelisaCloud as $datosH) : ?>
                                                <td><?= $datosH->getHelisacloud() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Premium</th>
                                            <?php foreach ($ticketsHelisaPremium as $datosP) : ?>
                                                <td><?= $datosP->getHelisapremium() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Reco</th>
                                            <?php foreach ($ticketsHelisaReco as $datosR) : ?>
                                                <td><?= $datosR->getHelisaReco() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Soporte Interno</th>
                                            <?php foreach ($ticketsHelisaSoporteInterno as $datosS) : ?>
                                                <td><?= $datosS->getSoporteinterno() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Dymai</th>
                                            <?php foreach ($ticketsHelisaDyMAI as $datosD) : ?>
                                                <td><?= $datosD->getHelisadymai() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Centro de Soporte</th>
                                            <?php foreach ($ticketsHelisaCentroSoporte as $datosCs) : ?>
                                                <td><?= $datosCs->getCentrosoporte() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">CRM-Registro</th>
                                            <?php foreach ($ticketsHelisaCrmRegistro as $datosCR) : ?>
                                                <td><?= $datosCR->getCRMregistro() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Talento</th>
                                            <?php foreach ($ticketsHelisaTalento as $datosTal) : ?>
                                                <td><?= $datosTal->getHelisatalento() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Conekta</th>
                                            <?php foreach ($ticketsHelisaConekta as $datosCok) : ?>
                                                <td><?= $datosCok->getHelisaconekta() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Complementos</th>
                                            <?php foreach ($ticketsHelisaInstaladorComplementos as $datosIc) : ?>
                                                <td><?= $datosIc->getHelisacomplementos() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Atento</th>
                                            <?php foreach ($ticketsHelisaAtento as $datosAte) : ?>
                                                <td><?= $datosAte->getHelisaAtento() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Aivo ChatBot</th>
                                            <?php foreach ($ticketsAvivoChatbot as $datosAiv) : ?>
                                                <td><?= $datosAiv->getAivochatbot() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Cemex</th>
                                            <?php foreach ($ticketsCemex as $datosCx) : ?>
                                                <td><?= $datosCx->getHelisacemex() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Helisa Tablero</th>
                                            <?php foreach ($ticketsHelisaTablero as $datosTab) : ?>
                                                <td><?= $datosTab->getHelisatablero() ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-sm" style="margin-bottom: 2px;" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="imagen" id="actualizar">
                <button class="boton-imagen" type="button">
                    <img src="public/img/refresh.png" alt="actualizar">
                </button>
            </div>

            <div class="col containerReq">
                <table class="table table-striped" id="tabla">
                    <thead style="background-color:#d7007bb3; text-align:center; color:white;">
                        <th>Nro Ticket</th>
                        <th>Usuario</th>
                        <th>Fecha solicitud</th>
                        <th>Area</th>
                        <th>Extension</th>
                        <th>Tipo de peticion</th>
                        <th>Producto</th>
                        <th>Gestionado</th>
                        <th>Sprint</th>
                        <th>Atiende</th>
                        <th>Estado</th>
                        <th>Tiempo</th>
                        <th>Modificar</th>
                    </thead>

                    <tbody>
                        <?php foreach ($consultarRequerimientos as $datos1) : ?>
                            <?php
                            $estadoColor = 'white';
                            switch ($datos1->getEstado_peticionMai()) {
                                case 'Gestión de Cambios':
                                    $estadoColor = '#FFA500';
                                    break;
                                case 'En Desarrollo':
                                    $estadoColor = '#66CC66';
                                    break;
                                case 'En Pruebas':
                                    $estadoColor = '#FFD700';
                                    break;
                                case 'Cargue de Versión':
                                    $estadoColor = '#6495ED';
                                    break;
                                default:
                                    $estadoColor = 'white';
                                    break;
                            }
                            ?>
                            <tr style="text-align:center;">
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getId_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getUsuario_creacionMai(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getFecha_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getArea_funcionario(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getExtension_funcionario(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getName(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getProducto_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getGestion(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getSprint(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getUsuario_atencionMai(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php echo $datos1->getEstado_peticionMai(); ?>
                                </td>
                                <td style="background-color:<?php echo $estadoColor; ?>;">
                                    <?php
                                    date_default_timezone_set('America/Bogota');
                                    $fecha1 = new DateTime($datos1->getFecha_peticionMai());
                                    $fecha2 = new DateTime('now');

                                    $intervalo = $fecha2->diff($fecha1);
                                    echo $intervalo->format('%m:%D:%H:%I:%S');
                                    ?>
                                <td style="background-color:<?php echo $datos1->getEstado_peticionMai() === 'Pendiente' . 'Gestión de Cambios' . 'En Desarrollo' . 'En pruebas' . 'Cargue de Versión' ? 'white' : 'white' ?>;">

                                    <form action="app/view/seleccionar_peticionmai.php" method="post">
                                        <input type="hidden" name="p_nropeticion" id="p_nropeticion" value="<?php echo $datos1->getId_peticionMai(); ?>">

                                        <input type="hidden" name="req_nombre" id="req_nombre" value="<?php echo $datos1->getReq_Name(); ?>">

                                        <input type="hidden" name="req_justificacion" id="req_justificacion" value="<?php echo $datos1->getReq_Justification(); ?>">

                                        <input type="hidden" name="p_fechapeticion" id="p_fechapeticion" value="<?php echo $datos1->getFecha_peticionMai(); ?>">

                                        <input type="hidden" name="p_usuario" id="p_usuario" value="<?php echo $datos1->getUsuario_creacionMai(); ?>">

                                        <input type="hidden" name="p_extension" id="p_extension" value="<?php echo $datos1->getExtension_funcionario(); ?>">

                                        <input type="hidden" name="p_correo" id="p_correo" value="<?php echo $datos1->getEmail_funcionario(); ?>">

                                        <input type="hidden" name="p_categoria" id="p_categoria" value="<?php echo $datos1->getProducto_peticionMai() ?>">

                                        <input type="hidden" name="p_descripcion" id="p_descripcion" value="<?php echo $datos1->getDescripcion_peticionMai(); ?>">

                                        <input type="hidden" name="p_cargarimagen" id="p_cargarimagen" value="<?php echo $datos1->getImagen_peticionMai(); ?>">

                                        <input type="hidden" name="p_cargarimagen2" id="p_cargarimagen2" value="<?php echo $datos1->getImagen_peticionMai2(); ?>">

                                        <input type="hidden" name="p_cargarimagen3" id="p_cargarimagen3" value="<?php echo $datos1->getImagen_peticionMai3(); ?>">

                                        <input type="hidden" name="p_estado" id="p_estado" value="<?php echo $datos1->getEstado_peticionMai(); ?>">

                                        <input type="hidden" name="soporteMai" id="soporteMai" value="<?php echo $datos1->getName(); ?>">

                                        <input type="hidden" name="p_conclusiones" id="p_conclusiones" value="<?php echo $datos1->getConclusiones_peticionMai(); ?>">

                                        <input type="hidden" name="p_sprint" id="p_sprint" value="<?php echo $datos1->getSprint(); ?>">

                                        <input type="hidden" name="p_gestion" id="p_gestion" value="<?php echo $datos1->getGestion(); ?>">

                                        <input type="button" value="Seleccionar" class="btn btn-primary" onclick="validarBoton('<?php echo $_SESSION['usuario']; ?>',<?php echo $datos1->getId_peticionMai(); ?>)">

                                        <input type="submit" value="Seleccionar" name="seleccionar_peticionmai" id="seleccionar_peticionmai<?php echo $datos1->getId_peticionMai(); ?>" class="btn btn-warning" style="display:none;">
                                    </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/validacion_seleccionar.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    <script src="public/js/botonActualizarRequerimientos.js"></script>

</body>

</html>