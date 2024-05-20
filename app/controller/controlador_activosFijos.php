<?php 

//*****************************************************************************************************//
//******************************* CONTROLADOR DE LAS ACCIONES DE ACTIVO FIJO **************************//
//*****************************************************************************************************//
require_once('../model/crud_activosFijos.php');
require_once('../model/datos_activosFijos.php');
require_once('../model/consulta_activosFuncionario.php');

$crud = new crudActivos();
$activoFijo = new activosFijos();

/*$consult = new consultar_activos(); 
$activos_Asignados = $consult->matrizActivosFuncionario();*/



//********************************************************************************************//
//*******************************CONTROLADOR PARA CREAR ACTIVO FIJO***************************//
//********************************************************************************************//

        if (isset($_POST['crear']) && ($_POST['crear']==1)) {
            $nombre_imagen = "No aplica";
            if (isset($_FILES['af_imagen1'])) {
                $imagen = $_FILES['af_imagen1'];
            
                if ($imagen['error'] == UPLOAD_ERR_OK) {
                    $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
                    $nombre_imagen = uniqid() . "." . $ext;
                    move_uploaded_file($imagen['tmp_name'], "../../img/$nombre_imagen");
                    
                }
                
            }

            if($_POST['af_fechaAsignacion'] == ""){
                  date_default_timezone_set('America/Bogota');
                  $hoy = date("Y-m-d");
                  $activoFijo->setAf_fechaAsignacion($hoy);
            }else{
                $activoFijo->setAf_fechaAsignacion($_POST["af_fechaAsignacion"]);
            }
             
            if($_POST['af_estado'] == 15){
                if($_POST['af_areaCreacion'] == 'Infraestructura'){
                    $activoFijo->setAf_funcionario("800042928");
                }else if($_POST['af_areaCreacion'] == 'Administración'){
                    $activoFijo->setAf_funcionario("80008000");
                }
            }else{
                $activoFijo->setAf_funcionario($_POST['af_responsable']);
            }
              
                
                $activoFijo->setAf_codigo($_POST['af_codigo']);
                $activoFijo->setAf_serial($_POST['af_serial']);
                $activoFijo->setAf_nombre($_POST['af_nombre']);
                $activoFijo->setAf_estado($_POST['af_estado']);
                $activoFijo->setAf_marca($_POST['af_marca']);
                $activoFijo->setAf_modelo($_POST['af_modelo']);
                $activoFijo->setAf_fechaCompra($_POST['af_fechaCompra']);
                $activoFijo->setAf_grupo($_POST['af_categoria']);
                $activoFijo->setAf_area($_POST['af_area']);
                $activoFijo->setAf_ubicacion($_POST['af_ubicacion']);
                $activoFijo->setAf_observaciones($_POST['af_observaciones']);
                $activoFijo->setAf_ram($_POST['af_ram']);
                $activoFijo->setAf_disco($_POST['af_discoDuro']);
                $activoFijo->setAf_procesador($_POST['af_procesador']);
                $activoFijo->setAf_licenciaOffice($_POST['af_office']);
                $activoFijo->setAf_licenciaAntivirus($_POST['af_antivirus']);
                $activoFijo->setAf_aplicaciones($_POST['af_aplicaciones']);
                $activoFijo->setAf_licenciaSO($_POST['af_licenciaSo']);
                $activoFijo->setAf_dominio($_POST['af_dominio']);
                $activoFijo->setAf_sistemaOperativo($_POST['af_so']);
                $activoFijo->setNombre($_POST['nombre_usu']);
                $activoFijo->setImagenactivo($nombre_imagen);
                $activoFijo->setcostoCompra($_POST['costoCompra']);
                $activoFijo->settipoAct($_POST['tipoAct']);
                $activoFijo->setvidaUtil($_POST['vidaUtil']);
                $activoFijo->setestadoAct($_POST['estadoAct']);
                $activoFijo->settraCategoria($_POST['traCategoria']);
                $crud->crearActivos($activoFijo);    
        }

//********************************************************************************************//
//**************** PARA EL BOTON DE MODIFICAR EN LA CONSULTA DE ACTIVOS **********************//
//********************************************************************************************//
      
      
       if (isset($_POST['modificar_activo'])) {

            $datosListados=$crud->consultaModificarActivo();

            $codigoArea=$datosListados['id_area'];
            $nombreArea=$datosListados['descripcion1'];
            $codigoGrupo=$datosListados['id_grupo'];
            $nombreGrupo=$datosListados['nombre_grupo'];
            $identificacionResponsable=$datosListados['identificacion'];
            $nombreResponsable=$datosListados['nombre'];
            $codigoEstado=$datosListados['id_estado'];
            $nombreEstado=$datosListados['nombre_estado'];

            $datosModificacion=$crud->consultarActivos();
}


//********************************************************************************************//
//*************************** CONTROLADOR PARA GUARDAR CAMBIOS *******************************//
//********************************************************************************************//


        if (isset($_POST['guardar_modificaciones'])&& ($_POST['guardar_modificaciones']==1)) {

            if (isset($_FILES['af_imagen1'])) {
                $imagen = $_FILES['af_imagen1'];
                $deleteImg = $_POST['deleteImg'];
                if ($imagen['error'] == UPLOAD_ERR_OK) {
                    $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
                    $nombre_imagen = uniqid() . "." . $ext;
                    move_uploaded_file($imagen['tmp_name'], "../../img/$nombre_imagen");
                    
                }
                if (file_exists('../../img/'.$deleteImg)) {
                    unlink('../../img/'.$deleteImg);
                }
                
            }else if (isset($_POST['af_imagen1'])){
                $nombre_imagen = $_POST['af_imagen1'];
            }

            $activoFijo->setAf_codigo($_POST['af_codigo']);
            $activoFijo->setAf_serial($_POST['af_serial']);
            $activoFijo->setAf_nombre($_POST['af_nombre']);
            $activoFijo->setAf_estado($_POST['af_estado']);
            $activoFijo->setAf_marca($_POST['af_marca']);
            $activoFijo->setAf_modelo($_POST['af_modelo']);
            $activoFijo->setAf_fechaCompra($_POST['af_fechaCompra']);
            $activoFijo->setAf_grupo($_POST['af_categoria']);
            $activoFijo->setAf_area($_POST['af_area']);
            $activoFijo->setAf_ubicacion($_POST['af_ubicacion']);
            $activoFijo->setAf_observaciones($_POST['af_observaciones']);
            $activoFijo->setAf_ram($_POST['af_ram']);
            $activoFijo->setAf_disco($_POST['af_discoDuro']);
            $activoFijo->setAf_procesador($_POST['af_procesador']);
            $activoFijo->setAf_sistemaOperativo($_POST['af_so']);
            $activoFijo->setAf_licenciaSO($_POST['af_licenciaSo']);
            $activoFijo->setAf_dominio($_POST['af_dominio']);
            $activoFijo->setAf_licenciaOffice($_POST['af_office']);
            $activoFijo->setAf_licenciaAntivirus($_POST['af_antivirus']);
            $activoFijo->setAf_aplicaciones($_POST['af_aplicaciones']);
            $activoFijo->setNombre($_POST['nombre_usu']);
            $activoFijo->setImagenactivo($nombre_imagen);
            $activoFijo->setcostoCompra($_POST['costoCompra']);
            $activoFijo->settipoAct($_POST['tipoAct']);
            $activoFijo->setvidaUtil($_POST['vidaUtil']);
            $activoFijo->setestadoAct($_POST['estadoAct']);
            $activoFijo->settraCategoria($_POST['traCategoria']);
            $crud->modificarActivos($activoFijo);            
        }
        if (isset($_POST['creacion'])) {
            echo "Llega al controlador";
        }

        function str_random ($path_info) {
            $string = 'AaBbCcDdEeFfGgHhIiJjKkLlMm0123456789_';
            return str_shuffle($string) . '.' . $path_info['extension'];
        }

    