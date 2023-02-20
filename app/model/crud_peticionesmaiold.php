<?php 
require_once('../model/vinculo.php');
require __DIR__ . '/vendor/autoload.php';
  
class CrudPeticionesMai{

//********************************************************************************//
//***********SQL PARA LA CREACION DE UNA PETICION DE FUNCIONARIO******************//
//********************************************************************************//

	public function crearPeticionesMai($create){
		$db=Conectar::acceso();
		$crea_peticionMai=$db->prepare('INSERT INTO peticiones_mai(descripcion_peticion, usuario_creacion, fecha_peticion, estado_peticion, producto_mai, imagen, imagen2, imagen3)VALUES(:descripcion_peticion, :usuario_creacion, :fecha_peticion, :estado_peticion, :producto_mai, :imagen, :imagen2, :imagen3)');

			$crea_peticionMai->bindValue('descripcion_peticion',$create->getDescripcion_peticionMai());
			$crea_peticionMai->bindValue('usuario_creacion',$create->getUsuario_creacionMai());
            $crea_peticionMai->bindValue('fecha_peticion',$create->getFecha_peticionMai());
			$crea_peticionMai->bindValue('estado_peticion',$create->getEstado_peticionMai());
			$crea_peticionMai->bindValue('producto_mai',$create->getProducto_peticionMai());
			$crea_peticionMai->bindValue('imagen',$create->getImagen_peticionMai());
            $crea_peticionMai->bindValue('imagen2',$create->getImagen_peticionMai2());
            $crea_peticionMai->bindValue('imagen3',$create->getImagen_peticionMai3());
			$crea_peticionMai->execute();

						  $colsultar_usuario=$db->prepare('SELECT identificacion from funcionarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $create->getUsuario_creacionMai());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_funcionario=$filtro['identificacion'];
                           $funcion_realizada = "El funcionario Realizo una peticion al area de Mantenimiento de aplicaciones internas para el Producto ".$create->getProducto_peticionMai();
                           $inserta_funcion=$db->prepare("INSERT INTO funciones_funcionarios (codigo, id_funcionario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_funcionario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_funcionario',$id_funcionario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();
	}
    
    
    public function consultarPeticionesMai(){
			$db=conectar::acceso();
			$lista_peticiones=[];
			$consultar_peticion=$db->prepare('SELECT  id_peticionmai, descripcion_peticion, usuario_creacion, fecha_peticion, estado.descripcion AS estado_peticion, productos_mai.nombre_producto AS producto_mai, imagen,  fecha_atencion, usuario_atencion, conclusiones, funcionarios.extension, funcionarios.area,funcionarios.mail, imagen2, imagen3 
            FROM peticiones_mai 
            LEFT JOIN funcionarios ON funcionarios.usuario=peticiones_mai.usuario_creacion 
            LEFT JOIN areas ON areas.id_area=funcionarios.area 
            LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion 
            WHERE estado_peticion=:estadoU OR estado_peticion=:estadoT');
				$consultar_peticion->bindValue('estadoU','1');
				$consultar_peticion->bindValue('estadoT','3');		
				$consultar_peticion->execute();
			foreach ($consultar_peticion->fetchAll() as $listado) {
				$consulta = new PeticionMai();
				$consulta->setId_peticionMai($listado['id_peticionmai']);
				$consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);	
				$consulta->setUsuario_creacionMai($listado['usuario_creacion']);	
                $consulta->setFecha_peticionMai($listado['fecha_peticion']);
				$consulta->setEstado_peticionMai($listado['estado_peticion']);	
				$consulta->setProducto_peticionMai($listado['producto_mai']);
				$consulta->setImagen_peticionMai($listado['imagen']);
                $consulta->setImagen_peticionMai2($listado['imagen2']);
                $consulta->setImagen_peticionMai3($listado['imagen3']);
				$consulta->setFecha_atendidoMai($listado['fecha_atencion']);	
				$consulta->setUsuario_atencionMai($listado['usuario_atencion']);	
				$consulta->setConclusiones_peticionMai($listado['conclusiones']);
				$consulta->setExtension_funcionario($listado['extension']);
				$consulta->setArea_funcionario($listado['area']);
				$consulta->setEmail_funcionario($listado['mail']);
				
				$lista_peticiones[]=$consulta;	
			}
			return $lista_peticiones;
		}
    
    public function cambiaEstadoMai($state){
            
            $db=conectar::acceso();
            
            $actualiza_estado=$db->prepare("UPDATE peticiones_mai SET estado_peticion=:estado, fecha_atencion=:fecha_atendido, usuario_atencion=:usuario_atiende WHERE id_peticionmai=:numero_peticion");
            $actualiza_estado->bindValue('numero_peticion',$state->getId_peticionMai());
            $actualiza_estado->bindValue('estado',$state->getEstado_peticionMai());
            $actualiza_estado->bindValue('fecha_atendido',$state->getFecha_atendidoMai());
            $actualiza_estado->bindValue('usuario_atiende',$state->getUsuario_atencionMai());
            $actualiza_estado->execute();

            $colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $state->getUsuario_atencionMai());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_usuario=$filtro['id_usuario'];
                           $funcion_realizada = "El usuario cambio el estado del  ticket de aplicaciones internas numero: ".$state->getId_peticionMai()."a estado: ". $state->getEstado_peticionMai();
                           $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_usuario',$id_usuario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();
        }
    
    public function redireccionarPeticionesMai($redirect){
        $db=conectar::acceso();
        $redirecciona_solicitud=$db->prepare('INSERT INTO peticiones(fecha_peticion, usuario, estado, categoria, descripcion, imagen, conclusiones, imagen2, imagen3)VALUES(:fecha_peticion, :usuario, :estado, :categoria, :descripcion, :imagen, :conclusiones, :imagen2, :imagen3)');
        date_default_timezone_set('America/Bogota');
        
        $redirecciona_solicitud->bindValue('fecha_peticion',$redirect->getFecha_peticionMai());
        $redirecciona_solicitud->bindValue('usuario',$redirect->getUsuario_creacionMai());
        $redirecciona_solicitud->bindValue('estado',1);
        $redirecciona_solicitud->bindValue('categoria',22);
        $redirecciona_solicitud->bindValue('descripcion',$redirect->getDescripcion_peticionMai());
        $redirecciona_solicitud->bindValue('imagen',$redirect->getImagen_peticionMai());
        $redirecciona_solicitud->bindValue('imagen2',$redirect->getImagen_peticionMai2());
        $redirecciona_solicitud->bindValue('imagen3',$redirect->getImagen_peticionMai3());
        $redirecciona_solicitud->bindValue('conclusiones',$redirect->getConclusiones_peticionMai());
        $redirecciona_solicitud->execute();
        if($redirecciona_solicitud){
            $registro=$db->lastInsertId();
            echo $registro;
            $db=conectar::acceso();
            $finaliza_solicitudmai=$db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, cod_redireccionado=:cod_redireccionado, estado_peticion=:estado_peticion WHERE id_peticionmai=:cod_peticion');
            $finaliza_solicitudmai->bindValue('cod_peticion',$redirect->getId_peticionMai());
            $finaliza_solicitudmai->bindValue('fecha_atencion',$redirect->getFecha_atendidoMai());
            $finaliza_solicitudmai->bindValue('usuario_atencion',$redirect->getUsuario_atencionMai());
            $finaliza_solicitudmai->bindValue('conclusiones',$redirect->getConclusiones_peticionMai());
            $finaliza_solicitudmai->bindValue('cod_redireccionado',$registro);
            $finaliza_solicitudmai->bindValue('estado_peticion',$redirect->getEstado_peticionMai());
            $finaliza_solicitudmai->execute();
        }
    }
    
    public function modificarPeticionesMai($update){
        $db=conectar::acceso();
            $finaliza_solicitudmai=$db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, conclusiones=:conclusiones, estado_peticion=:estado_peticion WHERE id_peticionmai=:cod_peticion');
            $finaliza_solicitudmai->bindValue('cod_peticion',$update->getId_peticionMai());
            $finaliza_solicitudmai->bindValue('fecha_atencion',$update->getFecha_atendidoMai());
            $finaliza_solicitudmai->bindValue('usuario_atencion',$update->getUsuario_atencionMai());
            $finaliza_solicitudmai->bindValue('conclusiones',$update->getConclusiones_peticionMai());
            $finaliza_solicitudmai->bindValue('estado_peticion',$update->getEstado_peticionMai());
            $finaliza_solicitudmai->execute();
    }
    
    public function solicitudesEnProceso(){
        $db=conectar::acceso();
			$lista_peticionesMai=[];
			$consultar_peticionMai=$db->prepare('SELECT id_peticionmai, fecha_peticion, estado.descripcion AS estado_peticion, productos_mai.nombre_producto AS producto_mai, fecha_atencion, usuario_atencion FROM peticiones_mai LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai WHERE estado_peticion=:estadoSeleccionado');
				$consultar_peticionMai->bindValue('estadoSeleccionado','8');
				$consultar_peticionMai->execute();

			foreach ($consultar_peticionMai->fetchAll() as $listado) {
				$consulta = new PeticionMai();
				$consulta->setId_peticionMai($listado['id_peticionmai']);
				$consulta->setFecha_peticionMai($listado['fecha_peticion']);	
				$consulta->setEstado_peticionMai($listado['estado_peticion']);	
                $consulta->setProducto_peticionMai($listado['producto_mai']);
				$consulta->setFecha_atendidoMai($listado['fecha_atencion']);	
				$consulta->setUsuario_atencionMai($listado['usuario_atencion']);
				$lista_peticionesMai[]=$consulta;	
			}
			return $lista_peticionesMai;
    }
    
    public function liberarSolicitudMai($liberty){
        $db=conectar::acceso();
        $liberando=$db->prepare('UPDATE peticiones_mai SET fecha_atencion=:fecha_atencion, usuario_atencion=:usuario_atencion, estado_peticion=:estado_peticion WHERE id_peticionmai=:cod_peticion ');
        date_default_timezone_set('America/Bogota');
        $liberando->bindValue('fecha_atencion',date("Y-m-d H:i:s"));
        $liberando->bindValue('usuario_atencion',$_SESSION['usuario']);
        $liberando->bindValue('estado_peticion',3);
        $liberando->bindValue('cod_peticion',$liberty->getId_peticionMai());
        $liberando->execute();
        if($liberando){
            echo 1;
        }
    }
    
    public function coloresR($dias,$hora){
        if($dias>0 || $hora>=8){
            return '#dd9933';
        }else{
            return '#ffffff';
        }
    }
    
    public function consultarPeticionesMaixFuncionario(){
			$db=conectar::acceso();
			$lista_peticiones=[];
			$consultar_peticion=$db->prepare('SELECT id_peticionmai, productos_mai.nombre_producto AS producto_mai, fecha_peticion, descripcion_peticion, estado.descripcion AS estado_peticion, fecha_atencion, usuario_atencion, conclusiones, revisado 
            FROM peticiones_mai 
            LEFT JOIN productos_mai ON productos_mai.id_producto=peticiones_mai.producto_mai 
            LEFT JOIN estado ON estado.id_estado=peticiones_mai.estado_peticion 
            WHERE usuario_creacion=:funcionario AND revisado=:noRevisado');
            $consultar_peticion->bindValue('noRevisado',1);
			$consultar_peticion->bindValue('funcionario',$_SESSION['usuario']);
			$consultar_peticion->execute();
			foreach ($consultar_peticion->fetchAll() as $listado) {
				$consulta = new PeticionMai();
				$consulta->setId_peticionMai($listado['id_peticionmai']);
				$consulta->setProducto_peticionMai($listado['producto_mai']);
				$consulta->setFecha_peticionMai($listado['fecha_peticion']);	
				$consulta->setDescripcion_peticionMai($listado['descripcion_peticion']);
				$consulta->setEstado_peticionMai($listado['estado_peticion']);	
				$consulta->setFecha_atendidoMai($listado['fecha_atencion']);
				$consulta->setUsuario_atencionMai($listado['usuario_atencion']);	
				$consulta->setConclusiones_peticionMai($listado['conclusiones']);	
				$consulta->setMarca_revisado($listado['revisado']);
				$lista_peticiones[]=$consulta;	
			}
			return $lista_peticiones;
		}
    
    public function marcarRevisado($marcar){
        $db=conectar::acceso();
        $liberando=$db->prepare('UPDATE peticiones_mai SET revisado=:revisado WHERE id_peticionmai=:cod_peticion');
        $liberando->bindValue('revisado',2);
        $liberando->bindValue('cod_peticion',$marcar->getId_peticionMai());
        $liberando->execute();
        if($liberando){
            echo 1;
        }else{
            echo 2;
        }
    }
}