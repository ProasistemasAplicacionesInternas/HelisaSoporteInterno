<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/peticion.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />

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
    }

    if (!isset($_POST['p_nropeticion'])) {
        header('location:../../login.php');
    }


    require('../model/crudPeticionesFuncionarios.php');
    require('../model/datosPeticion.php');

    $crud = new CrudPeticiones();
    $datos1 = new Peticion();

    $consultaPeticiones = $crud->consultarPeticiones();


    include('../controller/controlador_seleccionPeticion.php');
    $codigo = $_POST['p_nropeticion'];
    $fechapeticion = $_POST['p_fechapeticion'];
    $usuario = $_POST['p_usuario'];
    $extension = $_POST['p_extension'];
    $correo = $_POST['p_correo'];
    $categoria = $_POST['p_categoria'];
    $activo = $_POST['p_activo'];
    $codigo_activo = $_POST['p_codigoactivo'];
    $descripcion = $_POST['p_descripcion'];
    $imagen = $_POST['p_cargarimagen'];
    $imagen2 = $_POST['p_cargarimagen2'];
    $imagen3 = $_POST['p_cargarimagen3'];
    $estado = $_POST['p_estado'];
    $conclusiones = $_POST['p_conclusiones'];
    ?>


    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row mt-1">
            <div class="col-12 mt-4 pl-5">
                <h6>Atendiendo Soporte</h6>
            </div>
            <div class="col-12 ml-5">
                <div class="form-group">
                    <form action="../controller/controlador_peticion.php" class="form-group mt-3" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <div class="row mt-1">
                                <div class="col-2">
                                    <label>Cod. Solicitud</label>
                                    <input type="text" id="p_nropeticion" name="p_nropeticion" class="form-control data" value="<?php echo $codigo; ?>" readonly>
                                </div>
                                <div class="col-6">
                                    <label>Fecha Solicitud</label>
                                    <input type="text" id="p_fechapeticion" name="p_fechapeticion" class="form-control data" value="<?php echo  $fechapeticion; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-2">
                                    <label>Extensión</label>
                                    <input type="text" id="p_extension" name="p_extension" class="form-control data" value="<?php echo $extension; ?>" readonly>
                                </div>
                                <div class="col-6">
                                    <label>Usuario</label>
                                    <input type="text" id="p_usuario" name="p_usuario" class="form-control data" value="<?php echo  $usuario; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-10">
                                    <label>Correo</label>
                                    <input type="text" id="p_correo" name="p_correo" class="form-control data" value="<?php echo $correo; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-10">
                                    <label>Categoría</label>
                                    <input type="text" id="p_categoria" name="p_categoria" class="form-control data" value="<?php echo $categoria; ?>  " readonly>
                                </div>
                            </div>
                            <?php
                            if ($categoria == "Soporte sobre equipos tecnológicos") {
                            ?>
                                <div class="row mt-1">
                                    <div class="col-10">
                                        <label>Activo</label>
                                        <input type="text" id="p_activo" name="p_activo" class="form-control data" value="<?php echo $codigo_activo . " / " . $activo; ?>" readonly>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row mt-1">
                                <div class="col-10">
                                    <label for="">Descripción</label>
                                    <textarea id="p_descripcion" name="p_descripcion" class="form-control col-6 data" readonly><?php echo $descripcion; ?></textarea>
                                </div>
                            </div>
                            <div class="mt-2">
                                <?php if ($imagen != '2') { ?>
                                    <input type="hidden" id="imagenCa" name="imagenCa" value="<?php echo $imagen; ?>">
                                    <div class="contenedorImagenes">
                                        <label for="" style="text-decoration: underline;">Imagen</label><br><br>
                                        <a href="../../cartas/<?= $imagen ?>" target="_blanck">
                                            <img src="../../cartas/<?php echo ($imagen) ?>" alt="" width="413" height="250">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <input type="hidden" id="imagenCa" name="imagenCa" value="2">
                                <?php } ?>

                                <?php if ($imagen2 != '2') {
                                    echo ' '; ?>
                                    <input type="hidden" id="imagen2" name="imagen2" value="<?php echo $imagen2; ?>">
                                    <div class="contenedorImagenes2">
                                        <label for="" style="text-decoration: underline;">Imagen 2</label><br><br>
                                        <a href="../../cartas/<?= $imagen2 ?>" target="_blanck">
                                            <img src="../../cartas/<?php echo ($imagen2) ?>" alt="" width="313" height="150">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <input type="hidden" id="imagen2" name="imagen2" value="2">
                                <?php } ?>
                                <?php if ($imagen3 != '2') {
                                    echo ' '; ?>
                                    <input type="hidden" id="imagen3" name="imagen3" value="<?php echo $imagen3; ?>">
                                    <div class="contenedorImagenes3">
                                        <label for="" style="text-decoration: underline;">Imagen 3</label><br><br>
                                        <a href="../../cartas/<?= $imagen3 ?>" target="_blanck">
                                            <img src="../../cartas/<?php echo ($imagen3) ?>" alt="" width="313" height="250">
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <input type="hidden" id="imagen3" name="imagen3" value="2">
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <label class="mr-1" for="">Estado</label>
                                    <select class="p-1" name="p_estado" id="p_estado" required>
                                        <option value="" selected>seleccionar</option>
                                        <option value="2">Resuelto</option>
                                        <option value="3">Pendiente</option>
                                        <option value="4">Redireccionado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <div>
                                        <label class="mb-1" for="">Observaciones</label>
                                    </div>
                                    <textarea name="p_conclusiones" id="p_cnclusiones" cols="75" rows="6" required><?= strip_tags($conclusiones, '<br/>') ?></textarea>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="giant">
                                    <div class="col-6" id="imagenDiv">
                                        <label id="label">Seleccione el documento </label>
                                        <input type="file" id="imagen[]" name="imagen[]">
                                    </div>
                                    <label id="textImg" style="min-width:150%"></label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <input type="submit" value="Guardar" id="aceptar" name="aceptar" class="btn btn-primary mt-1 px-5">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/correo_archivos.js"></script>

</body>

</html>