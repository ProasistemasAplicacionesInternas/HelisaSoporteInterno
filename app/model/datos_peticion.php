<?php 
class Peticion{

	private $p_nropeticion;
	private $p_fechapeticion;
	private $p_usuario;
	private $p_fechaatendido;
	private $p_estado;
	private $p_categoria;
	private $p_descripcion;
	private $p_cargarimagen;
    private $p_cargarimagen2;
    private $p_cargarimagen3;
	private $p_activo;
	private $p_codigoactivo;
	private $p_area;
	private $p_Extension;
	private $p_correo;
	private $p_conclusiones;
    private $p_usuarioatiende;
    private $peticion_co;
    private $comentario;
    private $estado_encuesta;
    private $calificacion;
    private $revisado;
	private $name;
	private $req_nombre;
	private $req_justificacion;
	private $id;
	private $sprint;
	private $gestion;
//************************************************
	public function getP_nropeticion(){
	    return $this->p_nropeticion;
	}
		public function setP_nropeticion($p_nropeticion){
	    $this->p_nropeticion = $p_nropeticion;
	    }
//*************************************************
	public function getP_fechapeticion(){
	    return $this->p_fechapeticion;
	}
		public function setP_fechapeticion($p_fechapeticion){
	    $this->p_fechapeticion = $p_fechapeticion;
	    }
//************************************************
	public function getP_usuario(){
	    return $this->p_usuario;
	}
		public function setP_usuario($p_usuario){
	    $this->p_usuario = $p_usuario;
	    }
//**************************************************
	public function getP_fechaatendido(){
	    return $this->p_fechaatendido;
	}
		public function setP_fechaatendido($p_fechaatendido){
	    $this->p_fechaatendido = $p_fechaatendido;
	    }
//*************************************************
	public function getP_estado(){
	    return $this->p_estado;
	}
		public function setP_estado($p_estado){
	    $this->p_estado = $p_estado;
	    }
//*************************************************
	public function getP_categoria(){
	    return $this->p_categoria;
	}
		public function setP_categoria($p_categoria){
	    $this->p_categoria = $p_categoria;
	    }
//**************************************************
	public function getP_descripcion(){
	    return $this->p_descripcion;
	}
		public function setP_descripcion($p_descripcion){
	    $this->p_descripcion = $p_descripcion;
	    }
//*************************************************
	public function getP_cargarimagen(){
	    return $this->p_cargarimagen;
	}
	public function setP_cargarimagen($p_cargarimagen){
	    $this->p_cargarimagen = $p_cargarimagen;
	    }
//************************************************
    public function getP_cargarimagen2(){
	    return $this->p_cargarimagen2;
	}
	public function setP_cargarimagen2($p_cargarimagen2){
	    $this->p_cargarimagen2 = $p_cargarimagen2;
	    }
//************************************************
    public function getP_cargarimagen3(){
	    return $this->p_cargarimagen3;
	}
	public function setP_cargarimagen3($p_cargarimagen3){
	    $this->p_cargarimagen3 = $p_cargarimagen3;
	    }
//************************************************
	public function getP_activo(){
		return $this->p_activo;
	}
	public function setP_activo($p_activo){
		$this->p_activo = $p_activo;
	}
//************************************************
	public function getP_codigoactivo(){
		return $this->p_codigoactivo;
	}
	public function setP_codigoactivo($p_codigoactivo){
		$this->p_codigoactivo = $p_codigoactivo;
	}
//************************************************
	public function getP_area(){
	    return $this->p_area;
	}
		public function setP_area($p_area){
	    $this->p_area = $p_area;
	    }
//**************************************************
	public function getP_Extension(){
	    return $this->p_Extension;
	}
		public function setP_Extension($p_Extension){
	    $this->p_Extension = $p_Extension;
		}
//**************************************************
	public function getP_correo(){
	    return $this->p_correo;
	}
		public function setP_correo($p_correo){
	    $this->p_correo = $p_correo;
	    }
//************************************************
	public function getP_conclusiones()
	{
	    return $this->p_conclusiones;
	}
	
	public function setP_conclusiones($p_conclusiones)
	{
	    $this->p_conclusiones = $p_conclusiones;
	    return $this;
	}

//************************************************///
	public function getP_usuarioatiende()
	{
	    return $this->p_usuarioatiende;
	}
	
	public function setP_usuarioatiende($p_usuarioatiende)
	{
	    $this->p_usuarioatiende = $p_usuarioatiende;
	    return $this;
	}

//************************************************///

	public function getPeticion_co()
	{
	    return $this->peticion_co;
	}
	
	public function setPeticion_co($peticion_co)
	{
	    $this->peticion_co = $peticion_co;
	    return $this;
	}
//************************************************///

	public function getComentario()
	{
	    return $this->comentario;
	}
	
	public function setComentario($comentario)
	{
	    $this->comentario = $comentario;
	    return $this;
	}
//************************************************///
	public function getEstado_encuesta(){
	    return $this->estado_encuesta;
	}
		public function setEstado_encuesta($estado_encuesta){
	    $this->estado_encuesta = $estado_encuesta;
	    }
//************************************************
	public function getCalificacion(){
	    return $this->calificacion;
	}
		public function setCalificacion($calificacion){
	    $this->calificacion = $calificacion;
	    }
//*************************************************
//************************************************
	public function getRevisado(){
	    return $this->revisado;
	}
		public function setRevisado($revisado){
	    $this->revisado = $revisado;
	    }

/********************DATOS TABLA tipo_soportemai******************/
	public function getName(){
		return $this->name;
	}	
		public function setName($name){
			$this->name = $name;
		}
//***************************************** 
// 

	public function getReq_nombre(){
		return $this->req_nombre;
	}	
	public function setReq_nombre($req_nombre){
		$this->req_nombre = $req_nombre;
	}

//***************************************** 
// 

	public function getReq_justificacion(){
		return $this->req_justificacion;
	}	
	public function setReq_justificacion($req_justificacion){
		$this->req_justificacion = $req_justificacion;
	}


//***************************************** 
//	
	public function getId(){
		return $this->id;
	}
		public function setId($id){
			$this->id = $id;
		}

		public function getSprint(){
			return $this->sprint;
		}
			public function setSprint($sprint){
			$this->sprint = $sprint;
			
		}
	
		public function getGestion(){
			return $this->gestion;
		}
			public function setGestion($gestion){
			$this->gestion = $gestion;
			
		}
	}
?>