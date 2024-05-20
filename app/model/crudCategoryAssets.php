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

	public function updateStatus($category){
		$db = conectar::acceso();
		$edit = $db->prepare('UPDATE categorias_activos 
		SET estado=:new_status
         WHERE id=:id');
		$edit->bindValue("new_status", $category->getStatus());
		$edit->bindValue("id", $category->getId());
		$edit->execute();

		if (!$edit) {
			echo 500;
		}
		echo 200;
	}
}