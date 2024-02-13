<?php
require('fpdf/fpdf.php');

// Configuración de la conexión a la base de datos
$servername = "db5015283001.hosting-data.io";
$username = "dbu4149991";
$password = "Embrace2024!";
$database = "dbs12584072";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Inicializar variables de búsqueda
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$plan = $_GET['plan'];

// Consulta SQL para obtener los valores filtrados de la tabla pax
$sql = "SELECT first_name, last_name, plan FROM pax WHERE first_name = ? AND last_name = ? AND plan = ?";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Vincular parámetros
$stmt->bind_param("sss", $nombre, $apellido, $plan);

// Ejecutar la consulta
$stmt->execute();

// Obtener resultado
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Crear el objeto FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Establecer la fuente antes de usar Cell
    $pdf->SetFont('Arial', '', 12);
    // Mostrar los resultados en el PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, 'Nombre: ' . $row['first_name']);
        $pdf->Cell(40, 10, 'Apellido: ' . $row['last_name']);
        $pdf->Cell(40, 10, 'Plan: ' . $row['plan']);
        $pdf->Ln(); // Nueva línea
    }

    // Enviar el PDF al navegador
    $pdf->Output('D', 'Voucher - ' . $nombre . ' ' . $apellido . '.pdf');
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();
?>