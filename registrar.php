<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="registra.css"> <!-- Referencia al archivo CSS -->
    <title>Sistema de creacion de informes</title>
    <meta name="theme-color" content="#89f">
</head>



<?php


// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "sistema";

$conn = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Comprobar si los datos han sido enviados correctamente
if (isset($_POST['Cedula'], $_POST['Nombre'], $_POST['Telefono'], $_POST['Correo'], $_POST['Contraseña'])) {
    $cedula = $_POST['Cedula'];
    $nombre = $_POST['Nombre'];
    $telefono = $_POST['Telefono'];
    $correo = $_POST['Correo'];
    $contraseña = password_hash($_POST['Contraseña'], PASSWORD_DEFAULT); // Hashear la contraseña

    // Insertar datos en la tabla
    $sql = "INSERT INTO usuarios (cedula, nombre, telefono, correo, contraseña) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $cedula, $nombre, $telefono, $correo, $contraseña);

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Por favor, complete todos los campos.";
}

$conn->close();
?>
