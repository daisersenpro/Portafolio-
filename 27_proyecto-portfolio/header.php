<?php
// Inicia la sesión
session_start();

// Verifica si el usuario no ha iniciado sesión como "developer"
if (isset($_SESSION['usuario']) != "developer") {
    // Redirecciona al usuario al formulario de inicio de sesión (login.php)
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <!-- Incluye el CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <!-- Barra de navegación -->
        <nav>
            <a href="index.php">Inicio</a> |
            <a href="galeria.php">Galería</a> |
            <a href="cerrar.php">Cerrar</a>
        </nav>