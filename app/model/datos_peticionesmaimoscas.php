<?php 
class PeticionMai{

	private $id_peticionMai;
    private $fecha_peticionMai;
    private $usuario_creacionMai;
    private $fecha_atendidoMai;
    private $estado_peticionMai;
    private $producto_peticionMai;
    private $descripcion_peticionMai;
    private $imagen_peticionMai;
    private $imagen_peticionMai2;
    private $imagen_peticionMai3;
    private $conclusiones_peticionMai;
    private $usuario_atencionMai;
    private $codigo_redireccionadoMai;
    private $categoria_redireccionado;
    private $area_funcionario;
    private $extension_funcionario;
    private $email_funcionario;
	private $marca_revisado;
	private $tipoPeticion;

	
    
//************************************************
	public function getId_peticionMai(){
	    return $this->id_peticionMai;
	}
		public function setId_peticionMai($id_peticionMai){
	    $this->id_peticionMai = $id_peticionMai;
	    }
//*************************************************
	public function getFecha_peticionMai(){
	    return $this->fecha_peticionMai;
	}
		public function setFecha_peticionMai($fecha_peticionMai){
	    $this->fecha_peticionMai = $fecha_peticionMai;
	    }
//*************************************************
    public function getUsuario_creacionMai(){
	    return $this->usuario_creacionMai;
	}
		public function setUsuario_creacionMai($usuario_creacionMai){
	    $this->usuario_creacionMai = $usuario_creacionMai;
	    }
//*************************************************
    public function getFecha_atendidoMai(){
	    return $this->fecha_atendidoMai;
	}
		public function setFecha_atendidoMai($fecha_atendidoMai){
	    $this->fecha_atendidoMai = $fecha_atendidoMai;
	    }
//*************************************************
    public function getEstado_peticionMai(){
	    return $this->estado_peticionMai ;
	}
		public function setEstado_peticionMai($estado_peticionMai ){
	    $this->estado_peticionMai = $estado_peticionMai ;
	    }
//*************************************************
    public function getProducto_peticionMai(){
	    return $this->producto_peticionMai ;
	}
		public function setProducto_peticionMai($producto_peticionMai ){
	    $this->producto_peticionMai = $producto_peticionMai ;
	    }
//*************************************************
    public function getDescripcion_peticionMai(){
	    return $this->descripcion_peticionMai ;
	}
		public function setDescripcion_peticionMai($descripcion_peticionMai ){
	    $this->descripcion_peticionMai = $descripcion_peticionMai ;
	    }
//*************************************************
    public function getImagen_peticionMai(){
	    return $this->imagen_peticionMai;
	}
		public function setImagen_peticionMai($imagen_peticionMai){
	    $this->imagen_peticionMai = $imagen_peticionMai ;
	    }
//*************************************************
    public function getImagen_peticionMai2(){
	    return $this->imagen_peticionMai2;
	}
		public function setImagen_peticionMai2($imagen_peticionMai2){
	    $this->imagen_peticionMai2 = $imagen_peticionMai2;
	    }
//*************************************************
    public function getImagen_peticionMai3(){
	    return $this->imagen_peticionMai3;
	}
		public function setImagen_peticionMai3($imagen_peticionMai3){
	    $this->imagen_peticionMai3 = $imagen_peticionMai3;
	    }
//*************************************************
    public function getConclusiones_peticionMai(){
	    return $this->conclusiones_peticionMai ;
	}
		public function setConclusiones_peticionMai($conclusiones_peticionMai ){
	    $this->conclusiones_peticionMai = $conclusiones_peticionMai ;
	    }
//*************************************************
    public function getUsuario_atencionMai(){
	    return $this->usuario_atencionMai ;
	}
		public function setUsuario_atencionMai($usuario_atencionMai ){
	    $this->usuario_atencionMai = $usuario_atencionMai ;
	    }
//*************************************************
    public function getCodigo_redireccionadoMai(){
	    return $this->codigo_redireccionadoMai ;
	}
		public function setCodigo_redireccionadoMai($codigo_redireccionadoMai ){
	    $this->codigo_redireccionadoMai = $codigo_redireccionadoMai ;
	    }
//*************************************************
    public function getCategoria_redireccionado(){
	    return $this->categoria_redireccionado;
	}
		public function setCategoria_redireccionado($categoria_redireccionado){
	    $this->categoria_redireccionado = $categoria_redireccionado;
	    }
//*************************************************    
    public function getArea_funcionario(){
	    return $this->area_funcionario ;
	}
		public function setArea_funcionario($area_funcionario ){
	    $this->area_funcionario = $area_funcionario ;
	    }
//*************************************************
    public function getExtension_funcionario(){
	    return $this->extension_funcionario ;
	}
		public function setExtension_funcionario($extension_funcionario ){
	    $this->extension_funcionario = $extension_funcionario ;
	    }
//*************************************************
    public function getEmail_funcionario(){
	    return $this->email_funcionario ;
	}
		public function setEmail_funcionario($email_funcionario ){
	    $this->email_funcionario = $email_funcionario ;
	    }
//*************************************************
    public function getMarca_revisado(){
	    return $this->marca_revisado;
	}
		public function setMarca_revisado($marca_revisado){
	    $this->marca_revisado = $marca_revisado;
	    }
//*************************************************
	public function getName(){
		return $this->tipoPeticion;
	}
	public function setName($tipoPeticion){
		$this-> tipoPeticion = $tipoPeticion;
	}
//*************************************************


}
?>