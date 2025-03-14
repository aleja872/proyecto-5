<?php

$host = "localhost";
$user = "root";  
$password = "";  
$dbname = "restaurante";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Esto asegura que el archivo solo sirva para la conexión y no detenga la ejecución del resto del código
?>
