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
        
        require_once('../model/crud_peticiones.php');
        require_once('../model/datos_peticion.php');
        $consultar= new CrudPeticiones();
        $datos= new Peticion();
        $consultaPeticiones=$consultar->consultarPeticionesFuncionario();//**********

    ?>
    <div class="container-fluid" id="infoPeticionFuncionario">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Consulta Peticiones</h6>
            </div>
            <div class="col-1 mt-4 mb-2">
                 <a href="app/view/crear_peticion.php"><h8> Generar Solicitud</h8><img src="public/img/nuevo.png" alt=""></a>

            </div>
            <div class="col">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:10px;">#</th>
                            <th style="width:30px;">Categoria</th>
                            <th style="width:30px;">Fecha Solicitud</th>
                            <th style="width:30px;">Descripci&oacute;n</th>
                            <th style="width:30px;">Estado Solicitud</th>
                            <th style="width:30px;">Fecha Atendido</th>
                            <th style="width:30px;">Usuario Atiende</th>
                            <th style="width:30px;">Conclusiones</th>
                            <th style="width:30px;">Revisado</th>
                            
                                              
                    </thead>
                    <?php foreach($consultaPeticiones as $datos): ?>
                    <tr>
                        <td>
                            <?php echo $datos->getP_nropeticion() ?></td>
                        <td>
                            <?php echo $datos->getP_categoria() ?></td>
                        <td>
                            <?php echo $datos->getP_fechapeticion() ?></td>
                        <td>
                            <?php echo $datos->getP_descripcion() ?></td> 
	                    <td>
                            <?php echo $datos->getP_estado() ?></td> 
                        <td>
                            <?php echo $datos->getP_fechaatendido() ?></td>
                        <td>
                            <?php echo $datos->getP_usuarioatiende() ?></td>
                        <td>
                            <?php echo $datos->getP_conclusiones() ?></td>
                        <td style="text-align:center">
                            <?php 
                                $estado = $datos->getP_estado();
                                $revisado = $datos->getRevisado();
                                if(($estado=="Resuelto"||$estado=="Redireccionado") && $revisado==1){
                            ?>
                                <input type="checkbox" class="btn btn-danger btn-sm" onChange="marcarevisado(<?php echo $datos->getP_nropeticion(); ?>)" id="revisar<?php echo $datos->getP_nropeticion(); ?>" name="revisado" value="<?php echo $datos->getP_nropeticion(); ?>">
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
    <script src="public/js/marcar_revisado.js"></script>
    <script src="public/js/smoke.min.js"></script>
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/tablas.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
</body>

</html>