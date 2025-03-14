<?php
$host = "localhost";  
$usuario = "root";  
$password = "";  
$bd = "restaurante";  

$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurante";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
include 'conexion.php';
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa";
}

?>




