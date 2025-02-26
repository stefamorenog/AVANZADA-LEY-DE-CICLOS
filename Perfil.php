<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Perfil de <?php echo htmlspecialchars($chica['nombre']); ?></title>
</head>
<body>
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
        <h1>Perfil de las chicas magicas</h1>
    </div>
    <?php
include 'conexion.php';
session_start();

// Verificar autenticación
/*if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}*/

// Verificar si el ID de la chica es válido
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("❌ ID de chica mágica no válido.");
}

$id = $_GET['id'];

// Obtener información de la chica mágica
$sql = "SELECT * FROM chicas_magicas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$chica = $resultado->fetch_assoc();

if (!$chica) {
    die("❌ Chica mágica no encontrada.");
}

// Obtener historial de cambios de estado de esta chica
$sql_historial = "SELECT estado_anterior, estado_nuevo, fecha_cambio FROM historial_estados WHERE chica_id = ? ORDER BY fecha_cambio DESC";
$stmt_historial = $conn->prepare($sql_historial);
$stmt_historial->bind_param("i", $id);
$stmt_historial->execute();
$resultado_historial = $stmt_historial->get_result();
?>


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
        table {
            width: 100%;
            margin: 10px auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .estado-anterior {
            color: red;
        }
        .estado-nuevo {
            color: green;
        }
        .boton {
            background: #17a2b8;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
        }
        .boton:hover {
            background: #138496;
        }
        .editar { background: orange; }
        .eliminar { background: red; }
        .eliminar:hover { background: darkred; }
    </style>

    <div class="container">
        <h1>Perfil de <?php echo htmlspecialchars($chica['nombre']); ?></h1>
        <p><strong>Edad:</strong> <?php echo $chica['edad']; ?></p>
        <p><strong>Ciudad de Origen:</strong> <?php echo htmlspecialchars($chica['ciudad_origen']); ?></p>
        <p><strong>Estado Actual:</strong> <span class="estado-nuevo"><?php echo $chica['estado']; ?></span></p>
        <p><strong>Fecha de Contrato:</strong> <?php echo $chica['fecha_contrato']; ?></p>

        <a href="editar.php?id=<?php echo $chica['id']; ?>">
            <button class="boton editar">Editar Información</button>
        </a>
        <a href="eliminar.php?id=<?php echo $chica['id']; ?>" onclick="return confirm('⚠️ ¿Seguro que deseas eliminar a esta chica mágica?');">
            <button class="boton eliminar">Eliminar</button>
        </a>
        <a href="Chicas.php"><button class="boton">Volver</button></a>

        <h2>Historial de Cambios de Estado</h2>
        <table>
            <thead>
                <tr>
                    <th>Estado Anterior</th>
                    <th>Estado Nuevo</th>
                    <th>Fecha de Cambio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado_historial->num_rows > 0) {
                    while ($fila = $resultado_historial->fetch_assoc()) {
                        echo "<tr>
                                <td class='estado-anterior'>{$fila['estado_anterior']}</td>
                                <td class='estado-nuevo'>{$fila['estado_nuevo']}</td>
                                <td>{$fila['fecha_cambio']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay cambios registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


<?php
$conn->close();
?>
</body>
</html>