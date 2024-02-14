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
    $fpdf = new FPDF();
    $fpdf->AddPage();
  
  	//Agrego imagen
	$fpdf->Image('WMMS.png', 172, 3, -600, -600); //archivo, de izq a der, de arriba a abajo, ancho, alto, tipo de archivo

	//Agrego título
	$fpdf->SetFont('Arial', 'B', 20); //fuente, estilo, tamaño
	$fpdf->setXY(85,28);
	$fpdf->setTextColor(66, 51, 255);
	$fpdf->Cell(100, 8, 'Voucher',0,1);

	//Texto encabezado
	$fpdf->SetFont('Arial', '', 10);
	$fpdf->setTextColor(0,0,0);
	$fpdf->setXY(9,40);
	$fpdf->MultiCell(0,5,utf8_decode("Prezado (a) Segurado (a), estamos muito felizes em tê-lo (a) como cliente, afinal o que mais queremos é que tenha uma viagem"));

	//Texto resaltado
	$fpdf->SetFont('Arial', 'B', 10);
	$fpdf->setXY(9,52);
	$fpdf->MultiCell(0,5,utf8_decode("Atenção: O seguro viagem não é seguro saúde! Leia atentamente as condições contratuais, observando seus direitos e obrigações, " . $nombre . ' bem como o limite do capital segurado contratado para cada cobertura.'));

    // Establecer la fuente antes de usar Cell
    $fpdf->SetFont('Arial', '', 12);
    // Mostrar los resultados en el PDF
    while ($row = $result->fetch_assoc()) {
        $fpdf->Cell(40, 10, 'Nombre: ' . $row['first_name']);
        $fpdf->Cell(40, 10, 'Apellido: ' . $row['last_name']);
        $fpdf->Cell(40, 10, 'Plan: ' . $row['plan']);
        $fpdf->Ln(); // Nueva línea
    }

    // Enviar el PDF al navegador
    $fpdf->Output('D', 'Voucher - ' . $nombre . ' ' . $apellido . '.pdf');
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();
?>