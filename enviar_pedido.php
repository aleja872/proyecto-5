<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");
require "conexion.php"; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datos = json_decode(file_get_contents("php://input"), true);

    if (!isset($datos["nombre"], $datos["direccion"], $datos["carrito"], $datos["total"])) {
        echo json_encode(["status" => "error", "message" => "❌ Datos incompletos."]);
        exit;
    }

    $nombre = htmlspecialchars($datos["nombre"]);
    $direccion = htmlspecialchars($datos["direccion"]);
    $carrito = json_encode($datos["carrito"]);
    $total = floatval($datos["total"]);
    $fecha = date("Y-m-d"); // Fecha automática
    $email = isset($datos["email"]) ? filter_var($datos["email"], FILTER_VALIDATE_EMAIL) : null;

    if (!$carrito || empty(json_decode($carrito, true))) {
        echo json_encode(["status" => "error", "message" => "❌ Carrito vacío."]);
        exit;
    }

    // Insertar en la base de datos (sin ID porque es autoincrement)
    $stmt = $conexion->prepare("INSERT INTO pedidos (nombre, email, direccion, productos, total, fecha) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "❌ Error en la consulta: {$conexion->error}"]);
        exit;
    }

    $stmt->bind_param("sssdss", $nombre, $email, $direccion, $carrito, $total, $fecha);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Pedido guardado correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Error al guardar el pedido: {$stmt->error}"]);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(["status" => "error", "message" => "❌ Método no permitido."]);
}
?>
