<?php

  require_once('../controller/controlador_matriz_servidores.php');
  require_once('../controller/modifica_maquina.php');
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
    <link rel="stylesheet" href="../../public/css/maquinas.css" media="screen" type="text/css">
    <link rel="icon" type="image/png" href="../../public/img/ico.png" />

</head>

<body>

    <header class="container-fluid">
        <div class="row">
            <div class="col-md-10 align-self-center">
                <img src="../../public/img/Logo_blanco.png" alt="">
            </div>
            <div class="acciones align-self-center">
                <h5>Modificando Maquina...</h5>
            </div>
        </div>
    </header>
    <div class="container">
        
            <div class="col-12 ml-5">
            <!--/*------------------@jefferson.correa--------------------*/-->
                <form class="form-group" action="../controller/modifica_maquina.php" method="post">
            <!--/*------------------@jefferson.correa--------------------*/-->
                    <div class="titulo" style="text-align: center;">
                        <label>Hoja De Vida De La Maquina</label>
                    </div>
                    <div class="row" style="display: none;">
                        <input type="text" id="id_maquina" name="id_maquina" value=" <?php echo $id_maquina ?>">
                    </div>
                        <div class="panel row ">                       
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Nombre de la maquina</label>
                                    <input type="text" id="nombre_maquina" name="nombre_maquina" class="form-control info" maxlength="260" autocomplete="off" value="<?php echo $nombre_maquina ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Servidor Al Que Pertenece</label> <?php echo $nombre_servidor ?>
                                    <select class="form-control info" id="id_servidor" name="id_servidor" style="font-size: 15px" required>
                                        <?php 
                                        if ($id_servidor!=0) {
                                            echo "<option value='".$id_servidor."'>".$nombre_servidor ."</option>";
                                        }

                                        foreach($listado_servidores as $servidor){
                                                                echo "<option value='".$servidor["id_servidor"]."'>".$servidor["nombre_servidor"] ."</option>" ;
                                                            } 
                                        ?>                                       
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Ubicaci&oacute;n maquina</label>
                                    <input type="text" id="ubicacion_maquina" name="ubicacion_maquina" class="form-control info" autocomplete="off" value='<?php echo $ubicacion_maquina;  ?>' required>
                                    <input type="hidden" id="usu_name" name="usu_name"  value='<?php echo $_SESSION['usuario'];  ?>' >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha compra maquina</label>
                                    <input type="date" id="fecha_compra_maquina" name="fecha_compra_maquina" class="form-control info" value='<?php echo $fechaC_maquina;  ?>' required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Tipo maquina</label> 
                                    <select class="form-control info" id="tipo_maquina" name="tipo_maquina" value='<?php echo $tipo_maquina ?>' required>
                                        <?php 
                                    if ($tipo_maquina==3) {
                                        echo "  <option value='3'>Virtual en Sitio</option>
                                                <option value='4'>Virtual Datacenter</option>" 
                                    ;}else if($tipo_maquina==4){
                                        echo "<option value='4'>Virtual Datacenter</option>
                                              <option value='3'>Virtual en Sitio</option>"
                                    ;}else{
                                        echo "  <option value='' selected>Seleccione el tipo de maquina</option>
                                                <option value='3'>Virtual en Sitio</option>
                                                <option value='4'>Virtual Datacenter</option>"
                                    ;}
                                     ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">I.P. maquina</label>
                                    <input type="text" id="IP_maquina" name="IP_maquina" class="form-control info" maxlength="100" autocomplete="off" value='<?php echo $ip_maquina;  ?>' required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">I.P. P&uacute;blica</label>
                                    <input type="text" id=" IP_publica_maquina" name=" IP_publica_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $ip_publica_maquina;  ?>' required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Puerto</label>
                                    <input type="text" id="puerto_maquina" name="puerto_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $puerto_maquina;  ?>'>
                                </div>
                            </div>
                        </div>

                    <div class="titulo" style="text-align: center;">
                        <label>Caracteristicas De La Maquina</label>
                    </div>

                    <div class="panel row ">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Memoria</label>
                                <input type="text" id="memoria_maquina" name="memoria_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $memoria_maquina;  ?>' required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Disco</label>
                                <input type="text" id="disco_maquina" name="disco_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $disco_maquina;  ?>' required>
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Procesador</label>
                                <input type="text" id="procesador_maquina" name="procesador_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $procesador_maquina;  ?>' required>
                                
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Dominio</label>
                                <input type="text" id="dominio_maquina" name="dominio_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $dominio_maquina;  ?>' required>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="">Responsable del maquina</label>
                                <input type="text" id="responsable_maquina" name="responsable_maquina" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $responsable_maquina;  ?>' required>
                            </div>
                        </div>

                        <div class="col-4 my-3">
                            <div class="form-group">
                                <label for="">Usuario Administrador</label>
                                <input type="text" id="usuario_administrador" name="usuario_administrador" class="form-control info" maxlength="50" autocomplete="off" value='<?php echo $usuarioA_maquina;  ?>' required> 
                            </div>
                        </div>
                        <div class="col-8 my-3">
                            <div class="form-group">
                                <label for="">Usuario Estandar</label>
                                <input type="text" id="usuario_estandar" name="usuario_estandar" class="form-control info" maxlength="50" autocomplete="off" value='<?php echo $usuarioE_maquina;  ?>' required> 
                            </div>
                        </div>

                        <div class="row col-12">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Sistema Operativo</label>
                                    <input type="text" id="sistema_operativo" name="sistema_operativo" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $so_maquina;  ?>' required> 
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="">Otros Programas Instalados</label>
                                    <input type="text" id="programas_instalados" name="programas_instalados" class="form-control info" autocomplete="off" value='<?php echo $programas_maquina;  ?>' required> 
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Para qu&eacute; se usa</label>
                                <input type="text" id="uso" name="uso" class="form-control info" autocomplete="off" value='<?php echo $uso_maquina;  ?>' required> 
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Tiempo De Uso</label>
                                <input type="text" id="tiempo_uso" name="tiempo_uso" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $tiempoUso_Maquina;  ?>' required> 
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Backup</label> 
                                <select class="form-control info" id="backup" name="backup" required>
                                    <?php 
                                    if ($backup_maquina=='Si') {
                                        echo "<option value='Si'>Si</option>
                                              <option value='No'>No</option>" 
                                    ;}else if($backup_maquina=='No'){
                                        echo "<option value='No'>No</option>
                                              <option value='Si'>Si</option>"
                                    ;}else if($backup_maquina==''){
                                        echo "<option value='' selected>Seleccione una Opción</option>
                                              <option value='Si'>Si</option>
                                              <option value='No'>No</option>"
                                    ;}
                                     ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                    <label for="">Frecuencia</label>
                                    <input type="text" id="frecuencia_backup" name="frecuencia_backup" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $frecuencia_maquina;  ?>' required> 
                            </div>
                        </div>
							   <div class="col-12">
                            <div class="form-group">
                                    <label for="">Ruta</label>
                                    <input type="text" id="ruta_backup" name="ruta_backup" class="form-control info" autocomplete="off" value='<?php echo $ruta_maquina;  ?>' required> 
                            </div>
                        </div>
                        <!--<div class="col-4">
                            <div class="form-group">
                                <label for="">Nombre de Quien Genera</label>
                                <input type="text" id="persona_genera" name="persona_genera" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $genera_maquina;  ?>' required> 
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
                                <input type="text" id="persona_entrega" name="persona_entrega" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $entrega_maquina;  ?>' required> 
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cargo </label>
                                <input type="text" id="cargo_entrega" name="cargo_entrega" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $cargoE_maquina;  ?>' required> 
                            </div>
                        </div>
                        <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha </label>
                                    <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control info" value='<?php echo $fechaE_maquina;  ?>' required>
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
                                <input type="text" id="persona_recibe" name="persona_recibe" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $recibe_maquina;  ?>' required> 
                            </div>
                        </div>    
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Cargo </label>
                                <input type="text" id="cargo_recibe" name="cargo_recibe" class="form-control info" maxlength="40" autocomplete="off" value='<?php echo $cargoR_maquina;  ?>' required> 
                            </div>
                        </div>
                        <div class="col-4">
                                <div class="form-group">
                                    <label for="">Fecha </label>
                                    <input type="date" id="fecha_recibe" name="fecha_recibe" class="form-control info" value='<?php echo $fechaR_maquina;  ?>' required>
                                </div>
                            </div>
                    </div>
                    <div class="row mt-1 mb-5 col-12">
                        <div class="col-6">
                <!--/*------------------@jefferson.correa--------------------*/-->
                            <button type="submit" class="btn btn-success" id="guardar_cambios" name="guardar_cambios">Guardar Cambios</button>
                        </div>
                <!--/*------------------@jefferson.correa--------------------*/-->
                        <div class="col-6"><a href="../../dashboard.php" class="btn btn-danger">Cancelar</a></div>
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
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>
</html>