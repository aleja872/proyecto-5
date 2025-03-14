<?php
$host = "localhost";
$user = "root";  // Cambia esto si tienes otro usuario
$pass = "";  // Si tienes contraseña en MySQL, agrégala aquí
$db = "resto_cafe_la_tobogan";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
