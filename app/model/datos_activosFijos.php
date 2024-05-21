<?php 

	Class activosFijos{

		private $af_id;
		private $af_codigo;
		private $af_serial;
		private $af_nombre;
		private $af_estado;
		private $af_descripcion_estado;
		private $af_marca;
		private $af_modelo;
		private $af_fechaCompra;
		private $af_grupo;
		private $af_area;
		private $af_ubicacion;
		private $af_funcionario;
		private $identidad_funcionario;
		private $af_fechaAsignacion;
		private $af_observaciones;
		private $af_ram;
		private $af_disco;
		private $af_procesador;
		private $af_sistemaOperativo;
		private $af_dominio;
		private $af_licenciaSO;
		private $af_licenciaOffice;
		private $af_licenciaAntivirus;
		private $af_aplicaciones;
		private $nombre;
		private $af_areaCreacion;
		private $imgActivo;
		private $costoCompra;
		private $tipoAct;
		private $vidaUtil;
		private $estadoAct;
		private $traCategoria;
		private $hostName;
		private $sede;
		public function getAf_id(){
		    				return $this->af_id;
						}
						public function setAf_id($af_id){
		    				$this->af_id = $af_id;
		    				}

		public function getAf_codigo(){
						    return $this->af_codigo;
						}
						public function setAf_codigo($af_codigo){
						    $this->af_codigo = $af_codigo;
						    }

		public function getAf_serial(){
						    return $this->af_serial;
						}
							public function setAf_serial($af_serial){
						    $this->af_serial = $af_serial;
						    }

		public function getAf_nombre(){
				    		return $this->af_nombre;
				    	}
				    		public function setAf_nombre($af_nombre){
				    		$this->af_nombre = $af_nombre;
				    		}

		public function getAf_estado(){
				    		return $this->af_estado;
				    	}
				    		public function setAf_estado($af_estado){
				    		$this->af_estado = $af_estado;
				    		}

		public function getAf_descripcion_estado(){
			return $this->af_descripcion_estado;
		}					
		public function setAf_descripcion_estado($af_descripcion_estado){
			$this->af_descripcion_estado = $af_descripcion_estado;
		}

		public function getAf_marca(){
				    		return $this->af_marca;
				    	}
				    		public function setAf_marca($af_marca){
				    		$this->af_marca = $af_marca;
				    		}	

		public function getAf_modelo(){
			    			return $this->af_modelo;
			    		}
			    			public function setAf_modelo($af_modelo){
			    			$this->af_modelo = $af_modelo;
			    			}

		public function getAf_fechaCompra(){
			    			return $this->af_fechaCompra;
			    		}
			    			public function setAf_fechaCompra($af_fechaCompra){
			    			$this->af_fechaCompra = $af_fechaCompra;
			    			}	

		public function getAf_grupo(){
		    				return $this->af_grupo;
		    			}
		    				public function setAf_grupo($af_grupo){
		    				$this->af_grupo = $af_grupo;
		    				}

		public function getAf_area(){
		    				return $this->af_area;
		    			}
		    				public function setAf_area($af_area){
		    				$this->af_area = $af_area;
		    				}

		public function getAf_ubicacion(){
								return $this->af_ubicacion;
							}
								public function setAf_ubicacion($af_ubicacion){
								$this->af_ubicacion = $af_ubicacion;
								}

		public function getAf_funcionario(){
		    				return $this->af_funcionario;
		    			}
		    				public function setAf_funcionario($af_funcionario){
		    				$this->af_funcionario = $af_funcionario;
		    				}

		public function getIdentidad_funcionario(){
		    				return $this->identidad_funcionario;
						}
							public function setIdentidad_funcionario($identidad_funcionario){
						    $this->identidad_funcionario = $identidad_funcionario;
						    }

		public function getAf_fechaAsignacion(){
		    				return $this->af_fechaAsignacion;
		    			}
		    				public function setAf_fechaAsignacion($af_fechaAsignacion){
		    				$this->af_fechaAsignacion = $af_fechaAsignacion;
		    				}

		public function getAf_observaciones(){
		    				return $this->af_observaciones;
		    			}
		    				public function setAf_observaciones($af_observaciones){
		    				$this->af_observaciones = $af_observaciones;
		    				}

		public function getAf_ram(){
		    				return $this->af_ram;
		    			}
		    				public function setAf_ram($af_ram){
		    				$this->af_ram = $af_ram;
		    				}

		public function getAf_disco(){
		    				return $this->af_disco;
		    			}
		    				public function setAf_disco($af_disco){
		    				$this->af_disco = $af_disco;
		    				}

		public function getAf_procesador(){
		    				return $this->af_procesador;
		    			}
		    				public function setAf_procesador($af_procesador){
		    				$this->af_procesador = $af_procesador;
		    				} 

		public function getAf_sistemaOperativo(){
		   				    return $this->af_sistemaOperativo;
		   				}
		   					public function setAf_sistemaOperativo($af_sistemaOperativo){
		   				    $this->af_sistemaOperativo = $af_sistemaOperativo;
		   				    } 

		public function getAf_dominio(){
		  				    return $this->af_dominio;
		  				}
		  					public function setAf_dominio($af_dominio){
		  				    $this->af_dominio = $af_dominio;
		  				    } 

		public function getAf_licenciaSO(){
		 				    return $this->af_licenciaSO;
		 				}
		 					public function setAf_licenciaSO($af_licenciaSO){
		 				    $this->af_licenciaSO = $af_licenciaSO;
		 				    } 

		public function getAf_licenciaOffice(){
						    return $this->af_licenciaOffice;
						}
							public function setAf_licenciaOffice($af_licenciaOffice){
						    $this->af_licenciaOffice = $af_licenciaOffice;
						    }

		public function getAf_licenciaAntivirus(){
						    return $this->af_licenciaAntivirus;
						}
							public function setAf_licenciaAntivirus($af_licenciaAntivirus){
						    $this->af_licenciaAntivirus = $af_licenciaAntivirus;
						    }

		public function getAf_aplicaciones(){
						    return $this->af_aplicaciones;
						}
							public function setAf_aplicaciones($af_aplicaciones){
						    $this->af_aplicaciones = $af_aplicaciones;
						    }	
						     public function getNombre(){
						            return $this->nombre;
						        }

						        public function setNombre($nombre){
						            $this->nombre = $nombre;
						        }
								
		public function getAf_areaCreacion(){return $this->af_areaCreacion;}
		public function setAf_areaCreacion($af_areaCreacion){$this->af_areaCreacion = $af_areaCreacion;}

		public function getImagenactivo(){
			return $this->imgActivo;
		}
		public function setImagenactivo($imgActivo){
			$this->imgActivo = $imgActivo ;
		}
		
		public function getcostoCompra() {
			return $this->costoCompra;
		}
	
		public function setcostoCompra($costoCompra) {
			$this->costoCompra = $costoCompra;
		}
	
		public function gettipoAct() {
			return $this->tipoAct;
		}
	
		public function settipoAct($tipoAct) {
			$this->tipoAct = $tipoAct;
		}
	
		public function getvidaUtil() {
			return $this->vidaUtil;
		}
	
		public function setvidaUtil($vidaUtil) {
			$this->vidaUtil = $vidaUtil;
		}
	
		public function getestadoAct() {
			return $this->estadoAct;
		}
	
		public function setestadoAct($estadoAct) {
			$this->estadoAct = $estadoAct;
		}
        	
		public function gettraCategoria() {
			return $this->traCategoria;
		}
	
		public function settraCategoria($traCategoria) {
			$this->traCategoria = $traCategoria;
		}
		public function gethostName() {
			return $this->hostName;
		}
	
		public function sethostName($hostName) {
			$this->hostName = $hostName;
		}
		public function getsede() {
			return $this->sede;
		}
	
		public function setsede($sede) {
			$this->sede = $sede;
		}
	}
 ?>