<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tienes otro usuario en MySQL
$password = "";  // Cambia esto si tienes una contraseña configurada
$dbname = "restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>



