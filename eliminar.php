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

// Obtener la información de la chica mágica
$sql = "SELECT nombre FROM chicas_magicas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$chica = $resultado->fetch_assoc();

if (!$chica) {
    die("❌ Chica mágica no encontrada.");
}

// Si se confirma la eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
    $sql_delete = "DELETE FROM chicas_magicas WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
        echo "<script>alert('✅ Chica mágica eliminada con éxito'); window.location.href = 'Chicas.php';</script>";
        exit();
    } else {
        echo "<p style='color:red;'>❌ Error al eliminar.</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar Eliminación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            width: 50%;
            margin: auto;
            box-shadow: 0px 0px 10px #ccc;
            border-radius: 10px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
        }
        .confirmar {
            background-color: red;
            color: white;
            border: none;
        }
        .cancelar {
            background-color: gray;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>⚠️ Confirmar Eliminación</h1>
        <p>¿Estás seguro de que quieres eliminar a <strong><?php echo htmlspecialchars($chica['nombre']); ?></strong>?</p>
        <form method="POST">
            <input type="hidden" name="confirmar" value="1">
            <button type="submit" class="confirmar">Eliminar</button>
            <a href="Chicas.php"><button type="button" class="cancelar">Cancelar</button></a>
        </form>
    </div>
</body>
</html>
