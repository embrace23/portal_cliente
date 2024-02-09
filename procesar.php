<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gfa";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificación de la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el archivo Excel
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $nombre_temporal = $_FILES['archivo']['tmp_name'];

    // Cargar la librería PhpSpreadsheet
    require 'vendor/autoload.php'; // Ajusta la ruta según la estructura de tu proyecto

    $objPHPExcel = PhpOffice\PhpSpreadsheet\IOFactory::load($nombre_temporal);
    $hoja = $objPHPExcel->getSheet(0);

    // Iterar sobre las filas del archivo Excel
    foreach ($hoja->getRowIterator() as $fila) {
        $nombre = $fila->getCellByColumnAndRow(0)->getValue();
        $apellido = $fila->getCellByColumnAndRow(1)->getValue();
        $fecha_nacimiento = $fila->getCellByColumnAndRow(2)->getValue();
        $plan = $fila->getCellByColumnAndRow(3)->getValue();

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO tu_tabla (nombre, apellido, fecha_nacimiento, plan) VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$plan')";
        $conn->query($sql);
    }

    echo "Datos cargados exitosamente.";
} else {
    echo "Error al cargar el archivo.";
}

// Cerrar la conexión
$conn->close();
?>
