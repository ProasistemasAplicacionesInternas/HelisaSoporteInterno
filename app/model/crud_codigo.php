<?php
require_once ('vinculo.php');
require __DIR__. '/vendor/autoload.php';

class datosCodigo{

  public function insercionCodigoQR($datos){
    $db=conectar::acceso();
    $saveQR=$db->prepare("INSERT INTO codigosqr (id_usuario,codigo, fecha) VALUES (:id_usuario,:code, :fecha)");
    $saveQR->bindValue('id_usuario',$datos->getId_Usuario());
    $saveQR->bindValue('code', $datos->getCodigo());
    $saveQR->bindValue('fecha', $datos->getFecha());
    $saveQR->execute();
  }

  public function insercionCodigoQRFuncionarios($datosF){
    $db=conectar::acceso();
    $saveQRF=$db->prepare("INSERT INTO codigosqr_funcionarios (id_usuario,codigo, fecha) VALUES (:id_usuario,:code, :fecha)");
    $saveQRF->bindValue('id_usuario',$datosF->getF_usuario());
    $saveQRF->bindValue('code', $datosF->getF_codigo());
    $saveQRF->bindValue('fecha', $datosF->getF_fecha());
    $saveQRF->execute();
  }

  public function eliminarCodigoFuncionarios($datos){
    $db=conectar::acceso();
    $deleteQRF=$db->prepare('DELETE FROM codigosqr_funcionarios WHERE id_usuario=:f_usuario');
    $deleteQRF->bindValue('f_usuario',$datos->getId_Usuario());
    $deleteQRF->execute();
  }

  public function eliminarCodigoUsuarios($datosC){
    $db=conectar::acceso();
    $deleteQR=$db->prepare('DELETE FROM codigosqr WHERE id_usuario=:usuario');
    $deleteQR->bindValue('usuario',$datosC->getId_Usuario());
    $deleteQR->execute();
  }
}
?>