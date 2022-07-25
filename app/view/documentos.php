<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Helisa | Soporte Infraestructura</title>
    <link rel="stylesheet" href="../../public/css/contenido.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="../../public/css/datatables.min.css" />
    <link rel="stylesheet" href="../../public/css/smoke.min.css">

</head>

<body>

    <?php
       ini_set("session.cookie_lifetime",18000);
       ini_set("session.gc_maxlifetime",18000);

       session_start();
   
       if(!isset($_SESSION['usuario'])){
       
       header('location:../../login.php');
       }   
       require('../controller/controlador_documentos.php');
    ?>



    <script src="../../public/js/jquery-3.3.1.min.js"></script>
    <script src="../../public/js/smoke.min.js"></script>
    <script src="../../public/js/datatables.min.js"></script>
    <script src="../../public/js/tablas.js"></script>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>

</html>