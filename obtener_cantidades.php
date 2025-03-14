<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "restaurante");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nombre, cantidad FROM productos WHERE nombre IS NOT NULL";
$result = $conn->query($sql);

$cantidades = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cantidades[$row['nombre']] = intval($row['cantidad']);
    }
}

$conn->close();
echo json_encode($cantidades);
?>
