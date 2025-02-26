<?php
include 'conexion.php';
session_start();

// Verificar autenticación
/*if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}*/

// Verificar si el ID es válido
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ ID de chica mágica no válido.");
}

$id = $_GET['id'];

// Obtener información actual de la chica
$sql = "SELECT * FROM chicas_magicas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$chica = $resultado->fetch_assoc();

if (!$chica) {
    die("❌ Chica mágica no encontrada.");
}

$errores = [];

// Procesar la actualización si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $edad = $_POST["edad"];
    $ciudad_origen = trim($_POST["ciudad_origen"]);
    $estado_anterior = $chica['estado'];
    $estado_nuevo = $_POST["estado"];
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

    if (!in_array($estado_nuevo, ["activa", "desaparecida", "rescatada"])) {
        $errores[] = "❌ Estado inválido.";
    }

    if (empty($fecha_contrato)) {
        $errores[] = "❌ Debes seleccionar una fecha de contrato.";
    }

    // Si no hay errores, actualizar en la BD
    if (empty($errores)) {
        $sql_update = "UPDATE chicas_magicas SET nombre=?, edad=?, ciudad_origen=?, estado=?, fecha_contrato=? WHERE id=?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sisssi", $nombre, $edad, $ciudad_origen, $estado_nuevo, $fecha_contrato, $id);

        if ($stmt_update->execute()) {
            // Registrar cambio de estado si cambió
            if ($estado_anterior !== $estado_nuevo) {
                $sql_historial = "INSERT INTO historial_estados (chica_id, estado_anterior, estado_nuevo, fecha_cambio) VALUES (?, ?, ?, NOW())";
                $stmt_historial = $conn->prepare($sql_historial);
                $stmt_historial->bind_param("iss", $id, $estado_anterior, $estado_nuevo);
                $stmt_historial->execute();
            }
            echo "<script>alert('✅ Actualización exitosa'); window.location.href = 'perfil.php?id=$id';</script>";
            exit();
        } else {
            $errores[] = "❌ Error al actualizar.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Chica Mágica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            width: 60%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px #ccc;
            border-radius: 10px;
        }
        input, select {
            width: 90%;
            padding: 10px;
            margin: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        .confirmar { background: #007BFF; color: white; border: none; }
        .confirmar:hover { background: #0056b3; }
        .cancelar { background: red; color: white; border: none; }
        .cancelar:hover { background: darkred; }
    </style>
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
    <div class="container">
        <h1>Editar Información de <?php echo htmlspecialchars($chica['nombre']); ?></h1>

        <div id="mensajeError" style="color:red;">
            <?php if (!empty($errores)) echo implode("<br>", $errores); ?>
        </div>

        <form method="POST" onsubmit="return validarFormulario()">
            <label>Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($chica['nombre']); ?>" required>

            <label>Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo $chica['edad']; ?>" required>

            <label>Ciudad de Origen:</label>
            <input type="text" id="ciudad_origen" name="ciudad_origen" value="<?php echo htmlspecialchars($chica['ciudad_origen']); ?>" required>

            <label>Estado:</label>
            <select name="estado" id="estado">
                <option value="activa" <?php if ($chica['estado'] == "activa") echo "selected"; ?>>Activa</option>
                <option value="desaparecida" <?php if ($chica['estado'] == "desaparecida") echo "selected"; ?>>Desaparecida</option>
                <option value="rescatada" <?php if ($chica['estado'] == "rescatada") echo "selected"; ?>>Rescatada</option>
            </select>

            <label>Fecha de Contrato:</label>
            <input type="date" id="fecha_contrato" name="fecha_contrato" value="<?php echo $chica['fecha_contrato']; ?>" required>

            <button type="submit" class="confirmar">Actualizar</button>
            <a href="perfil.php?id=<?php echo $chica['id']; ?>"><button type="button" class="cancelar">Cancelar</button></a>
        </form>
    </div>
</body>
</html>
