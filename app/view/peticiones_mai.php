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
    ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
    session_start();
    if(!isset($_SESSION['usuario'])){
    header('location:../../login_peticiones.php');
    }
        require('../model/crud_peticionesmai.php');
        require('../model/datos_peticionesmai.php');
        $crud = new CrudPeticionesMai();
        $datos = new PeticionMai();
        $consultaPeticionesMai=$crud->consultarPeticionesMaixFuncionario();//**********
    ?>
    <div class="container-fluid" id="infosPeticiones">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Solicitudes Apps Internas</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a id="cacheData" href="app/view/crear_peticionMai.php"><h8>Generar Solicitud</h8><img src="public/img/nuevo.png" alt=""></a>
            </div>
            <div class="col">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:10px;">#</th>
                            <th style="width:30px;">Producto</th>
                            <th style="width:30px;">Fecha Solicitud</th>
                            <th style="width:30px;">Descripci&oacute;n</th>
                            <th style="width:30px;">Tipo de Solicitud</th>                           
                            <th style="width:30px;">Estado Solicitud</th>
                            <th style="width:30px;">Fecha Atendido</th>
                            <th style="width:30px;">Usuario Atiende</th>
                            <th style="width:30px;">Conclusiones</th>
                            <th style="width:30px;">Revisado</th>
                    </thead>
                    <?php foreach($consultaPeticionesMai as $datos): ?>
                        <tr>
                            <td>                                
                                <?php echo $datos->getId_peticionMai() ?></td>
                            <td>
                                <?php echo $datos->getProducto_peticionMai() ?></td>
                            <td>
                                <?php echo $datos->getFecha_peticionMai() ?></td>
                            <td>
                                <?php $descripcion = $datos->getDescripcion_peticionMai(); echo htmlspecialchars_decode($descripcion, ENT_NOQUOTES); ?></td> 
                            <td>
                                <?php echo $datos->getName() ?>
                            <td>
                                <?php echo $datos->getEstado_peticionMai() ?></td> 
                            <td>
                                <?php echo $datos->getFecha_atendidoMai() ?></td>
                            <td>
                                <?php echo $datos->getUsuario_atencionMai() ?></td>
                            <td>
                                <?php echo $datos->getConclusiones_peticionMai() ?></td>
                            <td style="text-align:center">
                                <?php 
                                    $estado = $datos->getEstado_peticionMai();
                                    $revisado = $datos->getMarca_revisado();
                                    if(($estado=="Resuelto"||$estado=="Redireccionado") && $revisado==1){
                                ?>
                                    <input type="checkbox" class="btn btn-danger btn-sm" onChange="marcarevisado(<?php echo $datos->getId_peticionMai(); ?>)" id="revisar<?php echo $datos->getId_peticionMai(); ?>" name="revisado" value="<?php echo $datos->getId_peticionMai(); ?>">
                                <?php } ?>
                            </td>
                        </tr>
                    <?php 
                        endforeach;
                        ?>
                </table>
            </div>
        </div>
    </div>
    <script src="public/js/revisar_peticionmai.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>

</body>

<script>

document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('cacheData');

            button.addEventListener('click', function() {
                console.log('Button clicked!');
                localStorage.setItem('opcionPeticion', 2);
            });


        });

    </script>

</html>