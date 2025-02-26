<?php
include 'conexion.php';
session_start();

// Verificar autenticación
/*if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}*/

// Obtener el estado seleccionado en el filtro (si existe)
$estado_filtrado = isset($_GET['estado']) ? $_GET['estado'] : "";

// Modificar la consulta para filtrar por estado si se ha seleccionado uno
if (!empty($estado_filtrado)) {
    $sql = "SELECT * FROM chicas_magicas WHERE estado = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $estado_filtrado);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $sql = "SELECT * FROM chicas_magicas";
    $resultado = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Chicas Mágicas</title>
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
        .estado-activa { color: green; }
        .estado-desaparecida { color: orange; }
        .estado-rescatada { color: red; }
        button {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        .ver-perfil { background: #17a2b8; color: white; }
        .eliminar { background: red; color: white; }
        .historial { background: purple; color: white; }
        .ver-perfil:hover { background: #138496; }
        .eliminar:hover { background: darkred; }
        .historial:hover { background: darkmagenta; }
        select, input[type="submit"] {
            padding: 8px;
            font-size: 14px;
        }
    </style>
    <script>
        function confirmarEliminacion(id) {
            let confirmar = confirm("⚠️ ¿Estás seguro de que quieres eliminar a esta chica mágica?");
            if (confirmar) {
                window.location.href = "eliminar.php?id=" + id;
            }
        }
    </script>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <h1 class="p-4 justify-content-center">Chicas Mágicas Registradas</h1>

    <!-- FORMULARIO PARA FILTRAR POR ESTADO -->
    <form method="GET" action="Chicas.php">
        <label class="p-2 justify-content-center" for="estado">Filtrar por estado:</label>
        <select name="estado">
            <option value="">Todos</option>
            <option value="activa" <?php if ($estado_filtrado == "activa") echo "selected"; ?>>Activa</option>
            <option value="desaparecida" <?php if ($estado_filtrado == "desaparecida") echo "selected"; ?>>Desaparecida</option>
            <option value="rescatada" <?php if ($estado_filtrado == "rescatada") echo "selected"; ?>>Rescatada</option>
        </select>
        <input type="submit" value="Filtrar">
    </form>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Ciudad</th>
                <th>Fecha de Contrato</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    // Asignar clase de color al estado
                    $estado_class = "estado-" . strtolower($fila['estado']);

                    echo "<tr>
                            <td>{$fila['nombre']}</td>
                            <td>{$fila['edad']}</td>
                            <td>{$fila['ciudad_origen']}</td>
                            <td>{$fila['fecha_contrato']}</td>
                            <td class='$estado_class'>{$fila['estado']}</td>
                            <td>
                                <a href='perfil.php?id={$fila['id']}'>
                                    <button class='ver-perfil'>Ver Perfil</button>
                                </a>
                                <a href='#' onclick='confirmarEliminacion({$fila['id']})'>
                                    <button class='eliminar'>Eliminar</button>
                                </a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay chicas mágicas registradas con este estado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- BOTÓN PARA VER HISTORIAL -->
    <a href="historial.php"><button class="historial">Ver Historial de Cambios</button></a>
    <a href="index.php"><button>Regresar</button></a>

</body>
</html>
