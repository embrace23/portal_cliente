<?php
require('fpdf/fpdf.php');
include('templates/variables.php');
header('charset=utf-8');
//Creo PDF
$fpdf = new FPDF();
$fpdf->AddPage();
$fpdf->SetAutoPageBreak(true);

include('templates/template.php');
$fpdf->Output();
?>