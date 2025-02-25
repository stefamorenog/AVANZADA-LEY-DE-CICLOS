<?php
session_start();

// Mostrar errores en pantalla (para depuración)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "leyciclos";

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("<p style='color: red;'>❌ Error de conexión: " . $conn->connect_error . "</p>");
} 

// Mensaje de respuesta
$mensaje = "";

// Procesar formulario cuando se envíen datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $edad = isset($_POST["edad"]) ? intval($_POST["edad"]) : 0;
    $ciudad_origen = isset($_POST["ciudad_origen"]) && $_POST["ciudad_origen"] !== "" ? trim($_POST["ciudad_origen"]) : NULL;
    $estado = isset($_POST["estado"]) ? $_POST["estado"] : "";
    $fecha_contrato = isset($_POST["fecha_contrato"]) ? $_POST["fecha_contrato"] : "";

    // Verificar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && $edad > 0 && !empty($estado) && !empty($fecha_contrato)) {
        // Insertar datos usando prepared statements
        $stmt = $conn->prepare("INSERT INTO chicas_magicas (nombre, edad, ciudad_origen, estado, fecha_contrato) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $nombre, $edad, $ciudad_origen, $estado, $fecha_contrato);

        if ($stmt->execute()) {
            // Redirigir después del registro exitoso para evitar reenvío del formulario
            $_SESSION['mensaje'] = "✅ Registro exitoso.";
            header("Location: registro.php");
            exit();
        } else {
            $mensaje = "<p style='color: red;'>❌ Error al registrar: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        $mensaje = "<p style='color: orange;'>⚠️ Todos los campos obligatorios deben llenarse</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Chicas Mágicas</title>
</head>
<body>
    <h2>Registro de Chicas Mágicas</h2>

    <?php
    // Mostrar mensaje si existe
    if (isset($_SESSION['mensaje'])) {
        echo "<p style='color: green;'>" . $_SESSION['mensaje'] . "</p>";
        unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
    }
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    ?>

    <form action="registro.php" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br>

        <label>Edad:</label>
        <input type="number" name="edad" required>
        <br>

        <label>Ciudad de origen:</label>
        <input type="text" name="ciudad_origen">
        <br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="activa">Activa</option>
            <option value="desaparecida">Desaparecida</option>
            <option value="rescatada">Rescatada</option>
        </select>
        <br>

        <label>Fecha de contrato:</label>
        <input type="date" name="fecha_contrato" required>
        <br>

        <button type="submit">Registrar</button>
    </form>

</body>
</html>

