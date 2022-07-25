<?php

  require('../controller/tipo_servidor.php');
  ini_set("session.cookie_lifetime",18000);
  ini_set("session.gc_maxlifetime",18000);
   session_start();
   
   if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }       

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Cloud</title>
    <link rel="stylesheet" href="../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/smoke.min.css">
    <link rel="stylesheet" href="../../public/css/servidores.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />

</head>

<body>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
            <div class="acciones align-self-center">
                <h5>Creando Servidor...</h5>
            </div>
        </div>
    </header>
    <div class="container">
        
            <!--/*------------------@jefferson.correa--------------------*/-->
                <form class="form-group" action="../controller/control_servidor.php" method="post">
            <!--/*------------------@jefferson.correa--------------------*/-->
                    <div class="titulo" >
                        <label>Hoja De Vida Del Servidor</label>
                    </div>
                        <div class="panel row ">                       
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Serial</label>
                                    <input type="text" id="serial_servidor" name="serial_servidor" class="form-control info" maxlength="25" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Activo Fijo</label>
                                    <input type="text" id="activo_fijo" name="activo_fijo" class="form-control info" maxlength="260" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <input type="text" id="marca_servidor" name="marca_servidor" class="form-control info" maxlength="260" autocomplete="off" required>
                                </div>
                            </div>
                            <!--<div class="col-6">
                                <div class="form-group">
                                    <label>Fisico Al Que Pertenece</label>
                                    <input type="text" id="fisico_servidor" name="fisico_servidor" class="form-control info" maxlength="260" autocomplete="off" required>
                                </div>
                            </div>-->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nombre del Servidor</label>
                                    <input type="text" id="nombre_servidor" name="nombre_servidor" class="form-control info" maxlength="260" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Ubicaci&oacute;n Servidor</label>
                                    <input type="text" id="ubicacion_servidor" name="ubicacion_servidor" class="form-control info" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha compra servidor</label>
                                    <input type="date" id="fecha_compra_servidor" name="fecha_compra_servidor" class="form-control info" value="" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Tipo Servidor</label>
                                    <select class="form-control info" id="tipoServidor" name="tipoServidor" required>
                                        <option value="" selected>Seleccione el tipo de servidor</option>
                                        <?php

                                                foreach($filas_tipoServidor as $tipoServidor){
                                                echo "<option value='".$tipoServidor["id_tipo_servidor"]."'>".$tipoServidor["tipo_servidor"] ."</option>" ;
     
                                                              }  
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">I.P. Servidor</label>
                                    <input type="text" id="IP_servidor" name="IP_servidor" class="form-control info" maxlength="100" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">I.P. P&uacute;blica</label>
                                    <input type="text" id="IP_publica" name="IP_publica" class="form-control info" maxlength="40" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Puerto</label>
                                    <input type="text" id="puerto_servidor" name="puerto_servidor" class="form-control info" maxlength="40" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    <div class="titulo" style="text-align: center;">
                        <label>Caracteristicas Del Servidor</label>
                    </div>

                    <div class="panel row ">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Memoria</label>
                                <input type="text" id="memoria_servidor" name="memoria_servidor" class="form-control info" maxlength="40" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Disco</label>
                                <input type="text" id="disco_servidor" name="disco_servidor" class="form-control info" maxlength="300" autocomplete="off" required>
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Procesador</label>
                                <input type="text" id="procesador_servidor" name="procesador_servidor" class="form-control info" maxlength="40" autocomplete="off" required>
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Dominio</label>
                                <input type="text" id="dominio_servidor" name="dominio_servidor" class="form-control info" maxlength="40" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="">Responsable del Servidor</label>
                                <input type="text" id="responsable_servidor" name="responsable_servidor" class="form-control info" maxlength="40" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-4 my-3">
                            <div class="form-group">
                                <label for="">Usuario Administrador</label>
                                <input type="text" id="usuarioAdministrador" name="usuarioAdministrador" class="form-control info" maxlength="50" autocomplete="off" required> 
                            </div>
                        </div>
                        <div class="col-8 my-3">
                            <div class="form-group">
                                <label for="">Usuario Estandar</label>
                                <input type="text" id="usuarioEstandar" name="usuarioEstandar" class="form-control info" maxlength="50" autocomplete="off" required> 
                            </div>
                        </div>

                        <div class="row col-12">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Sistema Operativo</label>
                                    <input type="text" id="sistema_operativo" name="sistema_operativo" class="form-control info" maxlength="300" autocomplete="off" required> 
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="">Otros Programas Instalados</label>
                                    <input type="text" id="programas_instalados" name="programas_instalados" class="form-control info" maxlength="300" autocomplete="off" required> 
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Para qu&eacute; se usa</label>
                                <input type="text" id="uso" name="uso" class="form-control info" maxlength="300" autocomplete="off" required> 
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Ruta</label>
                                <input type="text" id="ruta_backup" name="ruta_backup" class="form-control info" autocomplete="off" required> 
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label for="">Tiempo De Uso</label>
                                <input type="text" id="tiempo_uso" name="tiempo_uso" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="">Backup</label>
                                <select class="form-control info" id="backup" name="backup" required>
                                    <option value="" selected>Realiza Backup?</option> 
                                    <option value="Si">Si</option>
                                    <option value="No">No</option> 
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                    <label for="">Frecuencia</label>
                                    <input type="text" id="frecuencia_backup" name="frecuencia_backup" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>
                        <!--<div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre de Quien Genera</label>
                                <input type="text" id="persona_genera" name="persona_genera" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>-->
                    </div>
                    
                    <div class="titulo" style="text-align: center;">
                        <label>Datos De Quien Entrega</label>
                    </div>
                    <div class="panel row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" id="persona_entrega" name="persona_entrega" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cargo </label>
                                <input type="text" id="cargo_entrega" name="cargo_entrega" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>
                        <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha </label>
                                    <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control info" value="" required>
                                </div>
                            </div>
                    </div>
                    
                    <div class="titulo" style="text-align: center;">
                        <label>Datos De Quien Recibe</label>
                    </div>
                    <div class="panel row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" id="persona_recibe" name="persona_recibe" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cargo </label>
                                <input type="text" id="cargo_recibe" name="cargo_recibe" class="form-control info" maxlength="40" autocomplete="off" required> 
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Fecha </label>
                                <input type="date" id="fecha_recibe" name="fecha_recibe" class="form-control info" value="" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3  mb-5 col-12">
                        <div class="col-6">
                            <button type="submit" class="btn btn-success" id="guardar" name="guardar">Crear servidor</button>
                        </div>
                
                        <div class="col-6">
                            <a href="../../dashboard.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>    
            </div>
                    
                    
                    

                </form>
            </div>
        </div>
    </div>
    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/popper.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/es.min.js"></script>
</body>
</html>