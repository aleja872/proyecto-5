<?php

include 'registrar.php'; // Conexión a la base de datos
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        die(json_encode(["error" => "No se recibieron datos correctamente"]));
    }

    // Verificar si es una actualización o eliminación
    if (isset($data['action']) && $data['action'] === 'update') {
        // Actualizar producto
        $stmt = $conn->prepare("UPDATE productos SET nombre=?, cantidad=?, precio=?, categoria=?, fecha_hora=? WHERE id_poduc=?");
        $stmt->bind_param("sddssi", $data['name'], $data['quantity'], $data['price'], $data['category'], $data['datetime'], $data['id']);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Producto actualizado correctamente"]);
        } else {
            echo json_encode(["error" => "Error al actualizar: " . $stmt->error]);
        }
    } elseif (isset($data['action']) && $data['action'] === 'delete') {
        // Eliminar producto
        $id = intval($data['id']);
        $stmt = $conn->prepare("DELETE FROM productos WHERE id_poduc=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["success" => true, "message" => "Producto eliminado"]);
            } else {
                echo json_encode(["success" => false, "error" => "No se encontró el producto"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "Error al eliminar: " . $stmt->error]);
        }

    } else {
        // Registrar nuevo producto
        error_log("Attempting to insert data: " . print_r($data, true));
        
        $stmt = $conn->prepare("INSERT INTO productos (nombre, cantidad, precio, categoria, fecha_hora) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            die(json_encode(["error" => "Error en la preparación de la consulta"]));
        }

        $stmt->bind_param("sddss", $data['name'], $data['quantity'], $data['price'], $data['category'], $data['datetime']);
        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            echo json_encode(["error" => "Error al insertar: " . $stmt->error]);
        } else {
            $insert_id = $stmt->insert_id;
            error_log("Insert successful. New ID: " . $insert_id);
            echo json_encode([
                "success" => true,
                "message" => "Producto agregado correctamente",
                "id" => $insert_id
            ]);
        }
    }

} elseif ($method === 'GET') {
    // Obtener productos
    $result = $conn->query("SELECT *, id_poduc as id FROM productos ORDER BY fecha_hora DESC");
    $productos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($productos);
}

$conn->close();
?>
