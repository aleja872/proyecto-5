<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: pagpri.html"); // Si no hay sesión, redirigir al login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION["username"]; ?>!</h2>
    <p>Has iniciado sesión correctamente.</p>
  
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestión</title>
    <link rel="stylesheet" href="interadmi.css">
</head>
<body>

    <header>
        <h1>Panel de Gestión</h1>
    </header>

    <main>
        <div class="contenedor">
        <div class="card" onclick="redirigir('regisinven.html')">
        <h2>📦 Registro de producto</h2>
             </div>
            
            <div class="card" onclick="redirigir('regisfactu.html')">
                <h2>🧾 Registro de Facturas</h2>
            </div>
        </div>
    </main>

    <a href="logout.php" class="logout-btn">Cerrar sesión</a>

    <!-- Script agregado dentro del HTML -->
    <script>
        function redirigir(pagina) {
            window.location.href = pagina;
        }
    </script>

</body>
</html>


