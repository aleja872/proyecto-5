<?php
include "coneboton.php"; // Asegúrate de que este archivo conecta a la base de datos

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT); // Hashear la contraseña

    // Verificar si el usuario ya existe
    $sql_check = "SELECT id FROM usuarios WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "El usuario ya existe"]);
    } else {
        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Usuario registrado correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al registrar usuario"]);
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>
