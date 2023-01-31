<?php 
require_once('../model/vinculo.php');

class Crudareas{
	
	

	public function mostrarAreas(){

			$db=conectar::acceso();
			$areas=[];

			$consultar_areas=$db->query('SELECT  id_area,areas.descripcion, areas.estado FROM areas LEFT JOIN departamentos_internos ON areas.id_departamento = departamentos_internos.id_departamento WHERE departamentos_internos.estado = 5 && areas.estado = 5 ORDER BY descripcion ');

				while ($listado_areas=$consultar_areas->fetch(PDO::FETCH_ASSOC)) {
						$areas[]=$listado_areas;	
				}
				return $areas;
	}

	public function getAreas(){
		$db=conectar::acceso();
		$areas=[];

		$consultar_areas=$db->query('SELECT  id_area,areas.descripcion,areas.estado,departamentos_internos.descripcion AS departamento, departamentos_internos.estado AS estado_departamento, areas.id_departamento, (SELECT COUNT(*) from funcionarios left join cargos ON cargos.id_cargo = cargo left join areas areaB on cargos.id_area = areaB.id_area where areaB.id_area = areas.id_area && festado = 5) AS personasxArea FROM areas LEFT JOIN departamentos_internos ON departamentos_internos.id_departamento = areas.id_departamento ORDER BY areas.descripcion ASC');
		
		while ($listado_areas=$consultar_areas->fetch(PDO::FETCH_ASSOC)) {
				$areas[]=$listado_areas;	
		}
		return $areas;
	}

	public function getAreasxID($id_area){
		$db=conectar::acceso();
		$areas=[];

		$consultar_areas=$db->prepare('SELECT  id_area,areas.descripcion,areas.estado,areas.id_departamento,departamentos_internos.estado AS estado_departamento,(SELECT COUNT(*) from funcionarios left join cargos ON cargos.id_cargo = cargo left join areas areaB on cargos.id_area = areaB.id_area where areaB.id_area = areas.id_area && festado = 5) AS personasxArea  FROM areas LEFT JOIN departamentos_internos ON departamentos_internos.id_departamento = areas.id_departamento WHERE id_area = :id_area');
		$consultar_areas->bindValue("id_area",$id_area);
		$consultar_areas->execute();
		
		while ($listado_areas=$consultar_areas->fetch(PDO::FETCH_ASSOC)) {
				$areas[]=$listado_areas;	
		}
		return $areas;
	}

	public function modificarArea($id,$descripcion,$estado,$departamento){
		$db=Conectar::acceso();

		$consulta1=$db->prepare("SELECT id_area FROM areas WHERE descripcion = :descripcion && id_area != :id_area");
		$consulta1->bindValue('descripcion',$descripcion);
		$consulta1->bindValue('id_area',$id);
		$consulta1->execute();
		
		if($consulta1){
			$numeroDeConsidencias = $consulta1->rowCount();

			if($numeroDeConsidencias >= 1){
				$db=null;
				return 2;
			}else{
				$consulta=$db->prepare("UPDATE areas SET descripcion = :descripcion, estado =:estado , id_departamento =:departamento WHERE id_area = :id_area");
				$consulta->bindValue('descripcion',$descripcion);
				$consulta->bindValue('estado',$estado);
				$consulta->bindValue('departamento',$departamento);
				$consulta->bindValue('id_area',$id);
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

	public function crearArea($descripcion,$departamento){
		$db=Conectar::acceso();
		$consulta=$db->prepare("SELECT id_area FROM areas WHERE descripcion = :descripcion");
		$consulta->bindValue('descripcion',$descripcion);
		$consulta->execute();
		
		if($consulta){
			$numeroDeConsidencias = $consulta->rowCount();

			if($numeroDeConsidencias >= 1){
				$db=null;
				return 2;
			}else{
				$insertar=$db->prepare("INSERT INTO  areas(descripcion,estado,id_departamento) VALUES(:descripcion,5,:departamento)");
				$insertar->bindValue('descripcion',$descripcion);
				$insertar->bindValue('departamento',$departamento);
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


	public function getAreasxDepartamento($id_departamento){
		$db=conectar::acceso();
		$areas=[];

		$consultar_areas=$db->query("SELECT  id_area,areas.descripcion,areas.estado,departamentos_internos.descripcion AS departamento, areas.id_departamento, (SELECT COUNT(*) from funcionarios left join cargos ON cargos.id_cargo = cargo left join areas areaB on cargos.id_area = areaB.id_area where areaB.id_area = areas.id_area && festado = 5) AS personasxArea FROM areas LEFT JOIN departamentos_internos ON departamentos_internos.id_departamento = areas.id_departamento WHERE departamentos_internos.id_departamento = '$id_departamento'  ORDER BY areas.descripcion ASC");
		
		while ($listado_areas=$consultar_areas->fetch(PDO::FETCH_ASSOC)) {
				$areas[]=$listado_areas;	
		}
		return $areas;
	}


}
?>