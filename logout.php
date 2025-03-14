<?php
session_start();
session_destroy();
header("Location: pagpri.html"); // Redirigir al login
exit();
?>
