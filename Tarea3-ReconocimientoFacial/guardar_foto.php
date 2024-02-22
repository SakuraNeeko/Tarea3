<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; 
$db = "registro_asistencia";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener fecha y hora actual
$fecha_hora = date("Y-m-d H:i:s");

// Consulta SQL para insertar datos
$sql = "INSERT INTO fotos (fecha_hora, numero_foto) VALUES ('$fecha_hora', 1)";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Foto guardada correctamente";
} else {
    echo "Error al guardar la foto: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>

