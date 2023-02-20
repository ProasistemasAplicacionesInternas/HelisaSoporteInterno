<?php /* ---- Archivo que sirve para el redireccionamiento entre las pestañas de Organigrama ---- */
    session_start();

    if(isset($_POST['setRedireccionamiento'])){
        $_SESSION['redireccionamiento'] = $_POST['numRedireccionamiento'];
        echo $_SESSION['redireccionamiento'];
    }

?>