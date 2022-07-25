<?php 
require_once('../model/vinculo.php');

class Crudcargos{
	
	

	public function mostrarCargos(){

				$db=conectar::acceso();
				$cargos=[];

				$consultar_cargos=$db->query('SELECT  id_cargo,cargos.descripcion, cargos.estado FROM cargos LEFT JOIN areas ON cargos.id_area = areas.id_area LEFT JOIN departamentos_internos ON areas.id_departamento = departamentos_internos.id_departamento WHERE  cargos.estado = 5 && areas.estado = 5 && departamentos_internos.estado = 5 ORDER BY descripcion ');

				while ($listado_cargos=$consultar_cargos->fetch(PDO::FETCH_ASSOC)) {
						$cargos[]=$listado_cargos;	
				}
				return $cargos;
	}

	public function getCargos(){
		$db=conectar::acceso();
		$cargos=[];

		$consultar_cargos=$db->query('SELECT  id_cargo, auxiliarDp,cargos.descripcion,cargos.estado,areas.descripcion AS area, areas.estado AS estado_area, departamentos_internos.descripcion AS departamento, departamentos_internos.estado AS estado_departamento, cargos.id_area, (select COUNT(*) FROM funcionarios WHERE funcionarios.cargo = cargos.id_cargo && festado = 5) AS personasxCargo FROM cargos LEFT JOIN areas ON areas.id_area = cargos.id_area LEFT JOIN departamentos_internos ON departamentos_internos.id_departamento = areas.id_departamento ORDER BY cargos.descripcion');
		
		while ($listado_cargos=$consultar_cargos->fetch(PDO::FETCH_ASSOC)) {
				$cargos[]=$listado_cargos;	
		}
		return $cargos;
	}

	public function getCargoxID($id_cargo){
		$db=conectar::acceso();
		$cargo=[];

		$consultar_cargos=$db->prepare('SELECT  id_cargo,cargos.descripcion,cargos.estado,cargos.id_area, departamentos_internos.id_departamento, (select COUNT(*) FROM funcionarios WHERE funcionarios.cargo = cargos.id_cargo && festado = 5) AS personasxCargo, plataformas FROM cargos LEFT JOIN areas ON areas.id_area = cargos.id_area LEFT JOIN departamentos_internos ON departamentos_internos.id_departamento = areas.id_departamento WHERE id_cargo = :id_cargo');
		$consultar_cargos->bindValue("id_cargo",$id_cargo);
		$consultar_cargos->execute();
		
		while ($listado_cargos=$consultar_cargos->fetch(PDO::FETCH_ASSOC)) {
				$cargo[]=$listado_cargos;	
		}
		return $cargo;
	}

	public function modificarCargo($id,$descripcion,$estado,$area,$auxiliarDp,$plataformas){
		$db=Conectar::acceso();

		$consulta1=$db->prepare("SELECT id_cargo FROM cargos WHERE descripcion = :descripcion && id_cargo != :id_cargo");
		$consulta1->bindValue('descripcion',$descripcion);
		$consulta1->bindValue('id_cargo',$id);
		$consulta1->execute();
		
		if($consulta1){
			$numeroDeConsidencias = $consulta1->rowCount();

			if($numeroDeConsidencias >= 1){
				$db=null;
				return 2;
			}else{
				$consulta=$db->prepare("UPDATE cargos SET descripcion = :descripcion, estado =:estado , id_area =:area , auxiliarDp = :auxiliarDp, plataformas = :plataformas WHERE id_cargo = :id_cargo");
				$consulta->bindValue('descripcion',$descripcion);
				$consulta->bindValue('estado',$estado);
				$consulta->bindValue('area',$area);
				$consulta->bindValue('id_cargo',$id);
				$consulta->bindValue('auxiliarDp',$auxiliarDp);
				$consulta->bindValue('plataformas',substr($plataformas,0,-1));
				$consulta->execute();

				$db=null;

				if($consulta){
					return 1;
				}else{
					return 0;
				}
			}
		}else{
			$db=null;
			return 0;
		}
	}

	public function crearCargo($descripcion,$area){
		$db=Conectar::acceso();
		$consulta=$db->prepare("SELECT id_cargo FROM cargos WHERE descripcion = :descripcion");
		$consulta->bindValue('descripcion',$descripcion);
		$consulta->execute();
		
		if($consulta){
			$numeroDeConsidencias = $consulta->rowCount();

			if($numeroDeConsidencias >= 1){
				$db=null;
				return 2;
			}else{
				$insertar=$db->prepare("INSERT INTO  cargos(descripcion,estado,id_area) VALUES(:descripcion,5,:area)");
				$insertar->bindValue('descripcion',$descripcion);
				$insertar->bindValue('area',$area);
				$insertar->execute();

				if($insertar){
					$db=null;
					return 1;
				}else{
					$db=null;
					return 0;
				}
			}
		}else{
			$db=null;
			return 0;
		}
		
	}


	public function getCargosxArea($id_area){
		$db=conectar::acceso();
		$cargos=[];

		$consultar_cargos=$db->query("SELECT  id_cargo, auxiliarDp,cargos.descripcion,cargos.estado,areas.descripcion AS area, departamentos_internos.descripcion AS departamento, cargos.id_area, (select COUNT(*) FROM funcionarios WHERE funcionarios.cargo = cargos.id_cargo && festado = 5) AS personasxCargo FROM cargos LEFT JOIN areas ON areas.id_area = cargos.id_area LEFT JOIN departamentos_internos ON departamentos_internos.id_departamento = areas.id_departamento WHERE areas.id_area = $id_area");
		
		while ($listado_cargos=$consultar_cargos->fetch(PDO::FETCH_ASSOC)) {
				$cargos[]=$listado_cargos;	
		}
		return $cargos;
	}




}
?>