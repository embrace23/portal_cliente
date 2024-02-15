<?php
// session.php

session_start();

// Verificar si el formulario se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir las credenciales del formulario
    $usuario_ingresado = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $contrasena_ingresada = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Conectar a la base de datos (ajusta los datos de conexión según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Consultar la base de datos para verificar las credenciales
    $stmt = $conn->prepare("SELECT usuario, contrasena FROM cuentas WHERE usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $usuario_ingresado, $contrasena_ingresada);
    $stmt->execute();
    $stmt->store_result();

if ($stmt->num_rows > 0) {
    // Credenciales válidas, autenticar al usuario
    $_SESSION['authenticated'] = true;

    // Verificar el usuario ingresado para redirigir a páginas específicas
    if ($usuario_ingresado === 'cliente1') {
        header('Location: clientes1.html');
    } elseif ($usuario_ingresado === 'cliente2') {
        header('Location: clientes2.html');
    } else {
        echo 'Credenciales incorrectas';
    }
    exit();
} else {
    // Credenciales incorrectas, mostrar mensaje de error
    echo 'Credenciales incorrectas';
}


    $stmt->close();
    $conn->close();
} else {
    // Redirigir a la página de inicio de sesión si el formulario no se ha enviado
    echo 'Credenciales incorrectas';
    exit();
}
?>
