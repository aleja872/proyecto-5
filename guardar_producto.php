<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "restaurante");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $nombre = $_POST['name'];
    $cantidad = (int)$_POST['quantity'];
    $precio = (float)$_POST['price'];
    $categoria = $_POST['category'];
    $fecha = $_POST['datetime'];
    
    $sql = "INSERT INTO productos (nombre, cantidad, precio, categoria, fecha) 
            VALUES (?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidss", $nombre, $cantidad, $precio, $categoria, $fecha);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Producto registrado correctamente');
                window.location.href = 'regisinven.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al registrar el producto');
                window.location.href = 'regisinven.php';
              </script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>