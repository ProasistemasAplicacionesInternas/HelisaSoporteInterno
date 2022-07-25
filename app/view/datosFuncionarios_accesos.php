<?php
    ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
    session_start();
    if(!isset($_SESSION['usuario'])){    
        header('location:../../login_peticiones.php');
    }
    
    /* Trae la lista de funcionarios en el deparmaneto */
    $crear_peticion = 1;
    include('../controller/controlador_peticionesAccesos.php');

    if(isset($_SESSION['redireccionamiento'])){
        $usuario =  $_SESSION['redireccionamiento'];
        $_SESSION['redireccionamiento'] = null;
        $globalDataFuncionario = 1;
        require_once('../controller/controlador_funcionarios.php');

    }

?>
<!DOCTYPE html>
<html lang="es">

    <head>
    </head>
    <body>
        <div class="container-fluid px-5">
            <div class="row my-3">
                <h6>Informacion de Funcionarios</h6>
            </div>

            <div class="col-5">
                <label>Funionario</label>
                <div>   
                    <select class="form-control" id="funcionarioDatos" name="funcionarioDatos" required>
                        <option value=''>Seleccionar</option>
                        <?php foreach($funcionarios as $listado):?>
                            <option value='<?=$listado['usuario']?>' <?php if(isset($usuario) && $usuario == $listado['usuario']){echo 'selected';}?> ><?= $listado['nombre'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        
            <?php if(isset($usuario)):?>
            <div class="row mt-3">
                <label>Accesos</label>
                <div class="col-12">
                    <table class="table table-streed">
                        <thead>
                            <th>#</th>
                            <th>Plataformas</th>
                            <th>Administrador</th>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Fecha de Registro</th>
                            <th>Fecha de Inactivacion</th>
                        </thead>
                        <tbody>
                        <?php foreach($accesosFuncionario as $listado): ?>
                                <tr>
                                    <td><?= $listado->getid_accesoPlataforma();?></td>
                                    <td><?= $listado->getPlataformaDescripcion() ?></td>
                                    <td><?= $listado->getPlataformaAdministrador() ?></td>
                                    <td><?= $listado->getUsuario() ?></td>
                                    <td><?= $listado->getEstadoDescripcion() ?> </td> 
                                    <td><?= $listado->getFecha_registro() ?> </td>
                                    <td><?= $listado->getFecha_inactivacion() ?> </td>
                                </tr>
                        <?php endforeach;?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif;?>

        </div>

    <script>
        $('#funcionarioDatos').change(function(){
            var data = "setRedireccionamiento=1&numRedireccionamiento=" + $('#funcionarioDatos').val();
            $.ajax({
                type: "POST",
                url: "app/controller/control_redireccionamiento.php",
                data: data
            }).done(function(respuesta){
                $("#contenido").load("app/view/datosFuncionarios_accesos.php");
            })
        })


    </script>
    </body>
</html>