<?php
include 'Conexion.php'; // Asegúrate de que la conexión es correcta
session_start();

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las claves existen en $_POST antes de usarlas
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $edad = isset($_POST["edad"]) ? (int) $_POST["edad"] : 0;
    $ciudad_origen = isset($_POST["ciudad_origen"]) ? trim($_POST["ciudad_origen"]) : "";
    $estado = isset($_POST["estado"]) ? $_POST["estado"] : "";
    $fecha_contrato = isset($_POST["fecha_contrato"]) ? $_POST["fecha_contrato"] : "";

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

    // Si no hay errores, registrar en la base de datos
    if (empty($errores)) {
        $sql = "INSERT INTO chicas_magicas (nombre, edad, ciudad_origen, estado, fecha_contrato) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisss", $nombre, $edad, $ciudad_origen, $estado, $fecha_contrato);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Registro exitoso'); window.location.href = 'Registro.php';</script>";
            exit();
        } else {
            $errores[] = "❌ Error al registrar: " . $stmt->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro de Chicas Mágicas</title>
</head>
<body>

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

<div class="container-fluid">
<nav class="navbar navbar-expand-lg bg-warning">
        <div class="container-fluid">
        <a class="navbar-brand  text-white" href="Index.php"><h2>LEY DE LOS CICLOS</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="Registro.php"><h4>Registro</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="Chicas.php"><h4>Todas</h4></a>
        </li>
      </ul>
    </div>
    </div>
        </nav>

    <div id="mensajeError" style="color:red;"></div>

    <form class="form-control p-3 mb-5 bg-light" action="Registro.php" method="POST" onsubmit="return validarFormulario()">  
        <h1 class="p-4">Registro de Chicas Mágicas</h1>

        <div class="form-floating">
            <input class="form-control mb-3" type="text" id="nombre" name="nombre" required>
            <label for="nombre">Nombre Chica Mágica</label>
        </div>

        <div class="form-floating">
            <input class="form-control mb-3" type="number" name="edad" id="edad" min="10" max="25" required>
            <label for="edad">Edad Chica Mágica</label>
        </div>

        <div class="form-floating">
            <input class="form-control mb-3" type="text" id="ciudad_origen" name="ciudad_origen" required>
            <label for="ciudad_origen">Ciudad de Origen</label>
        </div>

        
      <div class="row g-2 p2">
          <div class="col-md">
        <div class="form-floating">
            <select class="form-select" name="estado" id="estado" required>
                <option value="activa">Activa</option>
                <option value="desaparecida">Desaparecida</option>
                <option value="rescatada">Rescatada por la ley de los ciclos</option>
            </select>
            <label for="estado">Estado</label>
        </div>
</div>

        <div class="col-md">
        <div class="form-floating">
            <input class="form-control mb-3" type="date" name="fecha_contrato" id="fecha_contrato" required>
            <label for="fecha_contrato">Fecha de Contrato</label>
        </div>
</div>
        <input type="submit" value="Registrar" class="btn btn-primary">
    </form>
</div>

</body>
</html>
