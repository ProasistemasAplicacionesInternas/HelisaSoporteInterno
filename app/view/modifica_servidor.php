<?php

   session_start();
   
   if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
     }     
  
  require('../controller/tipo_servidor.php');
  require_once('../controller/Selector_estados.php');
  require_once('../controller/modifica_servidor.php');       

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Software para el trabajo</title>
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
                <h5 class="mt-3">Modificando Servidor...</h5> 
            </div>
        </div>
    </header>
    <div class="container">
        
            <!--/*------------------@jefferson.correa--------------------*/-->
                <form class="form-group" action="../controller/control_servidor.php" method="post">
            <!--/*------------------@jefferson.correa--------------------*/-->
                    <div class="titulo" style="text-align: center;">
                        <label>Hoja De Vida Del Servidor</label>
                    </div>
                        <div class="panel row ">                       
                            <div class="col-4">
                                <div class="form-group">
                                <label>Serial</label>
                                <input type="text" id="serial_servidor" name="serial_servidor" class="form-control info" maxlength="25" autocomplete="off" value="<?php echo $serial_servidor ?>" required readonly>
                            </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Activo Fijo</label>
                                    <input type="text" id="activo_fijo" name="activo_fijo" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $activo_fijo ?>" required>
                                     <input type="hidden" id="usu_name" name="usu_name" value="<?php echo $_SESSION['usuario'] ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <input type="text" id="marca_servidor" name="marca_servidor" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $marca_servidor ?>" required>
                                </div>
                            </div>
                            <!--<div class="col-6">
                                <div class="form-group">
                                    <label>Fisico Al Que Pertenece</label>
                                    <input type="text" id="fisico_servidor" name="fisico_servidor" class="form-control info" maxlength="260" autocomplete="off" required value="<?php echo $fisico_servidor ?>">
                                </div>
                            </div>-->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nombre del Servidor</label>
                                    <input type="text" id="nombre_servidor" name="nombre_servidor" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $nombre_servidor ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Ubicaci&oacute;n Servidor</label>
                                    <input type="text" id="ubicacion_servidor" name="ubicacion_servidor" class="form-control info" autocomplete="off" value="<?php echo $ubicacion_servidor ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha compra servidor</label>
                                    <input type="date" id="fecha_compra_servidor" name="fecha_compra_servidor" class="form-control info" value="<?php echo $fecha_compra_servidor ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Tipo Servidor</label>
                                    <select class="form-control info" id="tipoServidor" name="tipoServidor" required>
                                        <?php if ($codigoServidor==0) { echo
                                            "<option value='' selected>Seleccione el tipo de servidor</option>";} else{ echo"<option value='" . $codigoServidor ."'>". $tipoServidor ."</option>";} ?>
                                    
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
                                    <input type="text" id="IP_servidor" name="IP_servidor" class="form-control info" maxlength="100" autocomplete="off" value="<?php echo $IP_servidor ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">I.P. P&uacute;blica</label>
                                    <input type="text" id="IP_publica" name="IP_publica" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $IP_publica ?>" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Puerto</label>
                                    <input type="text" id="puerto_servidor" name="puerto_servidor" class="form-control info" maxlength="40" value="<?php echo $puerto_servidor ?>" autocomplete="off">
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
                                <input type="text" id="memoria_servidor" name="memoria_servidor" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $memoria_servidor ?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Disco</label>
                                <input type="text" id="disco_servidor" name="disco_servidor" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $disco_servidor ?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Procesador</label>
                                <input type="text" id="procesador_servidor" name="procesador_servidor" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $procesador_servidor ?>" required>
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Dominio</label>
                                <input type="text" id="dominio_servidor" name="dominio_servidor" class="form-control info" maxlength="40" autocomplete="off" required value="<?php echo $dominio_servidor ?>">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="">Responsable del Servidor</label>
                                <input type="text" id="responsable_servidor" name="responsable_servidor" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $responsable_servidor ?>" required>    
                            </div>
                        </div>

                        <div class="col-4 my-3">
                            <div class="form-group">
                                <label for="">Usuario Administrador</label>
                                <input type="text" id="usuarioAdministrador" name="usuarioAdministrador" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $usuarioAdministrador ?>" required> 
                            </div>
                        </div>
                        <div class="col-8 my-3">
                            <div class="form-group">
                                <label for="">Usuario Estandar</label>
                                <input type="text" id="usuarioEstandar" name="usuarioEstandar" class="form-control info" maxlength="50" autocomplete="off" value="<?php echo $usuarioEstandar ?>" required> 
                            </div>
                        </div>

                        <div class="row col-12">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Sistema Operativo</label>
                                    <input type="text" id="sistema_operativo" name="sistema_operativo" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $sistema_operativo ?>" required> 
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="">Otros Programas Instalados</label>
                                    <input type="text" id="programas_instalados" name="programas_instalados" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $programas_instalados ?>" required> 
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Para qu&eacute; se usa</label>
                                <input type="text" id="uso" name="uso" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $uso ?>" required> 
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Tiempo De Uso</label>
                                <input type="text" id="tiempo_uso" name="tiempo_uso" class="form-control info" autocomplete="off" value="<?php echo $tiempo_uso ?>" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Backup</label>
                                <select class="form-control info" id="backup" name="backup" required>
                                    <?php 
                                    if ($backup='Si') {
                                        echo '  <option value="Si">Si</option>
                                                <option value="No">No</option>';
                                    }else{
                                        echo '  <option value="No">No</option> 
                                                <option value="Si">Si</option>';

                                                                            }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                    <label for="">Frecuencia</label>
                                    <input type="text" id="frecuencia_backup" name="frecuencia_backup" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $frecuencia_backup ?>"  required> 
                            </div>
                        </div>
							   <div class="col-12">
                            <div class="form-group">
                                <label for="">Ruta</label>
                                <input type="text" id="ruta_backup" name="ruta_backup" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $ruta_backup ?>" required> 
                            </div>
                        </div>
                        <!--<div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre de Quien Genera</label>
                                <input type="text" id="persona_genera" name="persona_genera" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $persona_genera ?>" required> 
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
                                <input type="text" id="persona_entrega" name="persona_entrega" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $persona_entrega ?>"  required> 
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cargo </label>
                                <input type="text" id="cargo_entrega" name="cargo_entrega" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $cargo_entrega ?>" required> 
                            </div>
                        </div>
                        <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha </label>
                                    <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control info" value="<?php echo $fecha_entrega ?>" required>
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
                                <input type="text" id="persona_recibe" name="persona_recibe" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $persona_recibe /**/?>" required> 
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cargo </label>
                                <input type="text" id="cargo_recibe" name="cargo_recibe" class="form-control info" maxlength="40" autocomplete="off" value="<?php echo $cargo_recibe ?>" required> 
                            </div>
                        </div>
                        <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha </label>
                                    <input type="date" id="fecha_recibe" name="fecha_recibe" class="form-control info" value="<?php echo $fecha_recibe ?>" required>
                                </div>
                            </div>
                        </div>
                    <div class="row mt-1 mb-5 col-12">
                        <div class="col-6">
                <!--/*------------------@jefferson.correa--------------------*/-->
                            <button type="submit" class="btn btn-success" id="guardar_cambios" name="guardar_cambios">Guardar cambios</button>
                        </div>
                <!--/*------------------@jefferson.correa--------------------*/-->
                        <div class="col-6"><a id="cerrar_modServidor" class="btn btn-secondary">Cancelar</a></div>
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
    <script src="../../public/js/close.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
    <!--<script src="../../public/js/modifica_servidor.js"></script>-->
</body>

</html>
