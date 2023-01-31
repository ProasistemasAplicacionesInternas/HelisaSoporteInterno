<?php
session_start();


echo $_SESSION['start'] = time();
require "Authenticator.php";

$Authenticator = new Authenticator();

$checkResult = $Authenticator->verifyCode($_SESSION['auth_secretF'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance, ESTO DEVUELVE FALSE O TRUE DEPENDENDO DE LA FUNCION

if ((!$checkResult) && ($_POST['noQR'] ==1) ) {
    $_SESSION['failed'] = true;
    header('location: validacionCodigoFuncionarios.php');

} else if((!$checkResult) && (!$_POST['noQR'] ==1) ) {
    $_SESSION['failed'] = true;
    header('location: validacionGoogleFuncionarios.php');

}else if(($checkResult)&&(isset($_POST['noQR']))&&($_POST['noQR'] ==1)){
    header('location: ../../dashboard_funcionarios.php');
}else if($checkResult && !isset($_POST['noQR'])){
    $_SESSION['code'] = 1;
    require_once('../controller/control_codigos.php');
    header('location: ../../dashboard_funcionarios.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Autenticación Satisfactoria </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <meta name="description" content="Implement Google like Time-Based Authentication into your existing PHP application. And learn How to Build it? How it Works? and Why is it Necessary these days."/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel='shortcut icon' href='/favicon.ico'  />
</head>
<body  class="bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3"  style="background: white; padding: 20px; box-shadow: 10px 10px 5px #888888; margin-top: 100px;">
                <hr>
                    <div style="text-align: center;">
                           <h1>Autenticaci&oacute;n completa</h1>
                           <p>Redireccionando a p&aacute;gina principal</p>
                    </div>
                <hr>    
            </div>
        </div>
    </div>
</body>
</html>