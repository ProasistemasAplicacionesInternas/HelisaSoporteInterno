<?php
    require_once('../model/datos_activosFijos.php');
    require_once("../model/vinculo.php");
    
    $datos= new activosFijos();
 
    if(isset($_POST['btn-consultarCodigo'])){
     
        $code= $_POST['codigoActivo'];      
        $db=conectar::acceso();
        $consultarActivo=[];

        $seleccion=$db->prepare("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area WHERE codigo_activo LIKE '%".$code."%'");   
        $seleccion->execute();
    
        foreach ($seleccion->fetchALL() as $listado) {
						
            $consulta = new activosFijos();
            $consulta->setAf_id($listado['id_activo']);
            $consulta->setAf_codigo($listado['codigo_activo']);
            $consulta->setAf_serial($listado['serial_activo']);
            $consulta->setAf_nombre($listado['nombre_activo']);
            $consulta->setAf_estado($listado['estado']);
            $consulta->setAf_marca($listado['marca_activo']);
            $consulta->setAf_modelo($listado['modelo_activo']);
            $consulta->setAf_fechaCompra($listado['fecha_compra']);
            $consulta->setAf_grupo($listado['grupo_activo']);
            $consulta->setAf_area($listado['area_activo']);
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
            $consultarActivo[]=$consulta;
        }

    }else if(isset($_POST['btn-consultarNombre'])){

        $names= $_POST['nombreActivo'];      
        $db=conectar::acceso();
        $consultarActivo=[];

        $seleccion=$db->prepare("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area WHERE nombre_activo LIKE '%".$names."%'");   
        $seleccion->execute();
    
        foreach ($seleccion->fetchALL() as $listado) {
						
            $consulta = new activosFijos();
            $consulta->setAf_id($listado['id_activo']);
            $consulta->setAf_codigo($listado['codigo_activo']);
            $consulta->setAf_serial($listado['serial_activo']);
            $consulta->setAf_nombre($listado['nombre_activo']);
            $consulta->setAf_estado($listado['estado']);
            $consulta->setAf_marca($listado['marca_activo']);
            $consulta->setAf_modelo($listado['modelo_activo']);
            $consulta->setAf_fechaCompra($listado['fecha_compra']);
            $consulta->setAf_grupo($listado['grupo_activo']);
            $consulta->setAf_area($listado['area_activo']);
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
            $consultarActivo[]=$consulta;
        }                
       
    } else if(isset($_POST['btn-consultarResponsable'])){

        $responsable = $_POST['responsable'];      
        $db=conectar::acceso();
        $consultarActivo=[];

        $seleccion=$db->prepare("SELECT id_activo, codigo_activo, serial_activo, nombre_activo, estado_activo, marca_activo, modelo_activo, fecha_compra, grupo_activo, area_activo, responsable_activo, fecha_asignacion, observaciones_activo, ram_activo, disco_activo, procesador_activo, licencia_office, licencia_antivirus, aplicaciones_activo, licencia_sistema, dominio, sistema_operativo, estado.descripcion AS estado, funcionarios.nombre AS responsable, grupos_activos.area_grupo, areas.descripcion AS descripcion_areaCreacion  FROM activos_internos LEFT JOIN estado on id_estado=estado_activo LEFT JOIN funcionarios ON identificacion=responsable_activo LEFT JOIN grupos_activos ON grupo_activo = id_grupo LEFT JOIN areas ON grupos_activos.area_grupo = areas.id_area WHERE funcionarios.nombre LIKE '%".$responsable."%'");   
        $seleccion->execute();
    
        foreach ($seleccion->fetchALL() as $listado) {
						
            $consulta = new activosFijos();
            $consulta->setAf_id($listado['id_activo']);
            $consulta->setAf_codigo($listado['codigo_activo']);
            $consulta->setAf_serial($listado['serial_activo']);
            $consulta->setAf_nombre($listado['nombre_activo']);
            $consulta->setAf_estado($listado['estado']);
            $consulta->setAf_marca($listado['marca_activo']);
            $consulta->setAf_modelo($listado['modelo_activo']);
            $consulta->setAf_fechaCompra($listado['fecha_compra']);
            $consulta->setAf_grupo($listado['grupo_activo']);
            $consulta->setAf_area($listado['area_activo']);
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
            $consultarActivo[]=$consulta;
        }      
    }
       
?>