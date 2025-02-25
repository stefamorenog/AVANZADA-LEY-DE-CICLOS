<?php
include 'conexion.php';
session_start();

// Si el usuario ya está autenticado, redirigir al dashboard
if (isset($_SESSION["usuario"])) {
    header("Location: Chicas.php");
    exit();
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Buscar el usuario en la base de datos
    $sql = "SELECT id, nombre, contrasena, rol FROM guardianes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña con password_verify()
        if (password_verify($password, $usuario["contrasena"])) {
            $_SESSION["usuario"] = $usuario["nombre"];
            $_SESSION["id_usuario"] = $usuario["id"];
            $_SESSION["rol"] = $usuario["rol"];
            header("Location: index.php");
            exit();
        }
    }
    $error = "❌ Usuario o contraseña incorrectos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Inicio de Sesión</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Correo electrónico" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>
