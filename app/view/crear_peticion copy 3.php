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
                                <select class="form-control info" id="area_peticion" name="area_peticion" onChange="productoCategoria()" required>
                                    <option value="" selected>Seleccione un area</option>
                                    <option value="1" >Infraestructura</option>
                                    <option value="2" >Mantenimiento De Aplicaciones</option>
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
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" id="divProducto" style="display:none">
                                <label>Producto</label>
                                <select class="form-control info" id="productoMai" name="productoMai">
                                    <option value="" selected>Seleccione Un Programa</option>
                                    <?php
                                    foreach ($listado_productos as $producto) {
                                        echo "<option value='" . $producto["id_producto"] . "'>" . $producto["nombre_producto"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" id="divPeticion" style="display:none">
                                <label>Tipo de petición</label>
                                <select class="form-control info" id="soporteMai" name="soporteMai" onchange="imagenRequerida(), reqData()">
                                    <option value="" selected>Seleccione el tipo de petición</option>
                                    <?php
                                    foreach ($listado_soporte as $tipoSoporte) {
                                        if ($tipoSoporte['id'] == 4 && isset($_SESSION['id_roles']) && $_SESSION['id_roles'] == 5) {
                                            echo "<option value='" . $tipoSoporte["id"] . "'>" . $tipoSoporte["nombre"] . "</option>";
                                        } else if ($tipoSoporte['id'] != 4) {
                                            echo "<option value='" . $tipoSoporte["id"] . "'>" . $tipoSoporte["nombre"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group" id="divNombre" style="display:none;">
                                <label>Nombre del requerimiento</label>
                                <input class="form-control info" id="req_Name" name="req_Name" />
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

                                        foreach ($activos_Asignados as $activoFijo) {
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
                            <div class="form-group" id="reqJustification" style="display: none;">
                                <label>Justificación</label>
                                <textarea name="req_Justification" id="req_Justification" cols="86" rows="5" maxlength="6000"></textarea>
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
                            <button type="submit" class="btn btn-success" id="btn-enviar_peticion" name="btn-enviar_peticion">Enviar Solicitud</button>
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

</body>

<!-- <script>
    document.addEventListener('DOMContentLoaded',
        function() {
            const selectElement = document.getElementById('area_peticion');
            const defaultValue = selectElement.value;
            productoCategoria(defaultValue);

            function productoCategoria(selectedValue) {
                console.log('La categoría seleccionada al cargar la página es:', selectedValue);
            }
            if (selectedValue === 'Infraestructura') {
                alert('¡La opción "Infraestructura" está seleccionada por defecto!');
            } else if (selectedValue === 'Mantenimiento De Aplicaciones') {
                alert('¡La opción "Mantenimiento De Aplicaciones" está seleccionada por defecto!');
            } else if (selectedValue === 'Seguridad') {
                alert('¡La opción "Seguridad" está seleccionada por defecto!');
            }
        });
</script> -->

</html>