<?php 
    require('../model/crud_peticionesAccesos.php');
    require('../model/datos_peticionesAccesos.php');
    require_once('../model/datos_accesosPlataformas.php');
    $crud = new peticionesAccesos();
    $datos = new datosPeticionAccesos();
    define('numPlataformas', 300);

//*****************************************************************************************************//
//********************************** DEFINICIION DE ACCESO A ROL MAI **********************************//
//*****************************************************************************************************//
    if(session_status() == 0 || session_status() == 1){
        session_start();
    }
    if(isset($_SESSION['id_roles']) && $_SESSION['id_roles'] == 7){
        $consultaMai = 1;
    }else{
        $consultaMai = 0;
    }

//*****************************************************************************************************//
//**********************************CREACION DE PETICIONES ACCESO *************************************//
//*****************************************************************************************************//
    if(isset($_POST['crear_peticion_accesos'])){
        
        date_default_timezone_set('America/Bogota');

        if(isset($_POST['funcionarioAlterno']) && $_POST['funcionarioAlterno'] != '0'){
            $datos->setUsuario_creacion($_POST['funcionarioAlterno']);
            $datos->setAprobado(12);
            $datos->setConclusiones('Peticion generada por ' . $_POST['funcionario'] . ' Director(a) y/o auxiliar de departamento.');
        }else{
            $datos->setUsuario_creacion($_POST['funcionario']);
            $datos->setAprobado(0);
            $datos->setConclusiones('');
        }

        $existAcces = 0;
        $plataformas = array();
        foreach($crud->administradores() as $listado){
            $plataformas[$listado] = '';
        }

        for($x=1;$x<numPlataformas;$x++){
            $p = 'plataformas' . $x;
            if(isset($_POST[$p])){
                if($_POST['tipo'] == 2){//Inactivacion
                    if($crud->trueAcces($_POST[$p],$datos->getUsuario_creacion()) == 1 && $crud->accesoEnPeticion($_POST[$p],$datos->getUsuario_creacion()) == 0){
                        $administrador = $crud->administradorxPltaforma($_POST[$p]);
                        $plataformas[$administrador] .= $_POST[$p] . ',';
                        $existAcces = 1;
                    }
                }else{//activacion
                    $administrador = $crud->administradorxPltaforma($_POST[$p]);
                    $plataformas[$administrador] .= $_POST[$p] . ',';
                    $existAcces = 1;  
                }
            }
        }

        $datos->setFecha_creacion(date('Y-m-d H:i:s'));
        $datos->setDescripcion($_POST['descripcion']);
        $datos->setTipo($_POST['tipo']);

        if($existAcces == 1){
            foreach($plataformas as $listado){
                if($listado != ''){
                    $datos->setPlataformas(substr($listado, 0, -1));
                    $accion = $crud->crearPeticion($datos);
                }
            }
        }else{
            $accion = 1;
        }
        

        if($accion == 1){
            header('Location: ../../dashboard_funcionarios.php');
        }else if($accion == 2){
            echo 'ERROR ERROR';
        }
        
    }

//*****************************************************************************************************//
//***************** PERMISO PARA "PETICION DIRIGIDA" EN CREAR PETICION_ACESO **************************//
//*****************************************************************************************************//
    else if(isset($crear_peticion) && $crear_peticion == 1){
        $usuarioDir = $crud->accesoAprobaciones($_SESSION['usuario']);
        $funcionarios = $crud->funcionariosxDepartamento($_SESSION['usuario']);
    }
  

//*****************************************************************************************************//
//**********************************MODIFICACAION DE ESTADO REVISADO***********************************//
//*****************************************************************************************************//   
    else if(isset($_POST['modificarRevisado'])){
        
        $datos->setRevisado(1);
        $datos->setId_peticion($_POST['id_peticion']);
        $accion = $crud->modificarRevisado($datos);
        echo $accion;
    }

//*****************************************************************************************************//
//*********************** SELECCION DE PETICION Y CAMBIO DE ESTADO ************************************//
//*****************************************************************************************************// 
    else if(isset($_POST['preSeleccionar'])){
        $accion  = $crud->getEstado($_POST['id_peticion']);
        echo $accion;

    }
    
    else if(isset($_POST['seleccionar'])){
        date_default_timezone_set('America/Bogota');

        $datos->setId_peticion($_POST['id_peticion']);
        $datos->setFecha_atendido(date("Y-m-d H:i:s"));
        $datos->setUsuario_atendio($_SESSION['usuario']);
        $accion = $crud->modificarEstado($datos);
        if($accion =! 1){
            if($consultaMai == 1){
                header('Location: ../../dashboard.php');
            }else{
                header('Location: ../../dashboard_funcionarios.php');
            }
        }else{
            require('../model/crud_funcionarios.php');
            require('../model/datos_funcionarios.php');

            $crudF= new CrudFuncionarios();
            $datosFuncionario = $crudF->consultarFuncionarioxUsuario($_POST['usuario_creacion']);
            foreach($datosFuncionario as $funcionariodata ){
                $f_fechaRegistro = $funcionariodata->getFechaRegistro();
                $f_correo = $funcionariodata->getF_email();
                $f_identificacion = $funcionariodata->getF_identificacion();
                $f_nombre = $funcionariodata->getF_nombre();
                $f_correo2 = $funcionariodata->getF_email2();
            }

            if(isset($_POST['aprobado']) && $_POST['aprobado'] == 12){
                $plataformasPeticion = $crud->getPlataformasxPeticion($_POST['id_peticion']);
                $accesosPlataformasxUsuario = $crud->accesoPlataformasxUsuario($_POST['usuario_creacion']);
            }
        }

    }

    else if(isset($_POST['liberarPeticion'])){
        $estado = $crud->getEstado($_POST['id_peticion']);
        if($estado == 8){
            $accion = $crud->liberarPeticion($_POST['id_peticion']);
        }else{
            $accion = 2;
        }
        echo $accion;
    }

//*****************************************************************************************************//
//**********************************MODIFICACION DE PETICION (APROBACIONES) ***************************//
//*****************************************************************************************************//
    else if(isset($_POST['guardarAprobaciones'])){
        date_default_timezone_set('America/Bogota');

        if($_POST['aprobado'] == 13){
            $estado = 2;
            $conclusionAprobado = 'Denego';
            $datos->setPlataformas($_POST['plataformasPeticion']);
            $existAcces = 1;
        }else{
            $estado = 1;
            $conclusionAprobado = 'Aprobo';

            $existAcces = 0;
            $plataformas = '';

            for($x=1;$x<numPlataformas;$x++){
                $p = 'plataformas' . $x;
                if(isset($_POST[$p])){
                        $plataformas .= $_POST[$p] . ',';
                        $existAcces = 1;
                }
            }
            $datos->setPlataformas(substr($plataformas, 0, -1));
        }
        $conclusiones = date("Y-m-d H:i:s") . ' / ' . $_SESSION['usuario'] . ' ' . $conclusionAprobado . ' la solicitud' . "\n". $_POST['conclusiones']; 
        $datos->setId_peticion($_POST['id_peticion']);
        $datos->setConclusiones($conclusiones);
        $datos->setEstado_peticion($estado);
        $datos->setAprobado($_POST['aprobado']);
        $datos->setFecha_atendido(date("Y-m-d H:i:s"));
        $datos->setUsuario_atendio($_POST['usuarioAtiende']);
        
        if($existAcces == 1){
            $accion = $crud->modificarPeticion($datos);
        }else{
            $accion = 1;
        }
        

        if($accion == 1){
            if($consultaMai == 1){
                header('Location: ../../dashboard.php');
            }else{
                header('Location: ../../dashboard_funcionarios.php');
            }
        }else if($accion ==2){
            echo 'ERROR ERROR';
        }

    }
    


//*****************************************************************************************************//
//****************** VISUALIZACION DE DATOS SEGUN LA PESTAÑA DONDE SE ENCUENTRE ***********************//
//****************** EN GESTION DE PROCESOS/SOLICITUD DE ACCESOS **************************************//
//*****************************************************************************************************//    
    else if(isset($consultar)){
        if(session_status() == 0 || session_status() == 1){
            session_start();
        }

        $adminPlataforma = $crud->plataformasxUsuario($_SESSION['usuario'],2);
        $cargoAprobar = $crud->accesoAprobaciones($_SESSION['usuario']);

        if($consultaMai == 0){
            switch($consultar){
                case 1: $peticionesAccesosxUsuario = $crud->getPeticionesxUsuario($_SESSION['usuario']);break;
                case 2: 
                    if($cargoAprobar  == 1){
                        $peticionesAccesosxDelegado = $crud->getPeticionesxDelegadoDir($_SESSION['usuario']);
                    }else if($cargoAprobar == 2){
                        $peticionesAccesosxDelegado = $crud->getPeticionesxDelegadoGer($_SESSION['usuario']);
                    };break;
                case 3: $peticionesAccesosxPlataforma = $crud->getPeticionesxPlataformas($_SESSION['usuario']);break;
                case 4: if($cargoAprobar == 1){
                            $peticionesAccesosxUsuario = $crud->getPeticionesxUsuarioDir($_SESSION['usuario']);break;
                        }else{
                            $peticionesAccesosxUsuario = $crud->getPeticionesxUsuario($_SESSION['usuario']);break;
                        }
                default: $peticionesAccesosxUsuario = $crud->getPeticionesxUsuario($_SESSION['usuario']);
            }
        
        }else if($consultaMai == 1){
            switch($consultar){
                case 4: $peticionesAccesosxUsuario = $crud->getPeticionesxUsuarios();break;
                case 2: $peticionesAccesosxDelegado = $crud->getPeticionesxDelegadoMai();break;
                case 3: $peticionesAccesosxPlataforma = $crud->getPeticionesxPlataformasMai();break;
            }

        }

        
    }


//*****************************************************************************************************//
//***************************** ALMACENA LOS RESULTADO DE ACCESOS CREADOS *****************************//
//****************************************Y INACTIVADOS ***********************************************//
//*****************************************************************************************************//
    else if(isset($_POST['guardarInserciones']) && $_POST['tipo'] == 1){
        
        $plataformas = $_POST['plataformasPeticion'];
        $platarformasArreglo = explode (',', $plataformas);

        $datos->setId_peticion($_POST['id_peticion']);
        $datos->setUsuario_creacion($_POST['f_identificacion']);

        for($x=0; $x<$_POST['numeracion']; $x++){
            if($_POST['estado' . $x] != 3){
                $datos->setPlataforma($_POST['plataforma' . $x]);
                $datos->setEstado($_POST['estado' . $x]);

                if($_POST['estado' . $x] == 12){
                    $datos->setNombre($_POST['nombre_usuario' . $x]);
                    $datos->setClave($_POST['clave' . $x]);
                }else if($_POST['estado' . $x] == 13){
                    $datos->setNombre('No aprobado');
                    $datos->setClave('No aprobado');
                }

                
                $crud->insercionDeAccesos($datos);

                $platarformasArreglo = array_diff($platarformasArreglo,array($_POST['plataforma' . $x]));
                $platarformasArreglo = array_values($platarformasArreglo);
            }
            
        }

        $plataformasf ='';
        for($x=0; $x<1000; $x++){
            if(isset($platarformasArreglo[$x])){
                $plataformasf = $plataformasf . $platarformasArreglo[$x] . ","; 
            }
        }

        if($_POST['conclusionesAdd'] != ''){
            $conclusiones = $_POST['conclusiones'] . "\n\n" . $_SESSION['usuario'] . ":" . $_POST['conclusionesAdd'];
        }else{
            $conclusiones = $_POST['conclusiones'];
        }
        $crud->modificarPlataformas(substr($plataformasf, 0, -1),$_POST['id_peticion'],$conclusiones);

        if($consultaMai == 1){
            header('Location: ../../dashboard.php');
        }else{
            header('Location: ../../dashboard_funcionarios.php');
        }

    }



    else if(isset($_POST['guardarInserciones']) && $_POST['tipo'] == 2){

        $plataformas = $_POST['plataformasPeticion'];
        $platarformasArreglo = explode (',', $plataformas);

        $datos->setId_peticion($_POST['id_peticion']);
        $datos->setUsuario_creacion($_POST['f_identificacion']);

        for($x=0; $x<$_POST['numeracion']; $x++){
            if($_POST['estado' . $x] != 3){
                $datos->setPlataforma($_POST['plataforma' . $x]);
                $datos->setEstado($_POST['estado' . $x]);
                $datos->setId_acceso($_POST['accesoPlataforma' . $x]);
                $datos->setNombre($_POST['nombre_usuario' . $x]);

                $crud->inactivacionDeAccesos($datos);

                $platarformasArreglo = array_diff($platarformasArreglo,array($_POST['plataforma' . $x]));
                $platarformasArreglo = array_values($platarformasArreglo);/* ERRO ERRO si tiene mas de una plataforma duplicada no podra dejar en pendiente la solicitud*/
            }
            
        }

        $plataformasf ='';
        for($x=0; $x<1000; $x++){
            if(isset($platarformasArreglo[$x])){
                $plataformasf = $plataformasf . $platarformasArreglo[$x] . ","; 
            }
        }
        if($_POST['conclusionesAdd'] != ''){
            $conclusiones = $_POST['conclusiones'] . "\n\n" . $_SESSION['usuario'] . ":" . $_POST['conclusionesAdd'];
        }else{
            $conclusiones = $_POST['conclusiones'];
        }
        
        $crud->modificarPlataformas(substr($plataformasf, 0, -1),$_POST['id_peticion'],$conclusiones);

        if($consultaMai == 1){
            header('Location: ../../dashboard.php');
        }else{
            header('Location: ../../dashboard_funcionarios.php');
        }
    }

//*****************************************************************************************************//
//********************************** CONSULTA DE PETICIONES *******************************************//
//*****************************************************************************************************//
    else if(isset($_POST['consultarPeticion'])){
        require('../model/crud_funcionarios.php');
        require('../model/datos_funcionarios.php');

        $crudF= new CrudFuncionarios();
        $datosFuncionario = $crudF->consultarFuncionarioxUsuario($_POST['usuario_creacion']);
        foreach($datosFuncionario as $funcionariodata ){
            $f_fechaRegistro = $funcionariodata->getFechaRegistro();
            $f_correo = $funcionariodata->getF_email();
            $f_identificacion = $funcionariodata->getF_identificacion();
        }
        $registroAccesos = $crud->registroAccesosPeticion($_POST['id_peticion']);
 
    }


//*****************************************************************************************************//
//***************************** CONSULTA El TIPO DE USUARIO(SESSION) **********************************//
//*****************************************************************************************************//
    else if(isset($_POST["buscarTipoUsuario"]) && $_POST['buscarTipoUsuario'] == 1){
        echo $consultaMai;
    }


//*****************************************************************************************************//
//***************** CONSULTA El ACCESOS PLATAFORMAS EN  ASIGNACIONES FUNCIONARIO **********************//
//*****************************************************************************************************//
    else if(isset($consultarAccesosPlataformas) && $consultarAccesosPlataformas == 1){
        
        if($consultaMai == 1 || isset($_SESSION['id_roles'])){
            $consultarAccesosPlataformas = $crud->accesoPlataformasxUsuarioTodas($_POST['f_usuario']);
        }else{
            $consultarAccesosPlataformas = $crud->accesoPlataformasxUsuarioTodas($_SESSION['usuario']);
        }
    }


//*****************************************************************************************************//
//***************** CONSULTA El ACCESOS PLATAFORMAS EN  CREAR PETICION ACCESO ************************//
//*****************************************************************************************************//
    else if(isset($_POST['consultarAccesosPlataformas']) && $_POST['consultarAccesosPlataformas'] == 2){
        
        $consultarAccesosPlataformas = $crud->accesoPlataformasxUsuario($_POST['usuario']);

        if($_POST['tipo'] == 1){
            $cadena = '';
            foreach($consultarAccesosPlataformas as $listado){
                $cadena = $cadena . $listado->getPlataformaDescripcion() . "/--/" . $listado->getUsuario() . "/,,/";
            }
            $cadena = substr($cadena,0,-4);
            echo $cadena;
        }else if($_POST['tipo'] == 2){
            $cadena = '';
            foreach($consultarAccesosPlataformas as $listado){
                $cadena = $cadena . $listado->getPlataforma()  . ",";
            }
            $cadena = substr($cadena,0,-1);
            echo $cadena;
        }
        
    }


//*****************************************************************************************************//
//***************** CONSULTA Y MODIFICACION DE CLAVES DE ACCESO A PLATAFORMAS  ************************//
//**************************************** ASIGNACIONES************************************************//
//*****************************************************************************************************//
    else if(isset($_POST['consultarClaveAccesoPlataforma']) && $_POST['consultarClaveAccesoPlataforma'] == 1){

        $clave = $crud->consultarClaveAccesoPlataforma($_POST['id_accesoPlataforma']);
        echo $clave;
    }

    else if(isset($_POST['modificarClaveAccesosPlataforma']) && $_POST['modificarClaveAccesosPlataforma'] ==1){

        $accion = $crud->modificarClaveAccesosPlataforma($_POST['id_accesoPlataforma'],$_POST['clave']);
        echo $accion;
    }


//*****************************************************************************************************//
//***************** CONSULTA DE PLATAFORMAS DE INGRESO(PLATAFORMAS QUE NORMALMENTE) *******************//
//*************************** (SE OTORGAN CUANDO INGRESA UN FUNCIONARIO *******************************//
//*****************************************************************************************************//
    else if(isset($_POST['consultarPlataformasIngreso']) && $_POST['consultarPlataformasIngreso']){
        $plataformasIngreso  = $crud->getPlataformasxCargo($_POST['usuario']);
        echo $plataformasIngreso;
    }

//*****************************************************************************************************//
//******************* CONSULTA  NUMERO DE PETICIONES PENDIENTES PARA DIRECTORES Y  ********************//
//********************************** ADMINISTRADORES DE PLATAFORMAS ***********************************//
//*****************************************************************************************************//
    else if(isset($_POST['consultaNrPeticionesDelegadas']) && $_POST['consultaNrPeticionesDelegadas'] == 1){
        $peticiones  = $crud->getPeticionesxDelegadoDir($_POST['usuario']);
        $pendientes=0;$nuevas=0;$seleccionadas=0;
        foreach($peticiones as $listado){
            $estado  = $listado->getEstado_peticion();
            if($estado == 1){
                $nuevas++;
            }elseif($estado == 3){
                $pendientes++;
            }elseif($estado == 8){
                $seleccionadas++;
            }
        }
        $resultado = $nuevas . ',' . $pendientes . ',' . $seleccionadas;
        echo $resultado;
    }

    else if(isset($_POST['consultaNrPeticionesSoporte']) && $_POST['consultaNrPeticionesSoporte'] == 1){
        $peticiones  = $crud->getPeticionesxPlataformas($_POST['usuario']);
        $pendientes=0;$nuevas=0;$seleccionadas=0;
        foreach($peticiones as $listado){
            $estado  = $listado->getEstado_peticion();
            if($estado == 1){
                $nuevas++;
            }elseif($estado == 3){
                $pendientes++;
            }elseif($estado == 8){
                $seleccionadas++;
            }
        }
        $resultado = $nuevas . ',' . $pendientes . ',' . $seleccionadas;
        echo $resultado;
    }



?>