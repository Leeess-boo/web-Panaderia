<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$mensaje = $_POST['mensaje'];

if (!empty($nombre) && !empty($correo)) {
    $sql = "INSERT INTO contactos (nombre, correo, mensaje) VALUES ('$nombre', '$correo', '$mensaje')";
    if ($conexion->query($sql) === TRUE) {
        header("Location: gracias.html");
    } else {
        echo "Error al guardar datos: " . $conexion->error;
    }

    // Bucle de revisión rápida
    echo "<h3>Últimos mensajes</h3>";
    $result = $conexion->query("SELECT * FROM contactos ORDER BY id DESC LIMIT 3");
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['nombre'] . ": " . $row['mensaje'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Todos los campos son requeridos.";
}

$conexion->close();
?>
