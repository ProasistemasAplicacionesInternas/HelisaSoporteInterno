<?php
require_once('../model/vinculo.php');

class crudGrupos
{

	//*********************************************************************************************************//
	//*********** Crud para crear la matriz que muestra las grupos al crear un activo *********************//
	//*********************************************************************************************************//	

	public function mostrarGrupos()
	{

		$db = conectar::acceso();
		$grupos = [];

		$consultar_grupos = $db->query('SELECT  id_grupo,nombre_grupo,area_grupo FROM grupos_activos WHERE estado = 5 ORDER BY nombre_grupo');

		while ($listado_grupos = $consultar_grupos->fetch(PDO::FETCH_ASSOC)) {
			$grupos[] = $listado_grupos;
		}
		return $grupos;
	}

	public function createGroup($group)
	{
		$db = conectar::acceso();
		$grupos = $db->prepare('INSERT INTO grupos_activos(nombre_grupo, area_grupo, categoria) 
        VALUES (:nombre_grupo, :area_grupo, :categoria)');
		$grupos->bindValue("nombre_grupo", $group->getNombre_grupo());
		$grupos->bindValue("area_grupo", $group->getAreaGrupo());
		$grupos->bindValue("categoria", $group->getCategoria());
		$grupos->execute();
		echo 200;
		return $grupos->rowCount();
	}

	public function groupExists($nameGroup) {
		$db = conectar::acceso();
		$consult = $db->prepare('SELECT COUNT(*) FROM grupos_activos WHERE nombre_grupo = :nombre_grupo');
		$consult->bindValue('nombre_grupo', $nameGroup);
		$consult->execute();
		$count = $consult->fetchColumn();
		return $count > 0;
	}

	public function updateGroup($group)
	{
		$db = conectar::acceso();
		$grupos = $db->prepare('UPDATE grupos_activos SET nombre_grupo=:nombre_grupo, categoria=:categoria, area_grupo=:area_grupo WHERE id_grupo=:id');
		$grupos->bindValue("nombre_grupo", $group->getNombre_grupo());
		$grupos->bindValue("categoria", $group->getCategoria());
		$grupos->bindValue("area_grupo", $group->getAreaGrupo());
		$grupos->bindValue("id", $group->getId_grupo());
		$grupos->execute();
		echo 300;
		return $grupos->rowCount();
	}

	public function checkGroupExists($new_name, $idGroup) {
		$db = conectar::acceso();
		$sql = "SELECT * FROM grupos_activos WHERE nombre_grupo = ? AND id_grupo != ?";
		$stmt = $db->prepare($sql);
		$stmt->execute([$new_name, $idGroup]);
		return $stmt->fetch();
	}

	public function consultAllGroup()
	{
		$db = Conectar::acceso();
		$consulta = $db->prepare('SELECT id_grupo, nombre_grupo, areas.descripcion area_grupo, categoria, ca.nombre_categoria, ga.estado as status
		FROM grupos_activos ga
		LEFT JOIN categorias_activos ca ON ca.id = ga.categoria 
		LEFT JOIN areas ON areas.id_area = ca.area_categoria
		ORDER BY ga.nombre_grupo ASC');
		$consulta->execute();

		$resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

		return $resultados;
	}

	public function findGroup($id)
	{
		$db = Conectar::acceso();
		$consult = $db->prepare('SELECT id_grupo, nombre_grupo, areas.descripcion AS area_grupo, categoria, ca.nombre_categoria, ga.area_grupo as idgrupo
    FROM grupos_activos ga
    LEFT JOIN categorias_activos ca ON ca.id = ga.categoria 
    LEFT JOIN areas ON areas.id_area = ca.area_categoria
    WHERE ga.id_grupo = :id');
		$consult->bindValue("id", $id);
		$consult->execute();

		$resultado = $consult->fetch(PDO::FETCH_ASSOC);
		return $resultado;
	}
	public function updateStatus($group)
	{
		$db = conectar::acceso();
		$checkAssets = $db->prepare('SELECT COUNT(*) as total FROM activos_internos WHERE grupo_activo = :id AND estado_activo NOT IN (11, 15)');
		$checkAssets->bindValue("id", $group->getId_grupo());
		$checkAssets->execute();
		$result = $checkAssets->fetch(PDO::FETCH_ASSOC);
		if ($result['total'] > 0) {
			echo 403; 
			return;
		}
		$edit = $db->prepare('UPDATE grupos_activos 
			SET estado = :new_status
			WHERE id_grupo = :id');
		$edit->bindValue("new_status", $group->getStatus());
		$edit->bindValue("id", $group->getId_grupo());
		$edit->execute();

		if (!$edit) {
			echo 500;
		}
		echo 200;
	}
}
