<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proveedor = $_POST["proveedor"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["factura"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "pdf") {
        echo "Solo se permiten archivos PDF.";
        exit;
    }

    if (move_uploaded_file($_FILES["factura"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO facturas (proveedor, archivo) VALUES ('$proveedor', '$archivo')";
        if ($conn->query($sql) === TRUE) {
            echo "Factura registrada correctamente.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Hubo un error al subir el archivo.";
    }
}

$conn->close();
?>
