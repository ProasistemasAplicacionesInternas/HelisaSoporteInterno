<?php

class Accesos{
    private $id_acceso;
    private $id_usuario;
    private $tipo_acceso;
    private $usuario;
    private $clave;  
    private $fecha_registro;
    private $estadoA;
    private $fecha_inactivacion;
    private $descripcionAcceso;
    private $descripcionEstado;
    

    /**************************************/
    public function getIdAcceso(){
            return $this->id_acceso;
        }
    public function setIdAcceso($id_acceso){
            $this->id_acceso = $id_acceso;
        }

    /****************************************/

    public function getId_usuario()
    {
        return $this->id_usuario;
    }
    
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getTipoAcceso()
    {
        return $this->tipo_acceso;
    }
    
    public function setTipoAcceso($tipo_acceso)
    {
        $this->tipo_acceso = $tipo_acceso;
        return $this;
    }

      public function getDescripcionAcceso(){
        return $this->descripcionAcceso;
    }
    public function setDescripcionAcceso($descripcionAcceso){
        $this->descripcionAcceso = $descripcionAcceso;
        } 


   
    public function getUsuario(){ //**************************
        return $this->usuario;//**************************
    }
    public function setUsuario($usuario){//**************************
        $this->usuario = $usuario;//**************************
    }
     
     /***********************************/
    
    public function getClave(){
        return $this->clave;
    }
    public function setClave($clave){
        $this->clave = $clave;
    }

    /***********************************/

    
    public function getFechaRegistro(){
        return $this->fecha_registro;
    }
    public function setFechaRegistro($fecha_registro){
        $this->fecha_registro = $fecha_registro;
    }

    /**********************************/

    public function getEstadoA()
    {
        return $this->estadoA;
    }
    
    public function setEstadoA($estadoA)
    {
        $this->estadoA = $estadoA;
        return $this;
    }

    public function getDescripcionEstado()
    {
        return $this->descripcionEstado;
    }
    
    public function setDescripcionEstado($descripcionEstado)
    {
        $this->descripcionEstado = $descripcionEstado;
        return $this;
    }

    /***********************************/
    
    public function getFechaInactivacion(){
        return $this->fecha_inactivacion;
    }
    public function setFechaInactivacion($fecha_inactivacion){
        $this->fecha_inactivacion = $fecha_inactivacion;
    }
    
   
}

?>
