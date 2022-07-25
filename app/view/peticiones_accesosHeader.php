<div class="mt-4">
        <ul class="nav nav-tabs">

        <?php if((isset($consultaMai)) && ($consultaMai == 0)):?>
        <li class="nav-item">
            <a class="nav-link navH <?php if($consultar == 1){echo 'active';}?>" href="#" onclick="redireccionar(1);">Mis Peticiones</a>
        </li>
        <?php endif;?>

        <?php if((isset($cargoAprobar) && ($cargoAprobar == 1 || $cargoAprobar == 2))  || ((isset($consultaMai)) && ($consultaMai == 1))):?>
        <li class="nav-item"> 
            <a class="nav-link navH <?php if($consultar == 2){echo 'active';}?>" href="#" onclick="redireccionar(2);">Peticiones Delegadas</a>
        </li>
        <?php endif;?>

        <?php if((isset($adminPlataforma) && $adminPlataforma  == 1) || ((isset($consultaMai)) && ($consultaMai == 1))):?>
        <li class="nav-item">
            <a class="nav-link navH <?php if($consultar == 3){echo 'active';}?>" href="#" onclick="redireccionar(3)">Soporte de Accesos</a>
        </li>
        <?php endif;?>

        <li class="nav-item">
            <a class="nav-link navH <?php if($consultar == 4){echo 'active';}?>" href="#" onclick="redireccionar(4)">Consulta</a>
        </li>
        
        </ul>
</div>