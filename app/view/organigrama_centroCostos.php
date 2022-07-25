<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="public/css/datatables.min.css" />
    <link rel="stylesheet" href="public/css/smoke.min.css">

</head>

<body>

    <?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
       }  
       require_once('../controller/controlador_centroCostos.php'); 
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Centro de Costos</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="" data-toggle="modal" data-target="#crearModal" data-backdrop="static"><img src="public/img/nuevo.png"></a>
            </div>

            <div class="col" id="padre_tabla"> 
                <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:50px;">Nro</th>
                            <th>Nombre Centro de Costos</th>
                            <th style="width:50px;">Codigo</th>
                            <th style="width:100px;">Numero de personas</th>
                    </thead>
                    <tbody id="contenido_centroCostos">
                        <?php foreach($centroDeCostos AS $centros):?>
                            <tr>
                                <td><?php echo $centros['id_centroCostos'];?></td>
                                <td><?php echo $centros['descripcion'];?></td>
                                <td><?php echo $centros['codigo'];?></td>
                                <td><?php echo $centros['personasxCentroCostos'];?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- Modals -->
    <!-- Modal Crear -->
    <div class="modal fade bd-example-modal-sm" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModal aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Crear Centros de Costos</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_crear">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <form>
                                <label for="">Titulo</label>
                                <div>
                                    <input class="form-control" type="text" name="modal_descripcionCrear" id="modal_descripcionCrear" class="crea_data" maxlength="90" autocomplete="off" value="" required>
                                </div>

                                <label for="">Codigo</label>
                                <div>
                                    <input class="form-control" type="number" name="modal_CodigoCrear" id="modal_codigoCrear" class="crea_data"  maxlength="12" autocomplete="off" value="" required>
                                </div>

                                <div class="modal-footer">
                                    <input type="button" value="Crear" id="crear_centroCostos" name="crear_centroCostos" class="mt-4 btn btn-success btn-lg">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/organigrama_centroCostos.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    
</body>

</html>