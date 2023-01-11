<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

ini_set("session.cookie_lifetime","18000");
ini_set("session.gc_maxlifetime","18000");
session_start();

require_once('../model/crud_peticiones.php');
require_once('../model/datos_peticion.php');


require_once('../model/datos_soportemai.php');

require_once('../model/crud_peticionesmai.php');
require_once('../model/datos_peticionesmai.php');

$crud= new CrudPeticiones();
$peticion= new Peticion();


$crudMai= new CrudPeticionesMai();
$peticionMai= new PeticionMai();

//*******************************************************************************//
//************************** PARA EL CARGUE DE LA IMAGEN ************************//
//*******************************************************************************//

define('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/infraestructura'); /* MODIFCAR AL CAMBIAR A PRODUCCION */ /* /carpeta_principal_proyecto */ 
    
    $nombre_imagen = array(0=>2,1=>2,2=>2);
    $numImagenes = count($_FILES['imagen']['name']);/* cuenta el numero de elemntos en el array(sino hay ninguno el resultado sera 1) */


    for($x = 0; $x < $numImagenes; $x++){
        $random = rand(100,1000);
        $nombre_archivo=$_FILES['imagen']['name'];
        $nombre_archivo=preg_replace('/\\.[^.\\s]{3,4}$/', '', $nombre_archivo);
        $tipo_imagen=$_FILES['imagen']['type'][$x];
        $tamano_imagen=$_FILES['imagen']['size'][$x];
        $extension_archivo = pathinfo( $_FILES['imagen']['name'][$x], PATHINFO_EXTENSION);
        if( $tamano_imagen!=0){    
            $nombre_imagen[$x]= 'imagen' . $random . time() . "." .  $extension_archivo;
        }else{
            
            $nombre_imagen[$x]='2';
        } 
        //echo $tipo_imagen;
        if($tamano_imagen<=10000000000){
            if($tipo_imagen=="image/jpeg" ||$tipo_imagen=="image/jpg" ||$tipo_imagen=="image/png" ||$tipo_imagen=="image/gif" ||$tipo_imagen=="image/jpg" || $tipo_imagen=="application/pdf"  ){    
            move_uploaded_file($_FILES['imagen']['tmp_name'][$x],DOCROOT .'/cartas/' .$nombre_imagen[$x]);        
                
                }
        }
        //echo "<br>",$nombre_imagen[0],"<br>",$nombre_imagen[1],"<br>",$nombre_imagen[2],"<br>";
    }
// echo "<br>",$nombre_imagen[0],"<br>",$nombre_imagen[1],"<br>",$nombre_imagen[2],"<br>";


//*******************************************************************************//
//*********************** CONTROLADOR PARA CREAR PETICION ***********************//
//*******************************************************************************//
if (isset($_POST['btn-enviar_peticion'])) {
    date_default_timezone_set('America/Bogota');
    $area_peticion=$_POST['area_peticion'];
        if($area_peticion==1){
            $equipos = $_POST['p_categoria'];
            if($equipos==16){
                $peticion->setP_categoria($_POST['p_categoria']);
                $peticion->setP_descripcion(htmlspecialchars($_POST['p_descripcion']));
                $peticion->setP_cargarimagen($nombre_imagen[0]);
                $peticion->setP_cargarimagen2($nombre_imagen[1]);
                $peticion->setP_cargarimagen3($nombre_imagen[2]);
                $peticion->setP_activo($_POST['p_activo']);
                $peticion->setP_codigoactivo($_POST['p_codigoactivo']);
                $peticion->setP_usuario($_SESSION['usuario']);
                $peticion->setP_estado(1);
                $peticion->setP_fechapeticion(date('Y-m-d H:i:s'));
                $crud->crearPeticiones($peticion); 
            }else{
                $peticion->setP_categoria($_POST['p_categoria']);
                $peticion->setP_descripcion(htmlspecialchars($_POST['p_descripcion']));
                $peticion->setP_cargarimagen($nombre_imagen[0]);
                $peticion->setP_cargarimagen2($nombre_imagen[1]);
                $peticion->setP_cargarimagen3($nombre_imagen[2]);
                $peticion->setP_activo($_POST['p_activo']);
                $peticion->setP_codigoactivo(NULL);
                $peticion->setP_usuario($_SESSION['usuario']);
                $peticion->setP_estado(1);
                $peticion->setP_fechapeticion(date('Y-m-d H:i:s'));
                $crud->crearPeticiones($peticion);
            }
        }elseif($area_peticion==2){
            $peticionMai->setProducto_peticionMai($_POST['productoMai']);
            $peticionMai->setReq_Justification($_POST['req_Justification']);
            $peticionMai->setReq_Name($_POST['req_Name']);
            $peticionMai->setUsuario_creacionMai($_SESSION['usuario']);
            $peticionMai->setDescripcion_peticionMai(htmlspecialchars($_POST['p_descripcion']));
            $peticionMai->setFecha_peticionMai(date('Y-m-d H:i:s'));
            $peticionMai->setEstado_peticionMai(1);
            $peticionMai->setImagen_peticionMai($nombre_imagen[0]);
            $peticionMai->setImagen_peticionMai2($nombre_imagen[1]);
            $peticionMai->setImagen_peticionMai3($nombre_imagen[2]);
            $peticionMai->setName($_POST['soporteMai']);
            
            $crudMai->crearPeticionesMai($peticionMai);
        }
        if(isset($_SESSION['id_roles']) && $_SESSION['id_roles']==5){
            header('Location:../../dashboard.php');
        }else if(isset($_SESSION['rol']) && $_SESSION['rol']==4 || $_SESSION['rol']==2){
            header('Location:../../dashboard_funcionarios.php');        
        }
}
?>