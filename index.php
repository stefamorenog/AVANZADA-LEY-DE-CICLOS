<?php
session_start(); 
// Configuración de conexión a la base de datos

$host = "localhost";  
$user = "root";    
$password = "";  
$database = "leyciclos"; 
// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ley de los ciclos</title>
</head>
<body>
    <div>
        <h1>LEY DE LOS CICLOS</h1>
        <a href="Registro.php"><button>Registrar chica mágica</button></a>
        <a href="Chicas.php"><button>Ver chicas registradas</button></a>
    </div>
</body>
</html>
