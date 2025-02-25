<?php
include 'conexion.php';
session_start();

// Verificar autenticación
/*if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}*/

// Obtener historial de cambios de estado
$sql = "SELECT cm.nombre, he.estado_anterior, he.estado_nuevo, he.fecha_cambio 
        FROM historial_estados he
        JOIN chicas_magicas cm ON he.chica_id = cm.id
        ORDER BY he.fecha_cambio DESC";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Cambios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        table {
            width: 80%;
            margin: 20px auto;
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
        a button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        a button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <h1>Historial de Cambios de Estado</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado Anterior</th>
                <th>Estado Nuevo</th>
                <th>Fecha de Cambio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>
                            <td>{$fila['nombre']}</td>
                            <td class='estado-anterior'>{$fila['estado_anterior']}</td>
                            <td class='estado-nuevo'>{$fila['estado_nuevo']}</td>
                            <td>{$fila['fecha_cambio']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay cambios registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index.php"><button>Regresar</button></a>
</body>
</html>

<?php
$conn->close();
?>
