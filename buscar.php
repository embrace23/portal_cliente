<?php
require('fpdf/fpdf.php');

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gfa";

// Crea la conexión 
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtiene los valores del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$plan = $_POST['plan'];

// Realiza la consulta en la base de datos
$sql = "SELECT * FROM pax WHERE nombre='$nombre' AND apellido='$apellido' AND plan='$plan'";
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
