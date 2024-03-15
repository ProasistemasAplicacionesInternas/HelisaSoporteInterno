<?php
class datosVersion {
    private $plataforma;
    private $administrador;
    private $version;
    private $fechaSubida;

    public function setPlataforma($plataforma){
        $this->plataforma = $plataforma;
    }

    public function getPlataforma(){
        return $this->plataforma;
    }

    public function setAdministrador($administrador){
        $this->administrador = $administrador;
    }

    public function getAdministrador(){
        return $this->administrador;
    }

    public function setVersion($version){
        $this->version = $version;
    }

    public function getVersion(){
        return $this->version;
    }

    public function setFechaVersion($fechaSubida){
        $this->fechaSubida = $fechaSubida;
    }

    public function getFechaVersion(){
        return $this->fechaSubida;
    }
}
?>