<?php
session_start(); // Iniciar la sesión

// Destruir todos los datos de la sesión
session_destroy();

// Redirigir al formulario de inicio de sesión
header("Location: login.php");
exit;
?>