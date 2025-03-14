<?php
header("Content-Type: application/json");
$host = "localhost";
$user = "root";  // Cambia esto si tu usuario es diferente
$password = "";  // Si tienes contraseña en MySQL, ponla aquí
$dbname = "restaurante";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

$result = $conn->query("SELECT nombre, cantidad, precio FROM productos");
$productos = [];

while ($row = $result->fetch_assoc()) {
    $row['disponible'] = ($row['cantidad'] > 0) ? "Disponible" : "No disponible";
    $productos[] = $row;
}

echo json_encode($productos);
$conn->close();
?>
