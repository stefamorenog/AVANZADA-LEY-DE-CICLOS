<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro de chicas</title>
</head>
<body>
<?php
include 'Conexion.php';
session_start();

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
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="Index.php"><h2>LEY DE LOS CICLOS</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="Perfil.php"><h4>Perfiles</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Registro.php"><h4>Registro</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Chicas.php"><h4>Todas</h4></a>
        </li>
      </ul>
    </div>
    </div>
        </nav>  
        <h1>Registro de chicas magicas</h1>
        <form action="">
            <div class="form-floating">
            <input class="form-control" type="text" id="nombre" placeholder="Nombre">
            <label class="form-label" for="nombre">Nombre Chica Magica</label>
            </div>

            <div class="form-floating">
            <input class="form-control" type="text" id="edad" placeholder="Edad">
            <label class="form-label" for="edad">Edad Chica Magica</label>
            </div>
            
            <label class="form-label" for="ciudad">Ciudad Chica Magica</label>
            <input class="form-control" type="text" id="ciudad" placeholder="Ciudad origen">
            
            <label class="form-label" for="estado">Estados</label>
            <select class="form-select" name="estado" id="estado">
                <option value="1">Activa</option>
                <option value="2">Desaparecida</option>
                <option value="3">Rescatada por la ley de los ciclos</option>
            </select>
           
            <label class="form-label" for="contrato">Fecha de contrato Chica Magica</label>
            <input class="form-control" type="date" id="contrato" min="2025-02-23">
            <a class="btn btn-outline-success me-2" type="button" href="Registro.php">Registrar chica magica!</a>
        </form> 
   
       
       
    </div>
</body>
</html>