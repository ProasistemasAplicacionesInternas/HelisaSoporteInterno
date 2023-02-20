<?php 


class Crudaccesos{
	
	private $db;
	private $tipoAccesos;

	public function __construct(){

		require_once('../model/vinculo.php');

		$this->db=Conectar::acceso();
		$this->tipoAccesos=array();

	}


   public function mostrarAccesos(){

		
		$consultar_accesos=$this->db->query('SELECT id_accesos,descripcion FROM tipos_accesos ORDER BY descripcion ');

			while ($listado_accesos=$consultar_accesos->fetch(PDO::FETCH_ASSOC)) {

					$this->tipoAccesos[]=$listado_accesos;	
			}
			return $this->tipoAccesos;
		}
}
?>