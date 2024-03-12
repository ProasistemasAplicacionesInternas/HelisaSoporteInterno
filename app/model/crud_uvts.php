<?php
require_once("../model/vinculo.php");

class CrudUvts
{

    public function insertUvt($uvt)
    {
        $db = Conectar::acceso();

        $insertUvt = $db->prepare('INSERT INTO uvts(year_uvt, value_uvt) VALUES(:year_uvt, :value_uvt)');
        $insertUvt->bindValue(':year_uvt', $uvt->getYearUvt());
        $insertUvt->bindValue('value_uvt', $uvt->getValueUvt());
        $insertUvt->execute();

        if (!$insertUvt) {
            echo false;
        }
        echo true;
    }

    public function updateUvt($uvt)
    {
        $db = Conectar::acceso();

        $updateUvt = $db->prepare('UPDATE uvts SET value_uvt = :value_uvt WHERE year_uvt = :year_uvt');

        $updateUvt->bindValue(':value_uvt', $uvt->getValueUvt());
        $updateUvt->bindValue(':year_uvt', $uvt->getYearUvt());

        $updateUvt->execute();
    }

    public function consultAllUvts()
    {
        $db = Conectar::acceso();

        $consulta = $db->prepare('SELECT * FROM uvts ORDER BY year_uvt DESC');
        $consulta->execute();

        $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function existUvtByYear($year)
    {
        $db = Conectar::acceso();

        $consulta = $db->prepare('SELECT COUNT(*) as count FROM uvts WHERE year_uvt = :year_uvt');
        $consulta->bindValue(':year_uvt', $year);
        $consulta->execute();

        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        return($resultado['count'] > 0);
    }

    public function searchLastYear()
    {
        $db = Conectar::acceso();
        $consult = $db->query('SELECT * FROM uvts WHERE year_uvt = (SELECT MAX(year_uvt) FROM uvts);');
        $consult->execute();
        $resultado = $consult->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
