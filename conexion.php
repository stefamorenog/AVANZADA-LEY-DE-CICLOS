<?php
session_start(); // Iniciar sesión

// Configuración de conexión a la base de datos
$host = "localhost";  // Servidor local
$user = "root";       // Usuario por defecto de MySQL en XAMPP
$password = "";       // Sin contraseña por defecto en XAMPP
$database = "leyciclos"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} 
?>



