<?php
require_once('../model/vinculo.php');

class CrudCategoryAssets{
    public function createCategory($category){
        $db = conectar::acceso();
		$create = $db->prepare('INSERT INTO categorias_activos(nombre_categoria, area_categoria) 
        VALUES (:nombre_categoria, :area_categoria)');
		$create->bindValue("nombre_categoria", $category->getNameCategory());
		$create->bindValue("area_categoria", $category->getAreaCategory());
		$create->execute();
		echo 200;
    }
	public function categoryExists($nameCategory) {
        $db = conectar::acceso();
        $consult = $db->prepare('SELECT COUNT(*) FROM categorias_activos WHERE nombre_categoria = :nombre_categoria');
        $consult->bindValue('nombre_categoria', $nameCategory);
        $consult->execute();
        $count = $consult->fetchColumn();
        return $count > 0;
    }
    public function editCategory($category){
        $db = conectar::acceso();
		$edit = $db->prepare('UPDATE categorias_activos 
		SET nombre_categoria=:nombre_categoria, area_categoria=:area_categoria
         WHERE id=:id');
		$edit->bindValue("nombre_categoria",$category->getNameCategory());
		$edit->bindValue("area_categoria", $category->getAreaCategory());
		$edit->bindValue("id", $category->getId());
		$edit->execute();
		echo 300;
    }
	public function checkCategoryExists($new_name, $idCategory) {
		$db = conectar::acceso();
		$sql = "SELECT * FROM categories WHERE nameCategory = ? AND idCategory != ?";
		$stmt = $this->$db->prepare($sql);
		$stmt->execute([$new_name, $idCategory]);
		return $stmt->fetch();
	}
    public function consultAllCategory(){
        $db = Conectar::acceso();
		$consult = $db->prepare('SELECT id, nombre_categoria, area_categoria, a.descripcion nombre_area, ca.estado as code_state
        FROM categorias_activos ca
		LEFT JOIN areas a ON a.id_area = ca.area_categoria ORDER BY nombre_categoria ASC');
		$consult->execute();
		$resultados = $consult->fetchAll(PDO::FETCH_ASSOC);
		return $resultados;
    }
	
	public function consultAllCategory1(){
        $db = Conectar::acceso();
		$consult = $db->prepare('SELECT id, nombre_categoria, area_categoria, a.descripcion nombre_area, ca.estado as code_state
        FROM categorias_activos ca
		LEFT JOIN areas a ON a.id_area = ca.area_categoria
		WHERE ca.estado = 5
		ORDER BY nombre_categoria ASC');
		$consult->execute();
		$resultados = $consult->fetchAll(PDO::FETCH_ASSOC);
		return $resultados;
    }
    
	public function findCategory($id){
		$db = Conectar::acceso();
		$consult = $db->prepare('SELECT id, nombre_categoria, area_categoria as id_area, a.descripcion nombre_area 
			FROM categorias_activos ca
			LEFT JOIN areas a ON a.id_area = ca.area_categoria 
			WHERE ca.id = :id');
		$consult->bindValue("id", $id);
		$consult->execute();
		$resultado = $consult->fetch(PDO::FETCH_ASSOC);
		 // Depuración
		 error_log(print_r($resultado, true));
		return $resultado;
	}

	public function updateStatus($category) {
		$db = conectar::acceso();
		
		$checkGroups = $db->prepare('SELECT COUNT(*) as total FROM grupos_activos WHERE categoria = :id AND estado = 5');
		$checkGroups->bindValue("id", $category->getId());
		$checkGroups->execute();
		$result = $checkGroups->fetch(PDO::FETCH_ASSOC);
		

		if ($result['total'] > 0) {
			echo 403; 
			return;
		}
	
		$edit = $db->prepare('UPDATE categorias_activos 
			SET estado = :new_status
			WHERE id = :id');
		$edit->bindValue("new_status", $category->getStatus());
		$edit->bindValue("id", $category->getId());
		$edit->execute();
	
		if (!$edit) {
			echo 500;
		} else {
			echo 200;
		}
	}
}