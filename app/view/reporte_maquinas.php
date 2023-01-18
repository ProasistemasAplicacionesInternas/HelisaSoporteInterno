<?php
    ini_set("session.cookie_lifetime","18000");
    ini_set("session.gc_maxlifetime","18000");
    session_start();
        if(!isset($_SESSION['usuario'])|| empty($_SESSION['usuario'])){
    // header('location:../../login.php');
    }
    require_once("../model/vinculo.php");
    require_once('../model/crud_servidor.php');
    require_once('../model/datos_servidor.php'); 
	require('../controller/controlReporteMaquinas.php');
    require_once('../../public/mpdf/vendor/autoload.php')      
?>
<?php
$html  ='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reporte_maquinas.css" media="all"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div><img id="imagen_reporte" src="../../public/img/reporte_maquinas/computadora.jpg" ></div>
    <div class="mt-5 recuadro" style="text-align:center">
    <br>';       
        foreach($arregloservidores as $item):
    $html .='
        <div class="row" style="margin:50px 15px 15px 15px" >
            <div class="cuadro" id="cuadroservidores" style="border-radius: 5px; border:solid; border-color: #EC008C ">                
                <div>
                    <h6>Nombre: '. $item['nombre_servidor'] .'</h6>
                    <h6>IP: '. $item['IP_servidor'] .'</h6>
                    <br>
                </div>
                <img id="servidor" class="pequeña" src="../../public/img/reporte_maquinas/server.png">
            </div>
        </div>
        
        <div class="col-sm maquinas">';
        foreach($item['maquinas'] as $maquina):
    $html .='
            <div class="cuadros" id="cuadromaquinas" style="border-radius: 5px; border:solid; border-color: #59947f ">
                <div>
                    <br>
                    <h6 >Nombre: '. $maquina['nombre_maquina'] .'</h6> 
                    <h6 >IP: '. $maquina['IP_maquina'] .'</h6> 
                    <br>
                </div>';
            if($maquina['sistema_operativo'] == "Linux Centos"):
                $html .='<img id="linux" class="pequeña" src="../../public/img/reporte_maquinas/linux.png">';
                elseif($maquina['sistema_operativo'] == "WIndows Server 2019 Standar" || $maquina['sistema_operativo'] == "Windows 2019 Server Data Center (64bit)" 
                || $maquina['sistema_operativo'] == "WIndows Server Standard 2019" || $maquina['sistema_operativo'] == "Windows Server 2019 Standar"
                || $maquina['sistema_operativo'] == "Windows server 2012 R2 Standard" || $maquina['sistema_operativo'] == "WIndows Server Standard 2012" 
                || $maquina['sistema_operativo'] == "windows server 2012 R2 Standard"):
                $html .='<img id="windows" class="pequeña" src="../../public/img/reporte_maquinas/windows.png">';
                endif;
        $html .='
            </div>';
                 endforeach; 
        $html .='</div>
                
                ';
        endforeach;
$html .='</div>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>
</html>';
$mpdf=new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L']);
$stylesheet = file_get_contents('../../public/css/reporte_maquinas.css'); // la ruta a tu css
$mpdf->SetHTMLHeader('<header><div class="header"><img class="logo" src="../../public/img/reporte_maquinas/Logo-Helisa.png" style="align:left; width:100px; height:50px;"></div></header>');
$mpdf->SetHTMLFooter('<h6>Este documento es propiedad intelectual de Proasistemas S.A y queda prohibida su reproducción total o parcial en cualquier medio. El otorgamiento de una copia a terceros deberá ser con autorización escrita de la gerencia o en su defecto el responsable de Proasistemas S.A.</h6><hr>{PAGENO}');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("reportes_maquinas.pdf", "D");
?>
    



