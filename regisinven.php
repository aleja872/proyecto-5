<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario del Restaurante</title>
    <link rel="stylesheet" href="regisinven.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Inventario</h1>
        <form id="productForm" action="guardar_producto.php" method="POST">
            <input type="text" id="name" name="name" placeholder="Nombre del producto" required>
            <input type="number" id="quantity" name="quantity" placeholder="Cantidad" required>
            <input type="number" id="price" name="price" placeholder="Precio" step="0.01" required>
            <label for="category">Categoría:</label>
            <select id="category" name="category">
                <option value="Bebidas en vaso">Bebidas en vaso</option>
                <option value="Bebidas en botella">Bebidas en botella</option>
                <option value="Desayunos">Desayunos</option>
                <option value="Comida rápida">Comida rápida</option>
            </select>            
            <input type="datetime-local" id="datetime" name="datetime" required>
            <button type="submit">Agregar Producto</button>
        </form>
        
        <!-- Resto del código HTML se mantiene igual -->
    </div>
</body>
</html>