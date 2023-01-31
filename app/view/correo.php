<?php 
  $peticion =$_GET['peticion'];
?>
<!DOCTYPE html>
<html lang="es">
<style type="text/css"> 

    #uno,#dos,#tres,#cuatro,#cinco {
        width: 60px !important;
        height: 62px !important;
        border-radius: 50% !important;
        background: #ffffff !important;
        border: 1px solid #000 !important;
        color: #000 !important; 
        text-align: center !important;
        font-weight: bold !important;
        
    }

    #uno:hover,#dos:hover,#tres:hover,#cuatro:hover,#cinco:hover {
        background: #f52db0 !important;
    } 
</style>
<body>    
    <div class="container-fluid">
        <div class="row">                                        
            <?php echo '<a href="https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=1&peticion='.$peticion.'"><input type="submit" id="uno" value="1"></a>' ?>
            <?php echo '<a href="https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=2&peticion='.$peticion.'"><input type="submit" id="dos" value="2"></a>' ?>
            <?php echo '<a href="https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=3&peticion='.$peticion.'"><input type="submit" id="tres" value="3"></a>' ?>
            <?php echo '<a href="https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=4&peticion='.$peticion.'"><input type="submit" id="cuatro" value="4"></a>'?>
            <?php echo '<a href="https://soporteinfraestructura.helisa.com/infraestructura/app/controller/controlador_peticion.php?encuesta=encuesta&nro=5&peticion='.$peticion.'"><input type="submit" id="cinco" value="5"></a>' ?>
        </div>
    </div>
    <script src="../../public/js/bloqueoTeclas.js"></script>
</body>
</html>
