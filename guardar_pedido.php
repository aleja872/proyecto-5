<?php
include "conexion.php";  // Incluir la conexión a la base de datos

// Recibir los datos del formulario
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$productos = $_POST["productos"];  // Lista de productos en JSON
$total = $_POST["total"];

// Preparar la consulta SQL
$sql = "INSERT INTO pedidos (nombre_cliente, direccion, telefono, productos, total) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssd", $nombre, $direccion, $telefono, $productos, $total);

if ($stmt->execute()) {
    echo "Pedido guardado correctamente";
} else {
    echo "Error al guardar el pedido: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
