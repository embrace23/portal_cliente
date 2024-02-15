<?php
require('variables.php');
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
$fpdf->MultiCell(0,5,utf8_decode($encabezado2));

//Texto resaltado
$fpdf->SetFont('Arial', 'B', 10);
$fpdf->setXY(9,52);
$fpdf->MultiCell(0,5,utf8_decode($resaltado2));

//Tabla
$fpdf->SetFont('Arial', '', 10);
$fpdf->setTextColor(0,0,0);
$fpdf->setXY(20,65); //Establecer coordenadas en XY para lo que sigue
$fpdf->setFillColor(192, 30, 79);
$fpdf->setDrawColor(51, 224, 255);
$fpdf->Cell(10, 10, utf8_decode($titulo_tabla2[0]), 1, 0, 'c',1); //ancho, alto, texto, borde, pos actual, alineacion (l, c, r), fondo, link
$fpdf->Cell(120, 10, utf8_decode($titulo_tabla2[1]), 1, 0, 'c',1);
$fpdf->Cell(40, 10, utf8_decode($titulo_tabla2[2]), 1, 0, 'c',1);
$fpdf->Ln();
$fpdf->setXY(20,75);
$fpdf->Cell(10, 10, utf8_decode($concepto2_2[0]), 0, 0, 'c',0);
$fpdf->Cell(120, 10, utf8_decode($concepto2_2[1]), 0, 0, 'c',0);
$fpdf->Cell(40, 10, utf8_decode($concepto2_2[2]), 0, 0, 'c',0);
$fpdf->Ln();
$fpdf->setXY(20,85);
$fpdf->Cell(10, 10, utf8_decode($concepto2_3[0]), 0, 0, 'c',0);
$fpdf->Cell(120, 10, utf8_decode($concepto2_3[1]), 0, 0, 'c',0);
$fpdf->Cell(40, 10, utf8_decode($concepto2_3[2]), 0, 0, 'c',0);
?>