<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

// Incluir conexión a la base de datos
require_once '../scripts/db_connection.php';

// Inicializar $room como un array vacío
$room = [];

// Verificar si `room_id` está definido en la URL
if (isset($_GET['room_id']) && !empty($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    // Consultar la habitación en la base de datos
    $sql = "SELECT * FROM rooms WHERE room_id = :room_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
    $stmt->execute();
    $room = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si la habitación existe
    if (!$room) {
        $error_message = "Habitación no encontrada.";
    }
} else {
    $error_message = "ID de habitación inválido.";
}

// Manejar la actualización del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($room)) { // Solo permitir actualizaciones si la habitación existe
        $room_number = $_POST['room_number'];
        $room_type = $_POST['room_type'];
        $availability = isset($_POST['availability']) ? $_POST['availability'] : 0;
        $price = $_POST['price'];
        $description = $_POST['description'];

        $sql = "UPDATE rooms 
                SET room_number = :room_number, 
                    room_type = :room_type, 
                    availability = :availability, 
                    price = :price, 
                    description = :description 
                WHERE room_id = :room_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':room_number', $room_number);
        $stmt->bindParam(':room_type', $room_type);
        $stmt->bindParam(':availability', $availability, PDO::PARAM_BOOL);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "¡Habitación actualizada con éxito!";
        } else {
            echo "Error al actualizar la habitación.";
        }
    } else {
        echo "No se puede actualizar una habitación inexistente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Habitación</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
    <script>
        // Función para guardar valores en local storage
        function saveToLocalStorage() {
            const roomNumber = document.getElementById("room_number").value;
            const roomType = document.getElementById("room_type").value;
            const price = document.getElementById("price").value;
            const description = document.getElementById("description").value;
            const availability = document.querySelector('input[name="availability"]:checked').value;

            localStorage.setItem("room_number", roomNumber);
            localStorage.setItem("room_type", roomType);
            localStorage.setItem("price", price);
            localStorage.setItem("description", description);
            localStorage.setItem("availability", availability);
        }

        // Función para cargar valores desde local storage
        function loadFromLocalStorage() {
            if (localStorage.getItem("room_number")) {
                document.getElementById("room_number").value = localStorage.getItem("room_number");
            }
            if (localStorage.getItem("room_type")) {
                document.getElementById("room_type").value = localStorage.getItem("room_type");
            }
            if (localStorage.getItem("price")) {
                document.getElementById("price").value = localStorage.getItem("price");
            }
            if (localStorage.getItem("description")) {
                document.getElementById("description").value = localStorage.getItem("description");
            }
            if (localStorage.getItem("availability")) {
                const availability = localStorage.getItem("availability");
                document.getElementById(availability === "1" ? "available_yes" : "available_no").checked = true;
            }
        }

        // Función para limpiar el local storage
        function clearLocalStorage() {
            localStorage.removeItem("room_number");
            localStorage.removeItem("room_type");
            localStorage.removeItem("price");
            localStorage.removeItem("description");
            localStorage.removeItem("availability");
        }

        // Cargar los valores cuando la página se carga
        document.addEventListener("DOMContentLoaded", loadFromLocalStorage);
    </script>
</head>
<body>
    <header>
        <h1>Editar Habitación</h1>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </header>
    <main>
        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php else : ?>
            <form method="POST" oninput="saveToLocalStorage()" onsubmit="clearLocalStorage()">
                <label for="room_number">Número de Habitación:</label>
                <input type="text" id="room_number" name="room_number" value="<?php echo $room['room_number']; ?>" required>

                <label for="room_type">Tipo de Habitación:</label>
                <input type="text" id="room_type" name="room_type" value="<?php echo $room['room_type']; ?>" required>

                <label for="price">Precio:</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo $room['price']; ?>" required>

                <label for="description">Descripción:</label>
                <textarea id="description" name="description"><?php echo $room['description']; ?></textarea>

                <div class="availability-container">
                    <label>¿Disponible?</label>
                    <div class="availability-options">
                        <input type="radio" id="available_yes" name="availability" value="1" <?php echo $room['availability'] == 1 ? 'checked' : ''; ?>>
                        <label for="available_yes">Sí</label>
                        <input type="radio" id="available_no" name="availability" value="0" <?php echo $room['availability'] == 0 ? 'checked' : ''; ?>>
                        <label for="available_no">No</label>
                    </div>
                </div>

                <button type="submit">Actualizar Habitación</button>
            </form>
        <?php endif; ?>
        <br>
        <a href="view_rooms.php">Volver a Ver Habitaciones</a>
    </main>
    <footer>
        <p>&copy; 2025 Gestión Hotelera | <a href="../logout.php">Cerrar Sesión</a></p>
    </footer>
</body>
</html>