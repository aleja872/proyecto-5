<?php
include "coneboton.php";
session_start();

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Buscar el usuario en la base de datos
    $sql = "SELECT id, username, password FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        // Guardar la sesión
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        echo json_encode(["success" => true, "message" => "Inicio de sesión exitoso.", "redirect" => "/interadmi.html"]);
    } else {
        echo json_encode(["success" => false, "message" => "Usuario o contraseña incorrectos."]);
    }

    $stmt->close();
    $conn->close();
}
?>







