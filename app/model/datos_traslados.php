<?php 
class traslados{
	
	private $id_traslado;
	private $funcionario_inicial;
	private $fecha_inicial;
	private $funcionario_final;
	private $fecha_traslado;
	private $activo_traslado;
	private $descripcion_traslado;
	private $nombre;

	public function getId_traslado(){
	    return $this->id_traslado;
		}
		public function setId_traslado($id_traslado){
	    $this->id_traslado = $id_traslado;
	    }
//***************************************************************************

	public function getFuncionario_inicial(){
	    return $this->funcionario_inicial;
		}
		public function setFuncionario_inicial($funcionario_inicial){
	    $this->funcionario_inicial = $funcionario_inicial;
	   	}
//***************************************************************************

	public function getFecha_inicial(){
	    return $this->fecha_inicial;
		}
		public function setFecha_inicial($fecha_inicial){
	    $this->fecha_inicial = $fecha_inicial;
	    }
//****************************************************************************

	public function getFuncionario_final(){
	    return $this->funcionario_final;
		}
		public function setFuncionario_final($funcionario_final){
	    $this->funcionario_final = $funcionario_final;
	    }
//*****************************************************************************

	public function getFecha_traslado(){
	    return $this->fecha_traslado;
		}
		public function setFecha_traslado($fecha_traslado){
	    $this->fecha_traslado = $fecha_traslado;
	    }
//******************************************************************************

	public function getActivo_traslado(){
	    return $this->activo_traslado;
		}
		public function setActivo_traslado($activo_traslado){
	    $this->activo_traslado = $activo_traslado;
	    }
//*******************************************************************************

	public function getDescripcion_traslado(){
	    return $this->descripcion_traslado;
		}
		public function setDescripcion_traslado($descripcion_traslado){
	    $this->descripcion_traslado = $descripcion_traslado;
	    }
//*******************************************************************************

	     public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
}


?>