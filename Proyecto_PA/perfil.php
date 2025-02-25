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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?php echo htmlspecialchars($chica['nombre']); ?></title>
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
</head>
<body>
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
</body>
</html>

<?php
$conn->close();
?>
