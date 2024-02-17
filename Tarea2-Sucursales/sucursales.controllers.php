<?php
// Conexión a la base de datos 
$servername = "localhost";
$username = "usuario";
$password = "contraseña";
$dbname = "base_proyecto";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Operación para insertar una nueva sucursal
if ($_GET['op'] == 'insertar') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $parroquia = $_POST['parroquia'];
    $canton = $_POST['canton'];
    $provincia = $_POST['provincia'];

    $sql = "INSERT INTO sucursales (Nombre, Direccion, Telefono, Correo, Parroquia, Canton, Provincia) VALUES (:nombre, :direccion, :telefono, :correo, :parroquia, :canton, :provincia)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':parroquia', $parroquia);
    $stmt->bindParam(':canton', $canton);
    $stmt->bindParam(':provincia', $provincia);

    try {
        $stmt->execute();
        echo json_encode("ok");
    } catch(PDOException $e) {
        echo json_encode("error");
    }
}

// Operación para obtener todas las sucursales
if ($_GET['op'] == 'todos') {
    $sql = "SELECT * FROM sucursales";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sucursales);
}
?>
