<?php
    ini_set("session.cookie_lifetime",18000);
    ini_set("session.gc_maxlifetime",18000);
    session_start();
    if(!isset($_SESSION['usuario'])){    
        header('location:../../login_peticiones.php');
    }     

    if(!isset($_POST['accesoAprobado']) && $_POST['accesoAprobado'] != 1){
        if(isset($_SESSION['rol'])){
            header('location:../../dashboard_funcionarios.php');
        }else if(isset($_SESSION['id_roles'])){
            header('location:../../dashboard.php');
        }
    }

    
    $consultarAccesosPlataformas = 1;
    require_once('../controller/controlador_peticionesAccesos.php'); 

?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Helisa | Soporte Infraestructura</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/v4-shims.css">  
        <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../public/css/smoke.min.css">
        <link rel="stylesheet" href="../../public/css/consulta_peticion.css"> 
        <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    </head>
    <body>
        <header class="container-fluid">
            <div class="row">
                <div class="col-md-10 align-self-center">
                    <a href="../../dashboard_funcionarios.php" ><img src="../../public/img/logo.png" alt=""></a>
                </div>
            </div>
        </header>
        
        <div class="container-fluid px-5">
            <div class="row my-3">
                <h6>Accesos Plataformas.</h6>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <table class="table table-streed">
                        <thead>
                            <th>#</th>
                            <th>Plataformas</th>
                            <th>Usuario</th>
                            <th>Clave</th> 
                            <th>Estado</th>
                            <th>Fecha de Registro</th>
                            <th>Fecha de Inactivacion</th>
                        </thead>
                        <tbody>
                        <?php foreach($consultarAccesosPlataformas as $listado): ?>
                                <tr>
                                    <td><?php echo $listado->getid_accesoPlataforma();?></td>
                                    <td><?php echo $listado->getPlataformaDescripcion() ?></td>
                                    <td><?php echo $listado->getUsuario() ?></td>
                                    <td><?php if($listado->getEstado() == 5):?>
                                    <button type="buttom" class="btn btm-light" data-toggle="modal" data-target="#verClave" style="padding: 0px;" onclick="verClave('<?php echo $listado->getid_accesoPlataforma();?>','<?php echo $listado->getPlataformaDescripcion();?>')" ><i class="far fa-eye fa-2x"></i></button>
                                    </td> <?php endif;?>
                                    <td><?php echo $listado->getEstadoDescripcion() ?> </td> 
                                    <td><?php echo $listado->getFecha_registro() ?> </td>
                                    <td><?php echo $listado->getFecha_inactivacion() ?> </td>
                                </tr>
                        <?php endforeach;?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <!-- Modals -->
    <!-- Modal modificar -->
    <div class="modal fade bd-example-modal-sm" id="verClave" tabindex="-1" role="dialog" aria-labelledby="veClave" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Acceso a Plataforma</h6>
                    <button class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar_ver">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                            <form>
                                    <imput type="hidden" id="modal_id" name="modal_id">
                                        
                                    <label for="">Plataforma</label>
                                    <div><input class="form-control" type="text" name="modal_descripcion" id="modal_descripcion" class="crea_data" maxlength="90" autocomplete="off"  Disabled></div>
                                    
                                    <label for="">Clave</label>
                                    <div><input class="form-control" type="password" name="modal_clave" id="modal_clave" class="crea_data" maxlength="29" autocomplete="off" placeholder="Ingrese su clave Primero"></div>
                                    <div><input class="form-control" type="text" name="modal_clave2" id="modal_clave2" style="display:none;" maxlength="30" autocomplete="off"></div>

                                    <div><spam id="modal_texto"><spam></div>

                                    <input type="button" value="Modificar" id="modal_modificar" name="modal_modificar" class="mt-4 btn btn-primary" style="display:none">
                                    <input type="button" value="Ver" id="modal_ver" name="modal_ver" class="mt-4 btn btn-primary">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="../../public/js/jquery-3.3.1.min.js"></script>
        <script src="../../public/js/datatables.min.js"></script>
        <script src="../../public/js/smoke.min.js"></script>
        <script src="../../public/js/bootstrap.min.js"></script>  
        <script src="../../public/js/asignaciones.js"></script> 
        <script src="../../public/js/bloqueoTeclas.js"></script>        

    </body>
</html>