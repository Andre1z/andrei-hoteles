<?php
require_once '../scripts/db_connection.php';

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Obtener la disponibilidad a través del botón de radio
    $availability = isset($_POST['availability']) ? $_POST['availability'] : 0;

    $sql = "INSERT INTO rooms (room_number, room_type, availability, price, description)
            VALUES (:room_number, :room_type, :availability, :price, :description)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':room_number', $room_number);
        $stmt->bindParam(':room_type', $room_type);
        $stmt->bindParam(':availability', $availability, PDO::PARAM_BOOL);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        echo "¡Habitación agregada exitosamente!";
    } catch (PDOException $e) {
        echo "Error al agregar habitación: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Habitación</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Agregar Habitación</h1>
    </header>
    <main>
        <form method="POST" action="add_room.php">
            <label for="room_number">Número de Habitación:</label>
            <input type="text" id="room_number" name="room_number" required>
            
            <label for="room_type">Tipo de Habitación:</label>
            <input type="text" id="room_type" name="room_type" required>
            
            <label for="price">Precio:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            
            <label for="description">Descripción:</label>
            <textarea id="description" name="description"></textarea>
            
            <div class="availability-container">
                <label>¿Disponible?</label>
                <div class="availability-options">
                    <input type="radio" id="available_yes" name="availability" value="1" checked>
                    <label for="available_yes">Sí</label>
                    <input type="radio" id="available_no" name="availability" value="0">
                    <label for="available_no">No</label>
                </div>
            </div>
            
            <button type="submit">Agregar Habitación</button>
        </form>
        <br>
        <a href="view_rooms.php">Volver a Ver Habitaciones</a>
    </main>
    <footer>
        <p>&copy; 2025 Gestión Hotelera</p>
    </footer>
</body>
</html>
