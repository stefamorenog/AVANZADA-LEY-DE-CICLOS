<?php
// Iniciar sesión (si se usa en otros archivos)
//session_start();

// Configuración de conexión a la base de datos
$host = "localhost";  // Servidor de MySQL en XAMPP
$user = "root";       // Usuario por defecto de MySQL en XAMPP
$password = "";       // Sin contraseña por defecto en XAMPP
$database = "leyciclos"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

?>