<?php
//Traigo archivo fpdf.php
require('fpdf/fpdf.php');

//Conexión a base de datos
$servername = "db5015283001.hosting-data.io";
$username = "dbu4149991";
$password = "Embrace2024!";
$database = "dbs12584072";

//Se crea la conexión
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

//Se verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

//Inicialización de variables traidas del formulario
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$plan = $_GET['plan'];

//Consulta SQL para obtener los valores filtrados de la tabla pax
$sql = "SELECT first_name, last_name, plan FROM pax WHERE first_name = ? AND last_name = ? AND plan = ?";

$stmt = $conn->prepare($sql);
//Se pasa por parámetros las variables anteriores
$stmt->bind_param("sss", $nombre, $apellido, $plan);

//Se realiza la consulta
$stmt->execute();

//Traigo el resultado
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    //Creo el FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    //Elijo la fuente
    $pdf->SetFont('Arial', '', 12);
    //Muestro los resultados en el PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, 'Nombre: ' . $row['first_name']);
        $pdf->Cell(40, 10, 'Apellido: ' . $row['last_name']);
        $pdf->Cell(40, 10, 'Plan: ' . $row['plan']);
        $pdf->Ln();
    }

    //Envio el pdf a descargar
    $pdf->Output('D', 'Voucher - ' . $nombre . ' ' . $apellido . '.pdf');
} else {
    echo "No se encontraron resultados";
}

//Cierre
$stmt->close();
$conn->close();
?>