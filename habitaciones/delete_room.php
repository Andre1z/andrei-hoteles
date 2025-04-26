<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

// Incluir conexión a la base de datos
require_once '../scripts/db_connection.php';

// Verificar si se proporciona un ID de habitación
if (isset($_GET['room_id']) && is_numeric($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    // Eliminar la habitación de la base de datos
    $sql = "DELETE FROM rooms WHERE room_id = :room_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);

    try {
        if ($stmt->execute()) {
            header("Location: view_rooms.php?message=Habitación eliminada con éxito");
            exit;
        } else {
            header("Location: view_rooms.php?error=Error al eliminar la habitación");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: view_rooms.php?error=Error al eliminar la habitación: {$e->getMessage()}");
        exit;
    }
} else {
    header("Location: view_rooms.php?error=ID de habitación no válido");
    exit;
}
?>
