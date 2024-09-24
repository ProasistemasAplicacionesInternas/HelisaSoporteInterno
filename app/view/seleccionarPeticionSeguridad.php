<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Aplicaciones Internas</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/peticion.css" media="screen" type="text/css">
    <link rel="stylesheet" href="../../public/css/peticionesmai.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
    <link rel="stylesheet" href="../../public/css/seleccionarPeticionesMai.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/fontSizeSg.css">

</head>

<body>
    <?php
    header('Cache-Control: no cache'); //duplicidad pantalla
    session_cache_limiter('private_no_expire'); //
    ini_set("session.cookie_lifetime", 18000);
    ini_set("session.gc_maxlifetime", 18000);

    session_start();
    if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
        header('location:../../login.php');
    } else {
        $user = $_SESSION['usuario'];
    }

    include('../controller/controladorSeleccionPeticion.php');
    $codigo = $_POST['pNropeticion'];
    $fechapeticion = $_POST['pFechapeticion'];
    $usuario = $_POST['pUsuario'];
    $Area = $_POST['areaSg'];
    $correo = $_POST['pCorreo'];
    $categoria = $_POST['pCategoria'];
    $descripcion = $_POST['pDescripcion'];
    $imagen = $_POST['pCargarimagen'];
    $imagen2 = $_POST['pCargarimagen2'];
    $imagen3 = $_POST['pCargarimagen3'];
    $imagen4 = $_POST['pCargarimagen4'];
    $imagen5 = $_POST['pCargarimagen5'];
    $estado = $_POST['pEstado'];
    $conclusiones = $_POST['pConclusiones'];


    require_once("../controller/traeObservacionesSg.php");

    ?>
    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div>
            <div class='box1'>
                <form action="../controller/controladorSoporteSeguridad.php" method="post" enctype="multipart/form-data">
                    <div style="display:none">
                        <input type="text" id="user" name="user" class="form-control" value="<?php echo $user; ?>" readonly>
                    </div>
                    <div class="row">
                        <div class="peq">
                            <label>Cod</label>
                            <input type="text" id="pNropeticion" name="pNropeticion" class="form-control" value="<?php echo $codigo; ?>" readonly>
                        </div>
                        <div class="medium">
                            <label>Fecha Solicitud</label>
                            <input type="text" id="pFechapeticion" name="pFechapeticion" class="form-control" value="<?php echo  $fechapeticion; ?>" readonly>
                        </div>
                        <div class="medium">
                            <label>Usuario</label>
                            <input type="text" id="pUsuario" name="pUsuario" class="form-control" value="<?php echo  $usuario; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="peq">
                            <label>Area</label>
                            <input type="text" id="areaSg" name="areaSg" class="form-control" value="<?php echo $Area; ?>" readonly>
                        </div>
                        <div class="littlebig">
                            <label>Correo</label>
                            <input type="text" id="pCorreo" name="pCorreo" class="form-control" value="<?php echo $correo; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="giant">
                            <label>Categoria</label>
                            <input type="text" id="pCategoria" name="pCategoria" class="form-control" value="<?php echo $categoria; ?>  " readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="giant">
                            <label for="">Descripción</label>
                            <textarea id="pDescripcion" name="pDescripcion" class="form-control col-12" rows="4" readonly><?php echo $descripcion; ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="littleMedium">
                            <label id="label">Estado</label>
                            <select name="pEstado" id="pEstado" class="selectView" required>
                                <option value="" selected>seleccione un estado</option>
                                <option value="2">Resuelto</option>
                                <option value="3">Pendiente</option>
                                <option value="22">En Proceso</option>
                            </select>
                        </div>
                        <div class="ml-3 d-flex flex-column align-items-start">
                            <label id="label">Documentos Adjuntos</label>
                            <button type="button" class="btn btn-primary btn-ver-documentos" data-toggle="modal" data-target="#documentModal">
                                Ver Documentos del Ticket
                            </button>
                        </div>
                    </div>

                    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="documentModalLabel">Documentos del Ticket #<?php echo htmlspecialchars($codigo, ENT_QUOTES, 'UTF-8'); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <?php

                                        $archivos = CrudPeticionesSg::obtenerArchivosDeTicket($codigo);

                                        if (count($archivos) > 0) {
                                            foreach ($archivos as $indice => $archivo) {
                                                $filePath = __DIR__ . '/../../documentSg/' . $archivo;
                                                $columna = $indice == 0 ? 'imagen' : 'imagen' . ($indice + 1);
                                                if (file_exists($filePath)) {
                                                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                                    echo '<div class="d-flex align-items-center">';
                                                    echo '<input type="radio" name="archivoSeleccionado" value="' . htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8') . '" class="mr-3">';
                                                    echo '<span>' . htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8') . '</span>';
                                                    echo '<a href="../../documentSg/' . htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8') . '" target="_blank" class="ml-3">Ver Documento</a>';
                                                    echo '</div>';

                                                    echo '<input type="file" id="archivoInput_' . htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8') . '" style="display:none;">';

                                                    echo '<div class="d-flex align-items-center">';
                                                    echo '<button type="button" class="btn btn-warning btn-sm btn-reemplazar-personalizado" onclick="abrirExploradorArchivo(\'' . htmlspecialchars($archivo, ENT_QUOTES, 'UTF-8') . '\', ' . htmlspecialchars($codigo, ENT_QUOTES, 'UTF-8') . ', \'' . $columna . '\')">Reemplazar</button>';
                                                    echo '</div>';

                                                    echo '</li>';
                                                } else {
                                                    echo "<li class=\"list-group-item text-danger\">El archivo $archivo no está disponible.</li>";
                                                }
                                            }
                                        } else {
                                            echo "<p>No se ha subido ningún archivo relacionado con este ticket.</p>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="giant">
                            <label for="">Observaciones</label>
                            <textarea id="pConclusiones" name="pConclusiones" class="form-control col-12" rows="8" required><?= strip_tags('<br/>') ?></textarea>
                        </div>
                        <br></br>
                    </div>
 
                    <div class="row">
                        <div class="giant">
                            <input type="submit" value="Guardar" id="aceptar" name="aceptar" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class='col-6 box2'>
                <?php if (count($observaciones) != 0) :
                    foreach ($observaciones as $observacion) {
                ?>
                        <div class="boxObs">
                            <div class="row">
                                <div class="medium">
                                    <label>Fecha </label>
                                    <input type="text" id="obsData" name="obsData" class="form-control" value="<?php echo $observacion['fecha_observacion']; ?>  " readonly>
                                </div>

                                <div class="littleMedium">
                                    <label>Usuario </label>
                                    <input type="text" id="obsUser" name="obsUser" class="form-control" value="<?php echo $observacion['usuario_creacion']; ?>  " readonly>
                                </div>

                                <div class="little">
                                    <label>Estado </label>
                                    <input type="text" id="obsStatus" name="obsStatus" class="form-control" value="<?php echo $observacion['estado']; ?>  " readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="giant">
                                    <label for="">Observaciones</label>
                                    <textarea id="obs" name="obs" class="form-control" rows="4" readonly><?php echo  $observacion['descripcion_observaciones'] ?></textarea>
                                </div>
                            </div>
                            <div class="line row">
                                <div class="giant">

                                </div>
                            </div>
                        </div>
                <?php
                    }
                endif;
                ?>
            </div>
        </div>
    </div>

    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/abrirExploradorArchivo.js"></script>

</body>

</html>