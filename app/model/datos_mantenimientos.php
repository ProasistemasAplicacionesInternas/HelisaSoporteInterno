<?php 
	class mantenimientos{

		private $id_mantenimiento;
		private $codigo_mantenimiento;
		private $fecha_mantenimiento;
		private $descripcion_mantenimiento;
		private $responsable_mantenimiento;
		private $costo_mantenimiento;
		private $activo_mantenimiento;
		private $activo_documentos;

		public function getId_mantenimiento(){
		    return $this->id_mantenimiento;
		}
			public function setId_mantenimiento($id_mantenimiento){
		    $this->id_mantenimiento = $id_mantenimiento;
		    }
//*************************************************************************

		public function getCodigo_mantenimiento(){
		    return $this->codigo_mantenimiento;
		}
			public function setCodigo_mantenimiento($codigo_mantenimiento){
		    $this->codigo_mantenimiento = $codigo_mantenimiento;
		    }
//*************************************************************************

		public function getFecha_mantenimiento(){
		    return $this->fecha_mantenimiento;
		}
			public function setFecha_mantenimiento($fecha_mantenimiento){
		    $this->fecha_mantenimiento = $fecha_mantenimiento;
		    }
//*************************************************************************

		public function getDescripcion_mantenimiento(){
		    return $this->descripcion_mantenimiento;
		}
			public function setDescripcion_mantenimiento($descripcion_mantenimiento){
		    $this->descripcion_mantenimiento = $descripcion_mantenimiento;
		    }
//*****************************************************************************

		public function getResponsable_mantenimiento(){
		    return $this->responsable_mantenimiento;
		}
			public function setResponsable_mantenimiento($responsable_mantenimiento){
		    $this->responsable_mantenimiento = $responsable_mantenimiento;
		    }
//********************************************************************************

		public function getCosto_mantenimiento(){
		    return $this->costo_mantenimiento;
		}
			public function setCosto_mantenimiento($costo_mantenimiento){
		    $this->costo_mantenimiento = $costo_mantenimiento;
		    }
//*******************************************************************************

		public function getActivo_mantenimiento(){
		    return $this->activo_mantenimiento;
		}
			public function setActivo_mantenimiento($activo_mantenimiento){
		    $this->activo_mantenimiento = $activo_mantenimiento;
		    }

		
		public function getActivo_documentos(){
		    return $this->activo_documentos;
		}
			public function setActivo_documentos($activo_documentos){
		    $this->activo_documentos = $activo_documentos;
		    }

 	}
 ?>