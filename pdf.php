<?php
require('fpdf/fpdf.php');
header('charset=utf-8');
//Creo PDF
$fpdf = new FPDF();
$fpdf->AddPage();
$fpdf->SetAutoPageBreak(true);

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
$fpdf->MultiCell(0,5,utf8_decode("Atenção: O seguro viagem não é seguro saúde! Leia atentamente as condições contratuais, observando seus direitos e obrigações, bem como o limite do capital segurado contratado para cada cobertura."));

//Tabla
$fpdf->SetFont('Arial', '', 10);
$fpdf->setTextColor(0,0,0);
$fpdf->setXY(10,65); //Establecer coordenadas en XY para lo que sigue
$fpdf->Cell(10, 10, 'N', 1, 0, 'c',0); //ancho, alto, texto, borde, pos actual, alineacion (l, c, r), fondo, link
$fpdf->Cell(100, 10, 'Producto', 1, 0, 'c',0);
$fpdf->Cell(40, 10, 'Cobertura', 1, 0, 'c',0);
$fpdf->Ln();
$fpdf->Cell(10, 10, 'N', 1, 0, 'c',0);
$fpdf->Cell(100, 10, 'Producto', 1, 0, 'c',0);
$fpdf->Cell(40, 10, 'Cobertura', 1, 0, 'c',0);
$fpdf->Ln();
$fpdf->Cell(10, 10, 'N', 1, 0, 'c',0);
$fpdf->Cell(100, 10, 'Producto', 1, 0, 'c',0);
$fpdf->Cell(40, 10, 'Cobertura', 1, 0, 'c',0);
$fpdf->Output();
?>