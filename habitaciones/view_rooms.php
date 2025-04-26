<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

// Incluir conexión a la base de datos
require_once '../scripts/db_connection.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Habitaciones</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Lista de Habitaciones</h1>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Disponible</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM rooms";
                try {
                    $stmt = $conn->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Clase condicional para resaltar habitaciones no disponibles
                        $row_class = $row['availability'] ? '' : 'not-available';

                        echo "<tr class='$row_class'>
                            <td>{$row['room_id']}</td>
                            <td>{$row['room_number']}</td>
                            <td>{$row['room_type']}</td>
                            <td>" . ($row['availability'] ? 'Sí' : 'No') . "</td>
                            <td>{$row['price']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='edit_room.php?room_id={$row['room_id']}' class='action-button'>Editar</a>
                                <a href='../rooms/delete_room.php?room_id={$row['room_id']}' class='action-button delete-button' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta habitación?\");'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='8'>Error al obtener habitaciones: {$e->getMessage()}</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="../index.php">Volver a Inicio</a>
    </main>
    <footer>
        <p>&copy; 2025 Gestión Hotelera | <a href="../logout.php">Cerrar Sesión</a></p>
    </footer>
</body>
</html>