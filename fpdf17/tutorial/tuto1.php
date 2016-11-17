<?php
require('../fpdf.php');
require_once '../../include.php';

$sql = "SELECT * FROM patient_details WHERE patient_id = 1";
	
	$result = query($sql);
	$row = mysql_fetch_array($result);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$row[0]);
$pdf->Cell(40,10,$row[1]);
$pdf->Cell(40,10,$row[2]);
$pdf->Cell(40,10,$row[3]);
$pdf->Cell(40,10,$row[4]);
$pdf->Cell(40,10,$row[5]);

$pdf->Output();
?>
