<?php
include 'conexion.php';
session_start();

// Verificar autenticación
/*if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}*/

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $edad = $_POST["edad"];
    $ciudad_origen = trim($_POST["ciudad_origen"]);
    $estado = $_POST["estado"];
    $fecha_contrato = $_POST["fecha_contrato"];

    // Validaciones en el backend
    if (empty($nombre) || strlen($nombre) < 3) {
        $errores[] = "❌ El nombre debe tener al menos 3 caracteres.";
    }

    if (!is_numeric($edad) || $edad < 10 || $edad > 25) {
        $errores[] = "❌ La edad debe ser un número entre 10 y 25 años.";
    }

    if (empty($ciudad_origen) || strlen($ciudad_origen) < 3) {
        $errores[] = "❌ La ciudad de origen debe tener al menos 3 caracteres.";
    }

    if (!in_array($estado, ["activa", "desaparecida", "rescatada"])) {
        $errores[] = "❌ Estado inválido.";
    }

    if (empty($fecha_contrato)) {
        $errores[] = "❌ Debes seleccionar una fecha de contrato.";
    }

    if (empty($errores)) {
        $sql = "INSERT INTO chicas_magicas (nombre, edad, ciudad_origen, estado, fecha_contrato) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisss", $nombre, $edad, $ciudad_origen, $estado, $fecha_contrato);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Registro exitoso'); window.location.href = 'Registro.php';</script>";
            exit();
        } else {
            $errores[] = "❌ Error al registrar.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Chicas Mágicas</title>
    <script>
        function validarFormulario() {
            let nombre = document.getElementById("nombre").value.trim();
            let edad = document.getElementById("edad").value;
            let ciudad = document.getElementById("ciudad_origen").value.trim();
            let fecha = document.getElementById("fecha_contrato").value;
            let errores = "";

            if (nombre.length < 3) {
                errores += "❌ El nombre debe tener al menos 3 caracteres.<br>";
            }

            if (edad < 10 || edad > 25 || isNaN(edad)) {
                errores += "❌ La edad debe ser un número entre 10 y 25 años.<br>";
            }

            if (ciudad.length < 3) {
                errores += "❌ La ciudad de origen debe tener al menos 3 caracteres.<br>";
            }

            if (fecha === "") {
                errores += "❌ Debes seleccionar una fecha de contrato.<br>";
            }

            if (errores !== "") {
                document.getElementById("mensajeError").innerHTML = errores;
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h1>Registro de Chicas Mágicas</h1>

    <div id="mensajeError" style="color:red;"></div>

    <form action="Registro.php" method="POST" onsubmit="return validarFormulario()">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
        <input type="number" id="edad" name="edad" placeholder="Edad" required>
        <input type="text" id="ciudad_origen" name="ciudad_origen" placeholder="Ciudad de Origen" required><br>
        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <option value="activa">Activa</option>
            <option value="desaparecida">Desaparecida</option>
            <option value="rescatada">Rescatada</option>
        </select><br>
        <label for="fecha_contrato">Fecha de contrato:</label>
        <input type="date" id="fecha_contrato" name="fecha_contrato" required><br>  
        <input type="submit" value="Registrar">
    </form>
    <a href="index.php"><button>Página de Inicio</button></a>
</body>
</html>
