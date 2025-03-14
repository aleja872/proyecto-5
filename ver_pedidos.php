<?php
include "conexion.php";

$sql = "SELECT * FROM pedidos ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

while ($pedido = $resultado->fetch_assoc()) {
    echo "<p><strong>{$pedido['nombre_cliente']}</strong> pidió {$pedido['productos']} por un total de {$pedido['total']} el {$pedido['fecha']}</p>";
}

$conexion->close();
?>
