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
        
        require_once('../model/crudPeticionesFuncionarios.php');
        require_once('../model/datosPeticion.php');
        $consultar= new CrudPeticiones();
        $datos= new Peticion();
        $consultaPeticiones=$consultar->consultarPeticionesFuncionario();//**********

    ?>
    <div class="container-fluid" id="infoPeticionFuncionario">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Peticiones Infraestructura</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                <a href="app/view/crearPeticionInfra.php"><h8> Generar Solicitud</h8><img src="public/img/nuevo.png" alt=""></a>
                
            </div>
            <div class="col">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:10px; text-align: center;">#</th>
                            <th style="width:30px; text-align: center;">Categoria</th>
                            <th style="width:30px; text-align: center;">Fecha Solicitud</th>
                            <th style="width:30px; text-align: center;">Descripci&oacute;n</th>
                            <th style="width:30px; text-align: center;">Estado Solicitud</th>
                            <th style="width:30px; text-align: center;">Fecha Atendido</th>
                            <th style="width:30px; text-align: center;">Usuario Atiende</th>
                            <th style="width:30px; text-align: center;">Conclusiones</th>
                            <th style="width:30px; text-align: center;">Revisado</th>
                    </thead>
                    <?php foreach($consultaPeticiones as $datos): ?>
                    <tr>
                        <td>
                            <?php echo $datos->getNroPeticion() ?></td>
                        <td>
                            <?php echo $datos->getCategoria() ?></td>
                        <td>
                            <?php echo $datos->getFechaPeticion() ?></td>
                        <td>
                            <?php $descripcion= $datos->getDescripcion(); echo htmlspecialchars_decode($descripcion, ENT_NOQUOTES); ?></td> 
                        <td>
                            <?php echo $datos->getEstado() ?></td> 
                        <td>
                            <?php echo $datos->getFechaAtendido() ?></td>
                        <td>
                            <?php echo $datos->getUsuarioAtiende() ?></td>
                        <td>
                            <?php echo $datos->getConclusiones() ?></td>
                        <td style="text-align:center;">
                            <?php 
                                $estado = $datos->getEstado();
                                $revisado = $datos->getRevisado();
                                if(($estado=="Resuelto"||$estado=="Redireccionado") && $revisado==1){
                            ?>
                                <input type="checkbox" class="btn btn-danger btn-sm" onChange="marcarevisado(<?php echo $datos->getNropeticion(); ?>)" id="revisar<?php echo $datos->getNropeticion(); ?>" name="revisado" value="<?php echo $datos->getNropeticion(); ?>">
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
    <script src="public/js/marcarRevisado.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>