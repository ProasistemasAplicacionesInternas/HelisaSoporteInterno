<?php 
require_once('../model/vinculo.php');

class CrudTraslados{
	
//***************************************************************************************//
//******************************* SQL PARA CREAR traslado *******************************//
//***************************************************************************************//

		public function crearTraslado($create){
			$db=Conectar::acceso();
			$residuo = $create->getFuncionario_final();			

			$crea_traslado=$db->prepare('INSERT INTO traslados(funcionario_inicial, fecha_asignado, funcionario_final, fecha_traslado, activo_traslado, descripcion_traslado )VALUES(:t_funcionarioI, :t_fechaA, :t_funcionarioF, :t_fechaT, :t_activo, :t_descripcion)');

			$crea_traslado->bindValue('t_funcionarioI',$create->getFuncionario_inicial());
			$crea_traslado->bindValue('t_fechaA',$create->getFecha_inicial());
			$crea_traslado->bindValue('t_funcionarioF',$create->getFuncionario_final());
            $crea_traslado->bindValue('t_fechaT',$create->getFecha_traslado());
            $crea_traslado->bindValue('t_activo',$create->getActivo_traslado());
			$crea_traslado->bindValue('t_descripcion',$create->getDescripcion_traslado());            
			$crea_traslado->execute();

			if ($crea_traslado) {

				if($residuo == '071101005')
					$estados = 11;	
				else 
				    $estados = 14;			   		

				$modifica_responsable=$db->prepare('UPDATE activos_internos SET responsable_activo=:responsable, fecha_asignacion=:fecha_traslado, estado_activo=:estadoA WHERE id_activo=:t_activo');
				$modifica_responsable->bindValue('t_activo',$create->getActivo_traslado());
				$modifica_responsable->bindValue('responsable',$create->getFuncionario_final());
				$modifica_responsable->bindValue('fecha_traslado',$create->getFecha_traslado());
				$modifica_responsable->bindValue('estadoA',$estados);
				
				$modifica_responsable->execute();

				$colsultar_usuario=$db->prepare('SELECT id_usuario from usuarios where usuario =:usuario');
                          $colsultar_usuario->bindValue('usuario', $create->getNombre());
                          $colsultar_usuario->execute();
                          $filtro=$colsultar_usuario->fetch(PDO::FETCH_ASSOC);
                          $id_usuario=$filtro['id_usuario'];
                           $funcion_realizada = "El usuario realizo un traslado de un activo, el activo : ".$create->getActivo_traslado()." se traslado a : ".$residuo;
                           $inserta_funcion=$db->prepare("INSERT INTO funciones (codigo, id_usuario, fecha_registro, funcion_realizada,IP) VALUES (0, :id_usuario , curdate() , :funcion_realizada ,:ip )");
                           $inserta_funcion->bindValue('id_usuario',$id_usuario);
                           $inserta_funcion->bindValue('funcion_realizada',$funcion_realizada);
                           $inserta_funcion->bindValue('ip', $_SERVER['REMOTE_ADDR']);                 
                           $inserta_funcion->execute();
			}
		}



//****************************************************************************************//
//**************************** SQL PARA CONSULTAR trasladoS ******************************//
//****************************************************************************************//

		public function consultarTraslados(){
			$db=conectar::acceso();
			$lista_traslados=[];
			$consultar_traslado=$db->query('SELECT id_traslado, funcionario_inicial, fecha_asignado, funcionario_final, fecha_traslado, activo_traslado');

			foreach ($consultar_traslado->fetchAll() as $listado) {
				$consulta = new traslado();
				$consulta->setId_traslado($listado['id_traslado']);
				$consulta->setFuncionario_inicial($listado['funcionario_inicial']);	
				$consulta->setFecha_inicial($listado['fecha_asignado']);	
                $consulta->setFuncionario_final($listado['funcionario_final']);
				$consulta->setFecha_traslado($listado['fecha_traslado']);	
				$consulta->setActivo_traslado($listado['activo_traslado']);	
				
				$lista_traslados[]=$consulta;	
			}
			return $lista_traslados;
		}
}

 ?>