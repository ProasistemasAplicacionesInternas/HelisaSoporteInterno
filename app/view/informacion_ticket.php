<?php foreach ($listaConsulta as $datos): ?>
    <tr>
        <td>
            <span id="id_peticion<?php echo $datos->getId_peticionMai(); ?>">
                <?php echo $datos->getId_peticionMai(); ?>
            </span>
        </td>
        <!-- Resto de las columnas del ticket -->
        <td>
            <a href="vista_detallada.php?id=<?php echo $datos->getId_peticionMai(); ?>">Ver Detalles</a>
        </td>
    </tr>
<?php endforeach; ?>
