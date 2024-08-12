<?php
if (isset($_GET['imagen'])) {
    $imagen = $_GET['imagen'];
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '../../pruebasubir/' . $imagen;

    if (file_exists($filePath)) {
        // Dependiendo del tipo de archivo, ajusta el encabezado para mostrar correctamente
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        switch (strtolower($fileExtension)) {
            case 'pdf':
                header('Content-Type: application/pdf');
                break;
            case 'doc':
            case 'docx':
                header('Content-Type: application/msword');
                break;
            case 'xls':
            case 'xlsx':
                header('Content-Type: application/vnd.ms-excel');
                break;
            default:
                header('Content-Type: application/octet-stream');
                break;
        }
        header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
        readfile($filePath);
    } else {
        echo "<p>El documento no está disponible.</p>";
    }
} else {
    echo "<p>No se ha especificado ningún archivo para mostrar.</p>";
}
?>
