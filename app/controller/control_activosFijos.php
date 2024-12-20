<?php
    require_once('../model/datos_activosFijos.php');
    require_once("../model/vinculo.php");

    $datos= new activosFijos();

    $rol = $_SESSION['id_roles'];
    if ($rol == 7) {
        $consultarActivo = consultaCompleta();
    }  else if ($rol == 1) {
        $consultarActivo = consultaCompletaPr();
    } else if ($rol == 2) {
        $areaCreacion = 32;
        $consultarActivo = consultaPorRol($areaCreacion);

    } else if ($rol == 1 || $rol == 6 || $rol == 9) {
        $areaCreacion = 27;
        $consultarActivo = consultaPorRol($areaCreacion); 
    }

    function consultaCompleta() {
        try {
        if (isset($_POST['btn-consultarCodigo'])) {
            $code= $_POST['codigoActivo'];
            $sql = "SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, 
grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, 
procesador_activo, licencia_office, licencia_antivirus, hostName, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, 
estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, 
imagen, valor, tipo_activo, vida_util, condicion, sede, centro_de_costos.codigo AS centro_de_costos
FROM activos_internos 
LEFT JOIN estado on id_estado=estado_activo 
LEFT JOIN funcionarios ON identificacion=responsable_activo 
LEFT JOIN grupos_activos ON grupo_activo = id_grupo 
LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area 
LEFT JOIN centro_de_costos ON centro_de_costos.id_centroCostos = activos_internos.centro_de_costos
WHERE codigo_activo LIKE '%".$code."%'";
        } else if (isset($_POST['btn-consultarNombre'])) {
            $names= $_POST['nombreActivo']; 
            $sql = "SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, hostName, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen, valor, tipo_activo, vida_util, condicion, sede FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE nombre_activo LIKE '%".$names."%'";
        } else if (isset($_POST['btn-consultarResponsable'])) {
            $responsable = $_POST['responsable']; 
            $sql = "SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, hostName, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen, valor, tipo_activo, vida_util, condicion, sede FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE funcionarios.nombre LIKE '%".$responsable."%'";
        }
     
            $db=conectar::acceso();
            $consultarActivo=[];
    
            $seleccion=$db->prepare($sql);   
            $seleccion->execute();
        
            foreach ($seleccion->fetchALL() as $listado) {
                            
                $consulta = new activosFijos();
                $consulta->setAf_id($listado['id_activo']);
                $consulta->setAf_codigo($listado['codigo_activo']);
                $consulta->setAf_serial($listado['serial_activo']); 
                $consulta->setAf_nombre($listado['nombre_activo']);
                $consulta->setAf_estado($listado['estado_activo']);
                $consulta->setAf_descripcion_estado($listado['estado']);
                $consulta->setAf_marca($listado['marca_activo']);
                $consulta->setAf_modelo($listado['modelo_activo']);
                $consulta->setAf_fechaCompra($listado['fecha_compra']);
                $consulta->setAf_grupo($listado['grupo_activo']);
                $consulta->setAf_area($listado['area_activo']);
                $consulta->setAf_ubicacion($listado['ubicacion_activo']);
                $consulta->setAf_funcionario($listado['responsable']);
                $consulta->setIdentidad_funcionario($listado['responsable_activo']);
                $consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
                $consulta->setAf_observaciones($listado['observaciones_activo']);
                $consulta->setAf_ram($listado['ram_activo']);
                $consulta->setAf_disco($listado['disco_activo']);
                $consulta->setAf_procesador($listado['procesador_activo']);
                $consulta->setAf_licenciaOffice($listado['licencia_office']);
                $consulta->setAf_licenciaAntivirus($listado['licencia_antivirus']);
                $consulta->sethostName($listado['hostName']);
                $consulta->setAf_dominio($listado['dominio']);
                $consulta->setAf_aplicaciones($listado['aplicaciones_activo']);
                $consulta->setAf_licenciaSO($listado['licencia_sistema']);
                $consulta->setAf_sistemaOperativo($listado['sistema_operativo']);
                $consulta->setAf_areaCreacion($listado['descripcion_areaCreacion']);
                $consulta->setImagenactivo($listado['imagen']);
                $consulta->setcostoCompra($listado['costoCompra']);
                $consulta->settipoAct($listado['tipoAct']);
                $consulta->setvidaUtil($listado['vidaUtil']);
                $consulta->setestadoAct($listado['estadoAct']);
                $consulta->settraCategoria($listado['traCategoria']);
                $consulta->setsede($listado['sede']);
                $consulta->setCentroCostos($listado['centro_de_costos']);
                $consultarActivo[]=$consulta;
            }
            $db =null;
            return $consultarActivo;
            //code...
        } catch (Exception $e) {
            // Manejo de excepciones, puedes registrar el error o mostrar un mensaje al usuario
            echo "Error en consultaCompleta: " . $e->getMessage();
            
        }
    }
    

    function consultaCompletaPr() {
        try {
        if (isset($_POST['btn-consultarCodigo'])) {
            $code= $_POST['codigoActivo'];
            $sql = "SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, hostName, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen, valor, tipo_activo, vida_util, condicion, id_categoria, sede, centro_de_costos.codigo AS centro_de_costos FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area LEFT JOIN centro_de_costos ON centro_de_costos.id_centroCostos = activos_internos.centro_de_costos  WHERE codigo_activo LIKE '%".$code."%'";
        } else if (isset($_POST['btn-consultarNombre'])) {
            $names= $_POST['nombreActivo']; 
            $sql = "SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, hostName, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen, valor, tipo_activo, vida_util, condicion, id_categoria, sede FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE nombre_activo LIKE '%".$names."%'";
        } else if (isset($_POST['btn-consultarResponsable'])) {
            $responsable = $_POST['responsable']; 
            $sql = "SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, hostName, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen, valor, tipo_activo, vida_util, condicion, id_categoria, sede FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE funcionarios.nombre LIKE '%".$responsable."%'";
        }
     
            $db=conectar::acceso();
            $consultarActivo=[];
    
            $seleccion=$db->prepare($sql);   
            $seleccion->execute();
        
            foreach ($seleccion->fetchALL() as $listado) {
                            
                $consulta = new activosFijos();
                $consulta->setAf_id($listado['id_activo']);
                $consulta->setAf_codigo($listado['codigo_activo']);
                $consulta->setAf_serial($listado['serial_activo']); 
                $consulta->setAf_nombre($listado['nombre_activo']);
                $consulta->setAf_estado($listado['estado_activo']);
                $consulta->setAf_descripcion_estado($listado['estado']);
                $consulta->setAf_marca($listado['marca_activo']);
                $consulta->setAf_modelo($listado['modelo_activo']);
                $consulta->setAf_fechaCompra($listado['fecha_compra']);
                $consulta->setAf_grupo($listado['grupo_activo']);
                $consulta->setAf_area($listado['area_activo']);
                $consulta->setAf_ubicacion($listado['ubicacion_activo']);
                $consulta->setAf_funcionario($listado['responsable']);
                $consulta->setIdentidad_funcionario($listado['responsable_activo']);
                $consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
                $consulta->setAf_observaciones($listado['observaciones_activo']);
                $consulta->setAf_ram($listado['ram_activo']);
                $consulta->setAf_disco($listado['disco_activo']);
                $consulta->setAf_procesador($listado['procesador_activo']);
                $consulta->setAf_licenciaOffice($listado['licencia_office']);
                $consulta->setAf_licenciaAntivirus($listado['licencia_antivirus']);
                $consulta->sethostName($listado['hostName']);
                $consulta->setAf_dominio($listado['dominio']);
                $consulta->setAf_aplicaciones($listado['aplicaciones_activo']);
                $consulta->setAf_licenciaSO($listado['licencia_sistema']);
                $consulta->setAf_sistemaOperativo($listado['sistema_operativo']);
                $consulta->setAf_areaCreacion($listado['descripcion_areaCreacion']);
                $consulta->setImagenactivo($listado['imagen']);
                $consulta->setcostoCompra($listado['valor']);
                $consulta->settipoAct($listado['tipo_activo']);
                $consulta->setvidaUtil($listado['vida_util']);
                $consulta->setestadoAct($listado['condicion']);
                $consulta->settraCategoria($listado['id_categoria']);
                $consulta->setsede($listado['sede']);
                $consulta->setCentroCostos($listado['centro_de_costos']);
                $consultarActivo[]=$consulta;
            }
            $db =null;
            return $consultarActivo;
            //code...
        } catch (Exception $e) {
            // Manejo de excepciones, puedes registrar el error o mostrar un mensaje al usuario
            echo "Error en consultaCompleta: " . $e->getMessage();
            return []; // Retorna un arreglo vacío en caso de error
        }
    }


    function consultaPorRol($area_grupo) {
        if (isset($_POST['btn-consultarCodigo'])) {
     
            $code= $_POST['codigoActivo'];      
            $db=conectar::acceso();
            $consultarActivo=[];
    
            $seleccion=$db->prepare("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE codigo_activo LIKE '%".$code."%' && grupos_activos.area_grupo = :area_grupo");   
            $seleccion->bindValue('area_grupo',$area_grupo);
            $seleccion->execute();
        
            foreach ($seleccion->fetchALL() as $listado) {
                            
                $consulta = new activosFijos();
                $consulta->setAf_id($listado['id_activo']);
                $consulta->setAf_codigo($listado['codigo_activo']);
                $consulta->setAf_serial($listado['serial_activo']); 
                $consulta->setAf_nombre($listado['nombre_activo']);
                $consulta->setAf_estado($listado['estado_activo']);
                $consulta->setAf_descripcion_estado($listado['estado']);
                $consulta->setAf_marca($listado['marca_activo']);
                $consulta->setAf_modelo($listado['modelo_activo']);
                $consulta->setAf_fechaCompra($listado['fecha_compra']);
                $consulta->setAf_grupo($listado['grupo_activo']);
                $consulta->setAf_area($listado['area_activo']);
                $consulta->setAf_ubicacion($listado['ubicacion_activo']);
                $consulta->setAf_funcionario($listado['responsable']);
                $consulta->setIdentidad_funcionario($listado['responsable_activo']);
                $consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
                $consulta->setAf_observaciones($listado['observaciones_activo']);
                $consulta->setAf_ram($listado['ram_activo']);
                $consulta->setAf_disco($listado['disco_activo']);
                $consulta->setAf_procesador($listado['procesador_activo']);
                $consulta->setAf_licenciaOffice($listado['licencia_office']);
                $consulta->setAf_licenciaAntivirus($listado['licencia_antivirus']);
                $consulta->setAf_dominio($listado['dominio']);
                $consulta->setAf_aplicaciones($listado['aplicaciones_activo']);
                $consulta->setAf_licenciaSO($listado['licencia_sistema']);
                $consulta->setAf_sistemaOperativo($listado['sistema_operativo']);
                $consulta->setAf_areaCreacion($listado['descripcion_areaCreacion']);
                $consulta->setImagenactivo($listado['imagen']);
                $consultarActivo[]=$consulta;
            }
            return $consultarActivo;
    
        }else if(isset($_POST['btn-consultarNombre'])){
    
            $names= $_POST['nombreActivo'];      
            $db=conectar::acceso();
            $consultarActivo=[];
    
            $seleccion=$db->prepare("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable ,estado.descripcion AS estado, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE nombre_activo LIKE '%".$names."%' && grupos_activos.area_grupo = :area_grupo");   
            $seleccion->bindValue('area_grupo',$area_grupo);
            $seleccion->execute();
        
            foreach ($seleccion->fetchALL() as $listado) {
                            
                $consulta = new activosFijos();
                $consulta->setAf_id($listado['id_activo']);
                $consulta->setAf_codigo($listado['codigo_activo']);
                $consulta->setAf_serial($listado['serial_activo']);
                $consulta->setAf_nombre($listado['nombre_activo']);
                $consulta->setAf_estado($listado['estado_activo']);
                $consulta->setAf_descripcion_estado($listado['estado']);
                $consulta->setAf_marca($listado['marca_activo']);
                $consulta->setAf_modelo($listado['modelo_activo']);
                $consulta->setAf_fechaCompra($listado['fecha_compra']);
                $consulta->setAf_grupo($listado['grupo_activo']);
                $consulta->setAf_area($listado['area_activo']);
                $consulta->setAf_ubicacion($listado['ubicacion_activo']);
                $consulta->setAf_funcionario($listado['responsable']);
                $consulta->setIdentidad_funcionario($listado['responsable_activo']);
                $consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
                $consulta->setAf_observaciones($listado['observaciones_activo']);
                $consulta->setAf_ram($listado['ram_activo']);
                $consulta->setAf_disco($listado['disco_activo']);
                $consulta->setAf_procesador($listado['procesador_activo']);
                $consulta->setAf_licenciaOffice($listado['licencia_office']);
                $consulta->setAf_licenciaAntivirus($listado['licencia_antivirus']);
                $consulta->setAf_dominio($listado['dominio']);
                $consulta->setAf_aplicaciones($listado['aplicaciones_activo']);
                $consulta->setAf_licenciaSO($listado['licencia_sistema']);
                $consulta->setAf_sistemaOperativo($listado['sistema_operativo']);
                $consulta->setAf_areaCreacion($listado['descripcion_areaCreacion']);
                $consulta->setImagenactivo($listado['imagen']);
                $consultarActivo[]=$consulta;
            }
            return $consultarActivo;                
           
        } else if(isset($_POST['btn-consultarResponsable'])){
    
            $responsable = $_POST['responsable'];      
            $db=conectar::acceso();
            $consultarActivo=[];
    
            $seleccion=$db->prepare("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, ubicacion_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable,estado.descripcion AS estado, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion, imagen FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area  WHERE funcionarios.nombre LIKE '%".$responsable."%' && grupos_activos.area_grupo = :area_grupo");   
            $seleccion->bindValue('area_grupo',$area_grupo);
            $seleccion->execute();
        
            foreach ($seleccion->fetchALL() as $listado) {
                            
                $consulta = new activosFijos();
                $consulta->setAf_id($listado['id_activo']);
                $consulta->setAf_codigo($listado['codigo_activo']);
                $consulta->setAf_serial($listado['serial_activo']);
                $consulta->setAf_nombre($listado['nombre_activo']);
                $consulta->setAf_estado($listado['estado_activo']);
                $consulta->setAf_descripcion_estado($listado['estado']);
                $consulta->setAf_marca($listado['marca_activo']);
                $consulta->setAf_modelo($listado['modelo_activo']);
                $consulta->setAf_fechaCompra($listado['fecha_compra']);
                $consulta->setAf_grupo($listado['grupo_activo']);
                $consulta->setAf_area($listado['area_activo']);
                $consulta->setAf_ubicacion($listado['ubicacion_activo']);
                $consulta->setAf_funcionario($listado['responsable']);
                $consulta->setIdentidad_funcionario($listado['responsable_activo']);
                $consulta->setAf_fechaAsignacion($listado['fecha_asignacion']);
                $consulta->setAf_observaciones($listado['observaciones_activo']);
                $consulta->setAf_ram($listado['ram_activo']);
                $consulta->setAf_disco($listado['disco_activo']);
                $consulta->setAf_procesador($listado['procesador_activo']);
                $consulta->setAf_licenciaOffice($listado['licencia_office']);
                $consulta->setAf_licenciaAntivirus($listado['licencia_antivirus']);
                $consulta->setAf_dominio($listado['dominio']);
                $consulta->setAf_aplicaciones($listado['aplicaciones_activo']);
                $consulta->setAf_licenciaSO($listado['licencia_sistema']);
                $consulta->setAf_sistemaOperativo($listado['sistema_operativo']);
                $consulta->setAf_areaCreacion($listado['descripcion_areaCreacion']);
                $consulta->setImagenactivo($listado['imagen']);
                $consultarActivo[]=$consulta;
            }
            return $consultarActivo;      
        }
    }

    
       
?>