<?php
session_start(); // Iniciar la sesión

// Incluir archivo de conexión a la base de datos
include('db.php');

// Comprobar si los datos fueron enviados desde el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Consultar la base de datos para verificar si el usuario existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    // Verificar si el usuario existe
    if ($stmt->rowCount() > 0) {
        // Obtener los datos del usuario
        $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña (suponiendo que se guardan las contraseñas con hash)
        if (password_verify($contraseña, $usuario_db['contraseña'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['usuario_id'] = $usuario_db['id'];
            $_SESSION['usuario'] = $usuario_db['usuario'];

            // Redirigir a la página principal o a un área protegida
            header("Location: dashboard.php"); // Cambia esto según tu página de destino
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado.";
    }
} else {
    echo "Método no permitido.";
}
?>

