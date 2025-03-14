<?php
$host = 'localhost';  // o la dirección de tu servidor
$usuario = 'root';    // tu usuario de MySQL
$contraseña = '';     // tu contraseña de MySQL
$nombre_base_datos = 'mi_base_de_datos';  // el nombre de tu base de datos

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_base_datos", $usuario, $contraseña);
    // Configurar el modo de error de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}


$contraseña = "miContraseñaSegura"; // La contraseña ingresada por el usuario
$hash_contraseña = password_hash($contraseña, PASSWORD_BCRYPT);

// Luego, guardar en la base de datos
$stmt = $pdo->prepare("INSERT INTO usuarios (usuario, contraseña) VALUES (:usuario, :contraseña)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contraseña', $hash_contraseña);
$stmt->execute();


session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirige si no está logueado
    exit();
}

?>
