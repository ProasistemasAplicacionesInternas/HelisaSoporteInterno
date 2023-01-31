<?php 

//*****************************************************************************************************//
//********************************CONTROLADOR DE LAS ACCIONES DE FUNCIONARIOS**************************//
//*****************************************************************************************************//

require_once('../model/crud_funcionarios.php');
require_once('../model/datos_funcionarios.php');
require_once('../../public/lib/password.php');



$crud= new CrudFuncionarios();
$funcionario= new Funcionario();
$listado_funcionarios=$crud->mostrarFuncionarios();


//********************************************************************************************//
//*******************************CONTROLADOR PARA CREAR fUNCIONARIO***************************//
//********************************************************************************************//
    
if (isset($_POST['crear']) && ($_POST['crear']==1)) {
   
    $funcionario->setF_identificacion($_POST['f_identificacion']);
    $funcionario->setF_nombre($_POST['f_nombre']);
    $funcionario->setF_email($_POST['f_correo']);
    $funcionario->setF_email2($_POST['f_correo2']);
    $funcionario->setF_extension($_POST['f_extension']);
    $funcionario->setF_area($_POST['f_area']);
    $funcionario->setF_cargo($_POST['f_cargo']);
    $funcionario->setF_usuario($_POST['f_usuario']);
    $funcionario->setF_contrasena($_POST['f_contrasena']);
    $funcionario->setF_estado(5);
    $funcionario->setF_rol($_POST['f_rol_funcionario']);
    $funcionario->setCentroCostos($_POST['f_centroCostos']);
    $funcionario->setDepartamentoInterno($_POST['f_departamentoInterno']);
    $funcionario->setF_validacion('1');
    

    $crud->crearFuncionario($funcionario);
    
    
}

//*****************************************************************************************************//
//**********************************CONTROLADOR PARA MODIFICAR ACCESOS*****************************//
//*****************************************************************************************************//



if(isset($_POST['modificaAcceso']) ){

    $funcionario->setIdAcceso($_POST['codigos']);
    $funcionario->setUsuario($_POST['nombreUsuario']);
    $funcionario->setClave($_POST['claves']);
    $funcionario->setFechaRegistro($_POST['fechas']);
    $funcionario->setTipoAcceso($_POST['tipo_accesos']);
    $funcionario->setEstadosA($_POST['estadoA']);   
	 $funcionario->setFechaInactivacion(date('Y-m-d'));
  
    $crud->actualizarAcceso($funcionario);

}



//*****************************************************************************************************//
//**********************************CONTROLADOR PARA MODIFICAR FUNCIONARIO*****************************//
//*****************************************************************************************************//

if (isset($_POST['modificar_funcionario'])&&($_POST['modificar_funcionario'] ==1)) {

    session_start();
    $funcionario->setF_identificacion($_POST['f_identificacion']);
    $funcionario->setF_nombre($_POST['f_nombre']);
    $funcionario->setF_email($_POST['f_correo']);
    $funcionario->setF_email2($_POST['f_correo2']);
    $funcionario->setF_extension($_POST['f_extension']);
    $funcionario->setF_area($_POST['f_area']);
    $funcionario->setF_cargo($_POST['f_cargo']);
    $funcionario->setF_usuario($_POST['f_usuario']);
    $funcionario->setF_contrasena($_POST['f_contrasena']);
    $funcionario->setF_estado($_POST['f_estado']);
    $funcionario->setF_rol($_POST['f_rol']);
    $funcionario->setF_validacion('1');
    $funcionario->setF_fecha_inactivacion($_POST['f_fecha_inactivacion']);  
    $funcionario->setF_usuario_inactivacion($_SESSION['usuario']);   
    date_default_timezone_set('America/Bogota');
    $funcionario->setF_fecha_sistema(date('Y-m-d H:i:s'));
    $funcionario->setDescripcionFinal($_POST['descripcion']);
    $funcionario->setCentroCostos($_POST['centroCostos']);
    $funcionario->setDepartamentoInterno($_POST['departamentoInterno']);
    $funcionario->setTipoValidacion($_POST['f_tipoValidacion']);

    $crud->modificarFuncionario($funcionario);
    
}

//*****************************************************************************************************//
//**********************************CONTROLADOR PARA MODIFICAR FUNCIONARIOS INACTIVOS******************//
//*****************************************************************************************************//

if (isset($_POST['modificar_funcionarioInactivo'])) {
 session_start();
    $funcionario->setF_identificacion($_POST['f_identificacion']);
    $funcionario->setF_nombre($_POST['f_nombre']);
    $funcionario->setF_email($_POST['f_correo']);
    $funcionario->setF_extension($_POST['f_extension']);
    $funcionario->setF_area($_POST['f_area']);
    $funcionario->setF_cargo($_POST['f_cargo']);
    $funcionario->setF_usuario($_POST['f_usuario']);
    $funcionario->setF_contrasena($_POST['f_contrasena']);
    $funcionario->setF_estado($_POST['f_estado']);
    $funcionario->setF_rol(4);
    $funcionario->setF_validacion('0');   
    $funcionario->setF_usuario_activacion($_SESSION['usuario']);
    $funcionario->setDescripcionFinal($_POST['descripcionActiva']);

      date_default_timezone_set('America/Bogota');
    $funcionario->setF_fecha_activacion(date('Y-m-d H:i:s'));


    $crud->modificarFuncionarioInactivo($funcionario);
    
    echo  "<script type='text/javascript'>window.close();</script>";
}


//*****************************************************************************************************//
//************************************CONTROLADOR ELIMINAR FUNCIONARIO*********************************//
//*****************************************************************************************************//

if (isset($_POST['eliminar_funcionario'])) {

    $funcionario->setF_identificacion($_POST['f_identificacion']);
    $funcionario->setF_nombre($_POST['f_nombre']);
    $funcionario->setF_email($_POST['f_correo']);
    $funcionario->setF_extension($_POST['f_extension']);
    $funcionario->setF_area($_POST['f_area']);
    $funcionario->setF_cargo($_POST['f_cargo']);
    $funcionario->setF_usuario($_POST['f_usuario']);
    $funcionario->setF_contrasena($_POST['f_contrasena']);
    $funcionario->setF_rol(4);
    $funcionario->setF_validacion('0');

    $crud->eliminarFuncionario($funcionario);
    
    header ("location: ../../dashboard.php");
 }


//***********************************************************************************//
//********************* CONTROLADOR VALIDAR LOGIN DEL FUNCIONARIO *******************//
//***********************************************************************************//

if (isset($_POST['ingresar'])) {
    $usuarioLogin = htmlentities(addslashes($_POST['f_user']));
	$usuarioValidacion = strtolower($usuarioLogin);

    $funcionario->setF_usuario($usuarioValidacion);
    $funcionario->setF_contrasena(htmlentities(addslashes($_POST['f_password'])));
    $crud->validaLoginFuncionario($funcionario);

}

if ((isset($_POST ['x']))){
    $funcionario->setF_usuario($_SESSION['usuario']);
    $crud = $verifica->validacionAlCo($funcionario);
    echo $respuesta;
}

//***********************************************************************************//
//********************* CONTROLADOR para CARGO, ESTADO Y AREA FUNCIONARIO *******************//
//***********************************************************************************//

if (isset($_POST['modificar'])) {

    $datosListados=$crud->consultaModificar();

    $codigoArea=$datosListados['id_area'];
    $nombreArea=$datosListados['descripcion1'];
    $codigoCargo=$datosListados['id_cargo'];
    $nombreCargo=$datosListados['descripcion2'];
    $codigoEstado=$datosListados['id_estado'];
    $nombreEstado=$datosListados['descripcion3'];
   

    $datosModificacion=$crud->consultarFuncionarios();
}




//***********************************************************************************//
//************* CONTROLADOR PARA CAMBIAR LA CONTRASEÃ‘A DEL FUNCIONARIO **************//
//***********************************************************************************//

if (isset($_POST['cambiar_contrasena'])) {
    session_start();
    $funcionario->setF_contrasena($_POST['clave']);
    $funcionario->setF_usuario($_SESSION['usuario']);
    
    $crud->cambioContrasena($funcionario);
    
   header('Location:../../dashboard_funcionarios.php');
}

//***********************************************************************************//
//************* CONTROLADOR PARA ENVIAR CORREO **************//
//***********************************************************************************//

if (isset($_POST['restablecer-correo'])) {
     
    $funcionario->setF_usuario($_POST['usuario']);       
    $crud->restablecerCuentaF($funcionario);
    
    header('Location:cerrar_loginF.php');
}

//***********************************************************************************//
//************* CONTROLADOR PARA RESTABLECER CUENTA **************//
//***********************************************************************************//

if(isset($_POST['validar_contrasenaF'])) {
    $funcionario->setF_contrasena(htmlentities(addslashes($_POST['contrasena'])));   
    $funcionario->setF_usuario($_POST['usuario']);   
    $crud->restablecerContrasenaF($funcionario);
}

//*****************************************************************************************************//
//**********************************CONTROLADOR PARA MODIFICAR ACCESOS DE BOVED*****************************//
//*****************************************************************************************************//

if (isset($_POST['accesos_boveda'])&&($_POST['accesos_boveda'] ==1)) {

    session_start();
    $funcionario->setF_usuario($_SESSION['usuario']);
    $crud->creaAccesosBoveda($funcionario);
    
}

if (isset($_POST['modificaBoveda'])&&($_POST['modificaBoveda'] ==1)) {
    $funcionario->setIdAcceso($_POST['codigos']);
    $funcionario->setUsuario($_POST['nombreUsuario']);
    $funcionario->setFechaRegistro($_POST['fechas']);   
    $crud->actualizarBoveda($funcionario);
    
}

if (isset($_POST['eliminarBoveda'])&&($_POST['eliminarBoveda'] ==1)) {
    $funcionario->setIdAcceso($_POST['codigos']);
    $crud->eliminarBoveda($funcionario);
}


if (isset($_POST['verificarBoveda'])&&($_POST['verificarBoveda'] ==1)) {
    session_start();
    $funcionario->setF_contrasena($_POST['clave']);
    $funcionario->setUsuario($_SESSION['usuario']);
    $crud->verBoveda($funcionario);
}

if (isset($_POST['modificarClaveBoveda'])&&($_POST['modificarClaveBoveda'] ==1)) {    
    $funcionario->setIdAcceso($_POST['codigos']);
    $funcionario->setF_contrasena($_POST['clavesBoveda']);
    $crud->modificarBoveda($funcionario);
}

if (isset($_POST['claveInicialBoveda'])&&($_POST['claveInicialBoveda'] ==1)) {   
    session_start(); 
    $funcionario->setF_usuario($_SESSION['usuario']);
    $funcionario->setF_contrasena($_POST['claveBoveda']);
    $crud->clavePrimeraBoveda($funcionario);
}

//*******************************************************************************/

if(isset($_POST['getPassword'])&&($_POST['getPassword'])==1){
    session_start();
    $funcionario->setIdAcceso($_POST['id']);
    $crud->detallePassword($funcionario);
}

//*****************************************************************************************************//
//**************************** Consulta los datos Glovales del funcionario ****************************//
//******************************* (datos Personales, activos, accesos) ********************************//
//*****************************************************************************************************//
if(isset($globalDataFuncionario) && $globalDataFuncionario = 1){
    $datosFuncionario = $crud->consultarDatosFuncionario($usuario);
    $accesosFuncionario = $crud->consultaAccesosFuncionario($usuario);
    $activosFuncionario = $crud->consultarActivosFuncionario($usuario);
}


?>