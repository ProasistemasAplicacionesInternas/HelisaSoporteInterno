<?php
require_once('../model/vinculo.php');
class crudVersion {

    public function consultaVersion(){
        $db=conectar::acceso();
        $consultaV=$db->query("SELECT proyecto, administrador, version, fechaSubida FROM version_proyecto");
        $consultaV->execute();
        $listaV = [];
        while($dataLine=$consultaV->fetch(PDO::FETCH_ASSOC)){
            $listaV['data'][] = $dataLine;
        }
        echo(json_encode($listaV));
    }

}
?>