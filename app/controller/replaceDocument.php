<?php
require_once('../model/vinculo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $archivo = $_POST['archivo'] ?? null;
    $ticketId = $_POST['ticket_id'] ?? null;
    $nuevoArchivo = $_FILES['nuevoArchivo'] ?? null;
    $columnaArchivo = $_POST['columna_archivo'] ?? null;

    if ($archivo && $ticketId && $nuevoArchivo && $columnaArchivo) {
        $uploadDir = __DIR__ . '/../../documentSg/';
        $filePath = $uploadDir . $archivo;
        unlink($filePath);
        $nuevoNombreArchivo = $nuevoArchivo['name'];
        $nuevoFilePath = $uploadDir . $nuevoNombreArchivo;

        move_uploaded_file($nuevoArchivo['tmp_name'], $nuevoFilePath);
        header('Content-Type: application/json');  
        try {
            $db = Conectar::acceso();
            
            $query = "UPDATE peticiones_sg SET $columnaArchivo = :nuevoArchivo WHERE id_peticionessg = :ticket_id";
            
            $stmt = $db->prepare($query);
            
            $stmt->bindValue(':nuevoArchivo', $nuevoNombreArchivo, PDO::PARAM_STR);
            $stmt->bindValue(':ticket_id', $ticketId, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error en la conexión: ' . $e->getMessage()]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error inesperado: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el archivo antiguo.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
