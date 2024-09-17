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
       
       header('location:../../login.php');
       }
        
       require_once('../model/crudPeticionesFuncionarios.php');
       require_once('../model/datosPeticion.php');
    
        $consultar= new CrudPeticiones();
        $datos= new Peticion();
    
        $consultarActivo=$consultar->peticionesSeleccionadas();
    ?>
    <div class="container-fluid" id="infos2">
        <div class="row">
            <div class="col-11 mt-4 pl-5 mb-2">
                <h6>Liberar Soporte Interno</h6>
            </div>
            <!--<div class="col-1 mt-4 mb-2">
                <a href="app/view/crear_activos.php"><img src="public/img/nuevo.png" alt=""></a>
            </div>-->
            <div class="col">
                    <table class="table table-striped tablesorter" id="tabla">
                    <thead>
                            <th style="width:3px;"># Soporte</th>
                            <th style="width:50px;">Fecha Soporte</th>
                            <th style="width:50px;">Categoria</th>
                            <th style="width:50px;">Asesor</th>
                            <th style="width:50px;">Liberar</th>
                    </thead>
                    <?php foreach($consultarActivo as $datos): ?>
                    <tr>
                        <td>                                
                            <?php echo $datos->getP_nropeticion() ?></td>
                        <td>                                
                            <?php echo $datos->getP_fechapeticion() ?></td>
                        <td>
                            <?php echo $datos->getP_categoria() ?></td>
                        <td>
                            <?php echo $datos->getP_usuarioatiende() ?></td>
                        <td>
                            <form action="app/controller/liberar_peticion.php" method="post">
                              <input type="hidden" name="nro_peticion" value="<?php echo $datos->getP_nropeticion(); ?>">
                              <input type="submit" class="btn btn-danger btn-sm" value="Liberar" name="liberar">
                            </form>
                        </td>
                        

                    </tr>
                    <?php 
                        endforeach;
                        ?>
                </table>
            </div>

        </div>
    </div>
    
    <script src="public/js/datatables.min.js"></script>
    <script src="public/js/bloqueoTeclas.js"></script>
    
</body>
</html>