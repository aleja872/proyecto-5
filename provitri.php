<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="provitri.css">
</head>
<body>
    <header>
        <h1>Catálogo de Productos</h1>
    </header>
    
    <section class="catalogo">
        <?php
        $conn = new mysqli("localhost", "root", "", "restaurante");
        if ($conn->connect_error) {
            die ("Connection failed: " . $conn->connect_error);
        }

        // Modificamos la consulta para asegurarnos que obtenemos los datos correctos
        $sql = "SELECT p.nombre, p.cantidad, p.precio, p.categoria 
                FROM productos p 
                WHERE p.nombre IS NOT NULL 
                ORDER BY p.categoria";
        
        $result = $conn->query($sql);

        $current_category = '';

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Depuración para ver los valores
                error_log("Producto: " . $row["nombre"] . " - Cantidad: " . $row["cantidad"]);
                
                if ($current_category != $row["categoria"]) {
                    $current_category = $row["categoria"];
                    echo '<div class="categoria-header"><h2>' . $current_category . '</h2></div>';
                }

                // Asegurarnos que la cantidad se trate como número
                $cantidad = intval($row["cantidad"]);
                
                echo '<div class="producto">
                        <img src="img.png" alt="' . htmlspecialchars($row["nombre"]) . '">
                        <h3>' . htmlspecialchars($row["nombre"]) . '</h3>
                        <p class="precio">$' . number_format($row["precio"], 0, ',', '.') . '</p>
                        <div class="disponibilidad">
                            <p class="cantidad">Disponible: ' . $cantidad . '</p>
                            ' . ($cantidad > 0 
                                ? '<button class="agregar-carrito" 
                                    data-nombre="' . htmlspecialchars($row["nombre"]) . '" 
                                    data-precio="' . $row["precio"] . '"
                                    data-cantidad="' . $cantidad . '">
                                    Agregar al carrito
                                   </button>'
                                : '<div class="no-disponible">No disponible</div>'
                            ) . '
                        </div>
                    </div>';
            }
        }
        $conn->close();
        ?>
    </section>

    <section class="carrito">
        <h2>🛒 Carrito de Compras</h2>
        <ul id="lista-carrito"></ul>
        <p id="total-carrito">Total: $0</p>
        <button id="vaciar-carrito">Vaciar Carrito</button>
        <button id="realizar-pedido">Realizar Pedido</button>
    </section>
    
    <div id="formulario-pedido" class="oculto">
        <!-- Resto del formulario se mantiene igual -->
    </div>
    
    <script src="carritovitri.js"></script>
</body>
</html>