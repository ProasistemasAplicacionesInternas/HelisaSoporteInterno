<?php
//*******************************************************************************//
//************FORMULARIO PARA LA CREACION DE PETICION A TECNOLOGIA***************//
//*******************************************************************************//

ini_set("session.cookie_lifetime", 30000);
ini_set("session.gc_maxlifetime", 30000);
session_start();

if (!isset($_SESSION['usuario'])) {

    header('location:../../login_peticiones.php');
}

require('../controller/controlador_categorias.php');
require('../controller/controlador_productosmai.php'); //1
require('../controller/controlador_consultaActivosFuncionario.php');
require('../controller/controlador_soportemai.php');
require('../controller/controlador_peticionmai.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/activosFijos.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />
</head>

<body>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <h6 class="mt-3">Generar Solicitud</h6>
            <div class="col-12 ml-5">

                <form action="../controller/controlador_crearPeticion.php" method="post" class="form-group" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Área</label>
                                <select class="form-control info" id="area_peticion" name="area_peticion" required disabled>
                                    <option value="1" selected>Infraestructura</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" id="divCategoria" style="display:none">
                                <label>Categoría</label>
                                <select class="form-control info" id="p_categoria" name="p_categoria">
                                    <option value="" selected>Seleccione Una Categoría</option>
                                    <?php

                                    foreach ($listado_categorias as $categoria) {
                                        echo "<option value='" . $categoria["id_categoria"] . "'>" . $categoria["nombre_categoria"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="activoSoporte" class="activoFijo">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Activos Asignados</label>
                                    <select class="form-control info" id="p_activo" name="p_activo">
                                        <option value="" selected>Seleccione un activo</option>
                                        <?php

                                        foreach ($activosAsignados as $activoFijo) {
                                            echo "<option value='" . $activoFijo["id_activo"] . "'>" . $activoFijo["codigo_activo"] . " / " . $activoFijo["nombre_activo"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="p_descripcion" id="p_descripcion" cols="86" rows="5" maxlength="6000" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <div>
                                    <label>Cargar Imagen Evidencia</label>
                                </div>
                                <div>
                                    <input type="file" id="imagen[]" name="imagen[]" multiple="">
                                </div>
                                <label class="mt-2" id="textImg" style="min-width:150%"></label>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-3">
                            <button type="submit" class="btn btn-success" id="btn-enviar_peticionInfra" name="btn-enviar_peticionInfra">Enviar Solicitud</button>
                        </div>
                        <div class="col-3">
                            <a class="btn btn-danger" onclick="retrocesoPagina()">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../public/js/cambio_area.js"></script>
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/valida_imagen.js?ty6"></script>
    <script src="../../public/js/es.min.js"></script>
    <script src="../../public/js/activo_oculto.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <script src="../../public/js/navega_funcionarios.js"></script>

</body>

</html>