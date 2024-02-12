<?php
require('fpdf/fpdf.php');

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "gfa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Inicializar variables de búsqueda
$nombre = $_GET['nombre'] ?? '';
$apellido = $_GET['apellido'] ?? '';
$plan = $_GET['plan'] ?? '';

// Consulta SQL para obtener los valores filtrados de la tabla pax
$sql = "SELECT nombre, apellido, plan FROM pax WHERE nombre LIKE '%$nombre%' AND apellido LIKE '%$apellido%' AND plan LIKE '%$plan%'";

// Ejecutar la consulta
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear el objeto FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Establecer la fuente antes de usar Cell
    $pdf->SetFont('Arial', '', 12);

    // Mostrar los resultados en el PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, 'Nombre: ' . $row['nombre']);
        $pdf->Cell(40, 10, 'Apellido: ' . $row['apellido']);
        $pdf->Cell(40, 10, 'Plan: ' . $row['plan']);
        // Puedes añadir más celdas según la estructura de tu tabla
    }

    // Enviar el PDF al navegador
    $pdf->Output('D', 'resultado.pdf'); // Descargar el PDF con el nombre "resultado.pdf"
} else {
    echo "No se encontraron resultados";
}
// Cerrar la conexión
$conn->close();
?>
