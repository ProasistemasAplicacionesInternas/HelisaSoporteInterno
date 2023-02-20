<div class="row my-3">
                        <h6>Modificar accesos.</h6>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <table class="table table-streed">
                                <thead>
                                    <th style="display:none;"></th>
                                    <th>Tipo Acceso</th>
                                    <th>Usuario</th>
                                    <th>Contrase&ntilde;a</th>
                                    <th>Estado</th>
                                    <th>Fecha Registro</th>                                    
                                    <th>Fecha Inactivaci&oacute;n</th>        
                                    <th>Modificar</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    
                                    foreach($consultaAccesos as $crud): ?>
                                    <tr>
                                    <td style="display:none;"><span id="codigos<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getIdAcceso(); ?></span></td>

                                        <td style="display:none;"><span id="tipo_accesosA<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getTipoAcceso();  ?></span></td>  

                                        <td><span id="acceso<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getDescripcion();  ?></span></td>                                      

                                        <td><span id="nombreUsuario<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getUsuario(); ?></span></td>

                                        <td><span id="claves<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getClave();?></span></td>

                                        <td><span id="estados<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getF_estado();?></span> </td>

                                        <td style="display:none;"><span id="estadosA<?php echo $crud->getIdacceso(); ?>"><?php echo $crud->getEstadosA(); ?></span></td>

                                        <td><span id="fechas<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getFechaRegistro();?></span></td>

                                          <?php if($crud->getEstadosA() != '5'){ ?>

                                           <td><span id="fechaI<?php echo $crud->getIdAcceso(); ?>"><?php echo $crud->getFechaInactivacion();  ?></span></td>

                                             <?php } else {
                                         ?>
                                             <td><span id="fechaI<?php echo $crud->getIdAcceso(); ?>"></span></td>
                                       <?php } ?>


                                        <?php if($crud->getEstadosA() != '6'){ ?>

                                            <td id="modificar"><button type="button" id="boton" class="btn btn-primary btn-sm detalleAcceso" data-toggle="modal" data-target="#detalleAcceso"   value="<?php echo $crud->getIdAcceso(); ?>"><span>Modificar.</span></button></td>
                                       <?php }

                                         ?>

                                         

                                    </tr>
                                    <?php 
                                      endforeach;
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row my-3">
                        <h6>Creaci&oacute;n de accesos</h6>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <button type="button" class="btn btn-primary" id="btn-creaAcceso" name="btn-creaAcceso">Agregar acceso</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-danger" id="btn-eliminaAcceso" name="btn-eliminaAcceso">Eliminar acceso</button>
                        </div>
                    </div>

                    <div class="row">
                        <span class="col-3 mt-2"><b>Tipo Acceso</b></span>
                        <span class="col-3 mt-2"><b>Nombre Usuario</b></span>
                        <span class="col-3 mt-2"><b>Contrase&ntilde;a</b></span>
                        <span class="col-3 mt-2"><b>Fecha de Registro</b></span>
                    </div>

                    <div class="row">
                          <div class="form-group col-3 my-2" id="tipo_acceso"></div>
                        <div class="form-group col-3 my-2" id="usuario"></div>
                        <div class="form-group col-3 my-2" id="clave"></div>
                        <div class="form-group col-3 my-2" id="fechaRegistro"></div>
                    </div>


                    
       <?php require('modifica_acceso.php'); ?>
     <script src="../../public/js/selector_acceso.js?v1"></script>




     <!-- cargos -->


     <div class="form-group checkbox-group required" style="overflow-y:scroll;height:auto;max-height:200px">
                                            <?php foreach($plataformas as $listado):?>
                                                <?php if($listado['estado'] == 5):?>
                                                <label class="col-sm-5"><input type="checkbox" id="plataformas<?= $listado['id_plataforma']?>" id="plataformas<?= $listado['id_plataforma']?>" value="<?=$listado['id_plataforma']?>"> <?= $listado['descripcion']?></label>
                                                <?php endif;?>
                                            <?php endforeach ?>
                                        </div>

    <!-- crear peticion -->
    <div style="overflow-y:scroll;height:auto;max-height:250px" class="checkbox-group required">
                                <?php foreach($plataformas as $listado):?>
                                    <?php if($listado['estado'] == 5):?>
                                    <label class="col-5"><input type="checkbox" name="plataformas<?= $listado['id_plataforma']?>" id="plataformas<?= $listado['id_plataforma']?>" value="<?=$listado['id_plataforma']?>"> <?= $listado['descripcion']?></label>
                                    <?php endif;?>
                                <?php endforeach ?>
                                </div>

    
$('#funcionarioAlterno').on('change',function(){
    if($('#funcionarioAlterno').val() == 0){
        fechaFuncionario();
    }else{
        var usuarioNombre = $('select[name="funcionarioAlterno"] option:selected').text();
        if(usuarioNombre.includes("Nuevo")){
            plataformasIngreso($('#funcionarioAlterno').val());
        }else{
            $('div.checkbox-group.required :checkbox').prop('checked', false);
            $('div.checkbox-group.required :checkbox').trigger('change');
        }
    }
}) 

function fechaFuncionario(){
    var data = "consultarFechaIngreso=1&funcionario=" + $('#funcionario').val();
    $.ajax({
        async: false,
        type:"POST",
        url:"../controller/controlador_peticionesAccesos.php",
        data:data
    }).done(function(respuesta){
        if(respuesta == 1){
            plataformasIngreso($('#funcionario').val());
        }else{
            limpiarChecks();
        }
    });
} 

//*****************************************************************************************************//
//***************** CONSULTA SI EL FUNCIONARIO ACTUAL ES NUEVO O ANTIGUO ******************************//
//*****************************************************************************************************//
    else if(isset($_POST['consultarFechaIngreso']) && $_POST['consultarFechaIngreso']){
        require('../model/crud_funcionarios.php');
        require('../model/datos_funcionarios.php');

        $crudF= new CrudFuncionarios();
        $datosFuncionario = $crudF->consultarFuncionarioxUsuario($_POST['funcionario']);
        foreach($datosFuncionario as $funcionariodata ){
            $f_fechaRegistro = $funcionariodata->getFechaRegistro();
        }
        date_default_timezone_set('America/Bogota');
        $fecha1 = new DateTime($f_fechaRegistro);
        $fecha2 = new DateTime('now');
        
        $intervalo = $fecha2->diff($fecha1);
        $varD = $intervalo->format('%a');
        if ($varD < 30){
            echo 1;
        }else{
            echo 0;
        }
    }





    /********************** inserciones eliminar fecha*/
    
    <div class="col-sm-2">
                                                            <input type="date" class="form-control" id="fecha<?php echo $numeracion;?>" name="fecha<?php echo $numeracion;?>" required>
                                                        </div> 





/**************************************eliminar accesos creados por el funcionari en boveda */
<div class="container-fluid px-5">
            <?php
            

        require_once('../controller/controlador_funcionarios.php');   
        require('../controller/control_tipo_accesos.php');  
      
        $crud = new CrudFuncionarios();
        $datos1 = new Funcionario();
        if(!isset($_SESSION['init'])){           
            $_SESSION['init'] = 1;                                    
        }        
        $consultaAccesosBoveda=$crud->detalleAccesoBoveda();
        $verificacion=$crud->verificacionBoveda();       
                /* if(isset($_SESSION['init'])){
                    if($_SESSION['init'] == 1){    
                        $_SESSION['init'] = 0;
                        if($verificacion == 0){                        
                            require('crear_boveda.php');
                        } else {                        
                            require('clave_acceso_boveda.php');
                        }  
                    }    
                }  */                            
            ?> 
            
            <div class="row my-3 mt-5">
                <h6>Creaci&oacute;n de accesos</h6>
            </div>
            <div class="row mb-3">
                <div class="col-1">
                    <button type="button" class="btn btn-primary btn-sm" id="btn-creaAcceso" name="btn-creaAcceso">Agregar acceso</button>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-danger btn-sm" id="btn-eliminaAcceso" name="btn-eliminaAcceso">Eliminar acceso</button>
                </div>
            </div>

            <div class="row">
                <span class="col-2 mt-2"><b>Tipo Acceso</b></span>
                <span class="col-2 mt-2"><b>Nombre Usuario</b></span>
                <span class="col-2 mt-2"><b>Contrase&ntilde;a</b></span>
                <span class="col-2 mt-2"><b>Fecha de Registro</b></span>
                
                    <!--------------------->
            </div>

            <div class="row">
                <div class="form-group col-2 my-2" id="tipo_acceso"></div>
                <div class="form-group col-2 my-2" id="usuario"></div>
                <div class="form-group col-2 my-2" id="clave"></div>
                <div class="form-group col-2 my-2" id="fechaRegistro"></div>

                <!--------------------->
            </div>
            <button class="btn btn-success btn-sm" id="btn-guardar">Guardar información</button>

            <hr/>
            <div class="row my-3">
                <h6>Modificar accesos.</h6>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <table class="table table-streed">
                        <thead>
                            <th style="display:none;"></th>
                            <th>Tipo Acceso</th>
                            <th>Usuario</th>
                            <th>Contrase&ntilde;a</th>                     
                            <th>Fecha Registro</th>                                                                                          
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            <?php foreach($consultaAccesosBoveda as $crud): ?>                            
                            <tr>                                
                                <td style="display:none;">
                                    <span id="codigos<?= $crud->getIdAcceso(); ?>"><?= $crud->getIdAcceso(); ?></span>
                                    <span id="claves<?= $crud->getIdAcceso(); ?>"><?= $crud->getClave();?></span>
                                </td>

                                <td style="display:none;">
                                    <span id="tipo_accesosA<?= $crud->getIdAcceso(); ?>"><?= $crud->getTipoAcceso();  ?></span>
                                </td>  

                                <td>
                                    <span id="acceso<?= $crud->getIdAcceso(); ?>"><?= $crud->getDescripcion();  ?></span>
                                </td>                                      

                                <td>
                                    <span id="nombreUsuario<?= $crud->getIdAcceso(); ?>"><?= $crud->getUsuario(); ?></span>
                                </td>

                                <td>                            
                                    <button type="button" id="boton_clave" data-toggle="modal" data-target="#claveInicial" value="<?php echo $crud->getIdAcceso(); ?>" class="claveInicial"><i class="far fa-eye"></i></button>
                                </td>                           

                                <td>
                                    <span id="fechas<?= $crud->getIdAcceso(); ?>"><?= $crud->getFechaRegistro();?></span>
                                </td>                           
                            
                                <td id="modificar">
                                    <button type="button" id="boton" data-toggle="modal" data-target="#detalleAcceso" value="<?php echo $crud->getIdAcceso(); ?>" class="btn btn-primary btn-sm detalleAcceso"><span>Modificar.</span></button>
                                </td>

                                <td>
                                    <button type="button" id="boton_eliminar<?=$i;?>" class="btn btn-danger btn-sm boton_eliminar" value="<?= $crud->getIdAcceso(); ?>"><span>Eliminar</span></button>
                                </td>
                                                
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <input type="hidden" name="counter" id="counter" value="<?=$i;?>">
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php require('modificar_acceso_boveda.php'); ?>
        <?php require('clave_acceso.php'); ?>
        <?php require('clave_inicial.php'); ?>






//**********************************************************************************************//
//******************************* SQL PARA MODIFICAR FUNCIONARIO  OLD **************************//
//***************************** crud_funcionario() *********************************************//
	

public function modificarFuncionarioXX($update){//OLD NO USE

	$estadoModificar = $_POST['f_estado'];
	$idproxifun = $_POST['funcionario_Transpaso'];

	if($estadoModificar == 16){
     
       $arreglo=[]; 
	    $db = conectar::acceso();
		$activos=$db->prepare("SELECT id_activo FROM activos_internos WHERE responsable_activo=:identificacion");
		$activos->bindValue('identificacion',$update->getF_identificacion());
		$activos->execute();
		$conteoActivos=$activos->rowCount();
		$arreglo = $activos->fetchAll(PDO::FETCH_COLUMN);

		if($conteoActivos != 0){

			for($i=0; $i<$conteoActivos; $i++){
			    	
														
				$crear_traslado=$db->prepare('INSERT INTO traslados(funcionario_inicial, fecha_asignado, funcionario_final, fecha_traslado, activo_traslado, descripcion_traslado )VALUES(:t_funcionarioI, :t_fechaA, :t_funcionarioF, :t_fechaT, :t_activo, :t_descripcion)');

	           	$crear_traslado->bindValue('t_funcionarioI',$update->getF_identificacion());
	           	$crear_traslado->bindValue('t_fechaA',$update->getF_fecha_inactivacion());
	           	$crear_traslado->bindValue('t_funcionarioF',$idproxifun); /*  */
               	$crear_traslado->bindValue('t_fechaT',$update->getF_fecha_sistema()); 
               	$crear_traslado->bindValue('t_activo',$arreglo[$i]);
               	$crear_traslado->bindValue('t_descripcion','Retiro Empleado');            
	          	$crear_traslado->execute();

			} 

			if($crear_traslado){

				$db=conectar::acceso();
				$modificarActivo=$db->prepare('UPDATE activos_internos SET responsable_activo=:areaInfraestructura,estado_activo=:estadoAsignado,fecha_asignacion=:fechaAsignacion WHERE responsable_activo= :identidad_funcionario');
				$modificarActivo->bindValue('areaInfraestructura',$idproxifun);
				$modificarActivo->bindValue('estadoAsignado',14);
				$modificarActivo->bindValue('identidad_funcionario',$update->getF_identificacion());
				$modificarActivo->bindValue('fechaAsignacion', $update->getF_fecha_sistema());
				$modificarActivo->execute();

 				if($modificarActivo){
					$db = conectar::acceso();
				    $modificar_funcionario=$db->prepare('UPDATE funcionarios SET  nombre= :f_nombre, mail= :f_email, area= :f_area, cargo= :f_cargo, festado= :f_estado, extension= :f_extension, rol= :f_rol, usuario= :f_usuario, contrasena= :f_contrasena, validacion= :f_validacion, fecha_sistema= :f_fecha_sistema, usuario_inactivacion = :f_usuario_inactivacion, fecha_inactivacion = :f_fecha_inactivacion, descripcion = :descripcion WHERE identificacion= :f_identificacion');

           		    $password=password_hash($update->getF_contrasena(), PASSWORD_DEFAULT, ["cost" => 15]);

					$modificar_funcionario->bindValue('f_identificacion',$update->getF_identificacion());
					$modificar_funcionario->bindValue('f_nombre',$update->getF_nombre());
					$modificar_funcionario->bindValue('f_email',$update->getF_email());
            		$modificar_funcionario->bindValue('f_area',$update->getF_area());
					$modificar_funcionario->bindValue('f_cargo',$update->getF_cargo());
					$modificar_funcionario->bindValue('f_estado',$update->getF_estado());
					$modificar_funcionario->bindValue('f_extension',$update->getF_extension());
					$modificar_funcionario->bindValue('f_rol',$update->getF_rol());
					$modificar_funcionario->bindValue('f_usuario',$update->getF_usuario());
					$modificar_funcionario->bindValue('f_contrasena',$password);
					$modificar_funcionario->bindValue('f_validacion',$update->getF_validacion());
					$modificar_funcionario->bindValue('f_fecha_sistema',$update->getF_fecha_sistema());
					$modificar_funcionario->bindValue('f_usuario_inactivacion',$update->getF_usuario_inactivacion());
					$modificar_funcionario->bindValue('f_fecha_inactivacion', $update->getF_fecha_inactivacion());
					$modificar_funcionario->bindValue('descripcion', $update->getDescripcionFinal());
					$modificar_funcionario->execute();

                 	if($modificar_funcionario){

             	        $db = conectar::acceso();
           		     	$accesos=$db->prepare("SELECT id_acceso FROM accesos WHERE id_usuario=:identidadA");
	     		    	$accesos->bindValue('identidadA',$update->getF_identificacion());
	     		    	$accesos->execute();
				    	$conteoAccesos=$accesos->rowCount();

				        if($conteoAccesos != 0 ){
			 		        $db=conectar::acceso();

			 		    	$cambioEstadoAcceso=$db->prepare('UPDATE accesos SET estado=:estadoI, fecha_inactivacion=:fechaInactivacionA WHERE id_usuario=:identidadF');
			 		    	$cambioEstadoAcceso->bindValue('estadoI',6);
			  		    	$cambioEstadoAcceso->bindValue('fechaInactivacionA',$update->getF_fecha_inactivacion());
			 		    	$cambioEstadoAcceso->bindValue('identidadF',$update->getF_identificacion());
			 		    	$cambioEstadoAcceso->execute();
					    }

						$consultarAccesosPlataformas = $db->prepare("SELECT plataforma FROM accesos_plataformas WHERE id_usuario = :identificacion && estado = 5");
						$consultarAccesosPlataformas->bindValue("identificacion", $update->getF_identificacion());
						$consultarAccesosPlataformas->execute();

						$cantidadAccesosPlataforma = $consultarAccesosPlataformas->rowcount();
						if($cantidadAccesosPlataforma > 0){
							$plataformas = "";
							foreach($consultarAccesosPlataformas->fetchall()  as $listado){
								$plataformas = $plataformas . $listado['plataforma'] . ',';
							}

							date_default_timezone_set('America/Bogota');

							$creaPeticionAcceso = $db->prepare("INSERT INTO peticiones_accesos(descripcion, tipo, plataformas, usuario_creacion, fecha_creacion, estado,conclusiones,  aprobacion)
							VALUES(:descripcion, :tipo, :plataformas, :usuario_creacion, :fecha_creacion, :estado, :conclusiones,  :aprobacion)");
							$creaPeticionAcceso->bindValue('descripcion', 'Retiro de empledo.');
							$creaPeticionAcceso->bindValue('tipo', 2);
							$creaPeticionAcceso->bindValue('plataformas',substr($plataformas, 0, -1));
							$creaPeticionAcceso->bindValue('usuario_creacion',$update->getF_usuario());
							$creaPeticionAcceso->bindValue('fecha_creacion', date('Y-m-d H:i:s'));
							$creaPeticionAcceso->bindValue('estado', 1);
							$creaPeticionAcceso->bindValue('conclusiones', 'Inactivacion de caracter Urgente.');
							$creaPeticionAcceso->bindValue('aprobacion', 12);
							$creaPeticionAcceso->execute();
						}

                    }	 				         	   				              

                }                                          
		
		    } if($crear_traslado ){
			    echo 1;
		    } else {
				echo 0;
			}

		} else {

			$db = conectar::acceso();
			$modificar_funcionario=$db->prepare('UPDATE funcionarios SET  nombre= :f_nombre, mail= :f_email, area= :f_area, cargo= :f_cargo, festado= :f_estado, extension= :f_extension, rol= :f_rol, usuario= :f_usuario, contrasena= :f_contrasena, validacion= :f_validacion, fecha_sistema= :f_fecha_sistema, usuario_inactivacion = :f_usuario_inactivacion, fecha_inactivacion = :f_fecha_inactivacion,intentos=:f_intento, descripcion = :descripcion, centro_de_costos = :centroCostos WHERE identificacion= :f_identificacion');

         	$password=password_hash($update->getF_contrasena(), PASSWORD_DEFAULT, ["cost" => 15]);

			$modificar_funcionario->bindValue('f_identificacion',$update->getF_identificacion());
			$modificar_funcionario->bindValue('f_nombre',$update->getF_nombre());
			$modificar_funcionario->bindValue('f_email',$update->getF_email());
            $modificar_funcionario->bindValue('f_area',$update->getF_area());
			$modificar_funcionario->bindValue('f_cargo',$update->getF_cargo());
			$modificar_funcionario->bindValue('f_estado',$update->getF_estado());
			$modificar_funcionario->bindValue('f_extension',$update->getF_extension());
			$modificar_funcionario->bindValue('f_rol',$update->getF_rol());
			$modificar_funcionario->bindValue('f_usuario',$update->getF_usuario());
			$modificar_funcionario->bindValue('f_contrasena',$password);
			$modificar_funcionario->bindValue('f_validacion',$update->getF_validacion());
			$modificar_funcionario->bindValue('f_fecha_sistema',$update->getF_fecha_sistema());
			$modificar_funcionario->bindValue('f_usuario_inactivacion',$update->getF_usuario_inactivacion());
			$modificar_funcionario->bindValue('f_fecha_inactivacion', $update->getF_fecha_inactivacion());
			$modificar_funcionario->bindValue('f_intento', 0);
			$modificar_funcionario->bindValue('descripcion', $update->getDescripcionFinal());
			$modificar_funcionario->bindValue('centroCostos', $update->getCentroCostos());
			$modificar_funcionario->execute();
		       

            if($modificar_funcionario){

                $db = conectar::acceso();
               	$accesos=$db->prepare("SELECT id_acceso FROM accesos WHERE id_usuario=:identidadA");
		     	$accesos->bindValue('identidadA',$update->getF_identificacion());
		     	$accesos->execute();
				$conteoAccesos=$accesos->rowCount();

			    if($conteoAccesos != 0 ){
					$db=conectar::acceso();

					$cambioEstadoAcceso=$db->prepare('UPDATE accesos SET estado=:estadoI,fecha_inactivacion=:fechaInactivacionA WHERE id_usuario=:identidadF');
					$cambioEstadoAcceso->bindValue('estadoI',6);
					$cambioEstadoAcceso->bindValue('fechaInactivacionA',$update->getF_fecha_inactivacion());
					$cambioEstadoAcceso->bindValue('identidadF',$update->getF_identificacion());
					$cambioEstadoAcceso->execute();
			    } 

				$consultarAccesosPlataformas = $db->prepare("SELECT plataforma FROM accesos_plataformas WHERE id_usuario = :identificacion && estado = 5");
				$consultarAccesosPlataformas->bindValue("identificacion", $update->getF_identificacion());
				$consultarAccesosPlataformas->execute();

				$cantidadAccesosPlataforma = $consultarAccesosPlataformas->rowcount();
				if($cantidadAccesosPlataforma > 0){
					$plataformas = "";
					foreach($consultarAccesosPlataformas->fetchall()  as $listado){
						$plataformas = $plataformas . $listado['plataforma'] . ',';
					}

					date_default_timezone_set('America/Bogota');

					$creaPeticionAcceso = $db->prepare("INSERT INTO peticiones_accesos(descripcion, tipo, plataformas, usuario_creacion, fecha_creacion, estado,conclusiones,  aprobacion)
					 VALUES(:descripcion, :tipo, :plataformas, :usuario_creacion, :fecha_creacion, :estado, :conclusiones,  :aprobacion)");
					$creaPeticionAcceso->bindValue('descripcion', 'Retiro de empledo.');
					$creaPeticionAcceso->bindValue('tipo', 2);
					$creaPeticionAcceso->bindValue('plataformas',substr($plataformas, 0, -1));
					$creaPeticionAcceso->bindValue('usuario_creacion',$update->getF_usuario());
					$creaPeticionAcceso->bindValue('fecha_creacion',date('Y-m-d H:i:s'));
					$creaPeticionAcceso->bindValue('estado', 1);
					$creaPeticionAcceso->bindValue('conclusiones', 'Inactivacion de caracter Urgente.');
					$creaPeticionAcceso->bindValue('aprobacion', 12);
					$creaPeticionAcceso->execute();
				}

			    if($modificar_funcionario || $cambioEstadoAcceso){
					echo 1;
				} else {
					echo 0;
				}
			}

		}	
    /*****************si NO cambia a la inactivacion entra por aqui*******************************/

	} else {

	    $db=conectar::acceso();
		$validarContrasena=$db->prepare('SELECT contrasena FROM funcionarios WHERE contrasena=:contrasenaP');
		$validarContrasena->bindValue('contrasenaP',$update->getF_contrasena());
		$validarContrasena->execute();
		$conteo = $validarContrasena->rowCount();
		if($conteo == 0){

			/* echo $update->getF_identificacion(); */
			$db=conectar::acceso();
			$modificar_funcionario=$db->prepare('UPDATE funcionarios SET  nombre= :f_nombre, mail= :f_email, departamento_interno=:departamentoInterno, area= :f_area, cargo= :f_cargo, festado= :f_estado, extension= :f_extension, rol= :f_rol, usuario= :f_usuario, contrasena= :f_contrasena, validacion= :f_validacion, fecha_sistema= :f_fecha_sistema, centro_de_costos = :centroCostos WHERE identificacion= :f_identificacion');

		    $password=password_hash($update->getF_contrasena(), PASSWORD_DEFAULT, ["cost" => 15]);

			$modificar_funcionario->bindValue('f_identificacion',$update->getF_identificacion());
			$modificar_funcionario->bindValue('f_nombre',$update->getF_nombre());
			$modificar_funcionario->bindValue('f_email',$update->getF_email());
            $modificar_funcionario->bindValue('f_area',$update->getF_area());
			$modificar_funcionario->bindValue('f_cargo',$update->getF_cargo());
			$modificar_funcionario->bindValue('f_estado',$update->getF_estado());
			$modificar_funcionario->bindValue('f_extension',$update->getF_extension());
			$modificar_funcionario->bindValue('f_rol',$update->getF_rol());
			$modificar_funcionario->bindValue('f_usuario',$update->getF_usuario());
			$modificar_funcionario->bindValue('f_contrasena',$password);
			$modificar_funcionario->bindValue('f_validacion',$update->getF_validacion());
			$modificar_funcionario->bindValue('f_fecha_sistema',$update->getF_fecha_sistema());
			$modificar_funcionario->bindValue('centroCostos', $update->getCentroCostos());	
			$modificar_funcionario->bindValue('departamentoInterno', $update->getDepartamentoInterno());									
			$modificar_funcionario->execute();

			if($_POST['cantidad'] != 0){
	            	
	            for($i=1; $i<= $_POST['cantidad']; $i++) {
                	$update->setTipoAcceso($_POST['tipo_acceso'.$i]);
                    $update->setUsuario($_POST['usuario'.$i]);
                    $update->setClave($_POST['clave'.$i]);
                    $update->setFechaRegistro($_POST['fechaRegistro'.$i]);
		                      		                        
            		$inserta_acceso=$db->prepare('INSERT INTO accesos(id_usuario,tipo_acceso,usuario,clave,estado,fecha_registro) VALUES(:id_usuario,:tipo_acceso,:usuario,:clave,:estado,:fecha_registro)'); //**************************   
            		
            		$inserta_acceso->bindValue('id_usuario',$update->getF_identificacion());
                    $inserta_acceso->bindValue('tipo_acceso',$update->getTipoAcceso());
                    $inserta_acceso->bindValue('usuario',$update->getUsuario());
                    $inserta_acceso->bindValue('clave',$update->getClave());
                    $inserta_acceso->bindValue('estado',5);
                    $inserta_acceso->bindValue('fecha_registro',$update->getFechaRegistro());
                                               
                    $inserta_acceso->execute();  
	            }  

			}  if ($modificar_funcionario || $inserta_acceso){
					echo 1;
			} else {
					echo 0;
			}

		} else {

				$db=conectar::acceso();
			$modificar_funcionario=$db->prepare('UPDATE funcionarios SET  nombre= :f_nombre, mail= :f_email, departamento_interno=:departamentoInterno, area= :f_area, cargo= :f_cargo, festado= :f_estado, extension= :f_extension, rol= :f_rol, usuario= :f_usuario, centro_de_costos=:centroCostos WHERE identificacion= :f_identificacion');	

			$modificar_funcionario->bindValue('f_identificacion',$update->getF_identificacion());
			$modificar_funcionario->bindValue('f_nombre',$update->getF_nombre());
			$modificar_funcionario->bindValue('f_email',$update->getF_email());
            $modificar_funcionario->bindValue('f_area',$update->getF_area());
			$modificar_funcionario->bindValue('f_cargo',$update->getF_cargo());
			$modificar_funcionario->bindValue('f_estado',$update->getF_estado());
			$modificar_funcionario->bindValue('f_extension',$update->getF_extension());
			$modificar_funcionario->bindValue('f_rol',$update->getF_rol());
			$modificar_funcionario->bindValue('f_usuario',$update->getF_usuario());	
			$modificar_funcionario->bindValue('centroCostos', $update->getCentroCostos());
			$modificar_funcionario->bindValue('departamentoInterno', $update->getDepartamentoInterno());											
			$modificar_funcionario->execute();

			if($_POST['cantidad'] != 0){
		            	
		        for($i=1; $i<= $_POST['cantidad']; $i++) {
                	$update->setTipoAcceso($_POST['tipo_acceso'.$i]);
                    $update->setUsuario($_POST['usuario'.$i]);
                    $update->setClave($_POST['clave'.$i]);
                    $update->setFechaRegistro($_POST['fechaRegistro'.$i]);
                  
                	 //**************************
            		$inserta_acceso=$db->prepare('INSERT INTO accesos(id_usuario,tipo_acceso,usuario,clave,estado,fecha_registro) VALUES(:id_usuario,:tipo_acceso,:usuario,:clave,:estado,:fecha_registro)'); //**************************   
            		
            		$inserta_acceso->bindValue('id_usuario',$update->getF_identificacion());
                    $inserta_acceso->bindValue('tipo_acceso',$update->getTipoAcceso());
                    $inserta_acceso->bindValue('usuario',$update->getUsuario());
                    $inserta_acceso->bindValue('clave',$update->getClave());
                    $inserta_acceso->bindValue('estado',5);
                    $inserta_acceso->bindValue('fecha_registro',$update->getFechaRegistro());
                                               
                    $inserta_acceso->execute();  
		        }  

			}  if ($modificar_funcionario || $inserta_acceso){
					echo 1;
				} else {
					echo 0;
				}	

		}
							
	}

}


//**********************************************************************************************//
//******************************* SQL PARA CREAR ACCESOS A LOS  FUNCIONARIO  CUNADO SE CREAVA EL FUNCIONARIO DESDE LA VISTA DE USUARIO **************************//
//***************************** crud_funcionario() *********************************************//


/* if($_POST['cantidad']>0){
            
            for($i=1;$i<=$_POST['cantidad'];$i++){
                 $create->setTipoAcceso($_POST['tipo_acceso'.$i]);
                 $create->setUsuario($_POST['usuario'.$i]);
                 $create->setClave($_POST['clave'.$i]);
                 $create->setFechaRegistro($_POST['fechaRegistro'.$i]);                        
                 //**************************
                $inserta_acceso=$db->prepare('INSERT INTO accesos(id_usuario,tipo_acceso,usuario,clave,estado,fecha_registro) VALUES(:id_usuario,:tipo_acceso,:usuario,:clave,:estado,:fecha_registro)'); //**************************   
                        $inserta_acceso->bindValue('id_usuario',$create->getF_identificacion());
                        $inserta_acceso->bindValue('tipo_acceso',$create->getTipoAcceso());
                        $inserta_acceso->bindValue('usuario',$create->getUsuario());
                        $inserta_acceso->bindValue('clave',$create->getClave());
                        $inserta_acceso->bindValue('estado',5);
                        $inserta_acceso->bindValue('fecha_registro',$create->getFechaRegistro());
                        $inserta_acceso->execute();    
            }; */