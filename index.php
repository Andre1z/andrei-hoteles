<?php
// Incluir conexión a la base de datos
require_once 'scripts/db_connection.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Habitaciones</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="icon" href="assets/logo.png" type="image/x-icon">
</head>
<body>
    <header>
        <img src="assets/logo.png" alt="Logo"><h1>Andrei | Gestion de Habitaciones</h1>
    </header>
    <nav>
        <ul>
            <li><a href="habitaciones/view_rooms.php">Ver Habitaciones</a></li>
            <li><a href="habitaciones/add_room.php">Agregar Habitación</a></li>
        </ul>
    </nav>
    <main>
        <h2>Bienvenido a la Gestión de Habitaciones</h2>
        <p>Selecciona una opción en el menú.</p>
        <img src="assets\imagen.webp" alt="">
    </main>
    <footer>
        <p>&copy; 2025 Gestión Hotelera</p>
    </footer>
</body>
</html>