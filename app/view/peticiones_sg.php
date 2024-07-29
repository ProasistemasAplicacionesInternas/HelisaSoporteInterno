<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />

</head>

<body>

    <?php
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();

    if (!isset($_SESSION['usuario'])) {

        header('location:../../login_peticiones.php');
    }

    require_once('../model/crud_peticionesSg.php');
    require_once('../model/datosPeticionesSeguridad.php');

    $consultar = new CrudPeticionesSg();
    $datos = new PeticionSg();
    $consultaPeticionesSg = $consultar->consultarPeticionesFuncionarioSeguridad();

    ?>
    <div class="container-fluid" id="infoPeticionSeguridad">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Solicitudes Seguridad</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="app/view/crear_peticionSg.php">
                    <h8> Generar Solicitud</h8><img src="public/img/nuevo.png" alt="">
                </a>

            </div>
            <div class="col">
                <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                        <th style="width:10px;">Nro. Ticket</th>
                        <th style="width:30px;">Usuario Solicitante</th>
                        <th style="width:30px;">Fecha Solicitud</th>
                        <th style="width:30px;">Área</th>
                        <th style="width:30px;">Categoria</th>
                        <th style="width:30px;">Estado</th>
                        <th style="width:30px;">Atiende</th>
                        <th style="width:30px;">Modificar</th>
                    </thead>
                    <?php foreach ($consultaPeticionesSg as $datos) : ?>
                        <tr>
                            <td>
                                <?php echo $datos->getid_peticionSg() ?></td>
                            <td>
                                <?php echo $datos->getusuario_creacionSg() ?></td>
                            <td>
                                <?php echo $datos->getfecha_peticionSg() ?></td>
                            <td>
                                <?php echo $datos->getarea_funcionario() ?></td>
                            <td>
                                <?php echo $datos->getcategoriaSg() ?></td>
                            <td>
                                <?php echo $datos->getestado_peticionSg() ?></td>
                            <td>
                                <?php echo $datos->getusuario_atencionSg() ?></td>
                            <td>
                                <?php echo $datos->getconclusiones_PeticionSg() ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </table>
            </div>

        </div>
    </div>
    <script src="public/js/marcar_revisado.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>