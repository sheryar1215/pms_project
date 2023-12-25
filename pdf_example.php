<?php 
	include 'fpdf/fpdf.php';


$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->SetFillColor(0,0,0);
$pdf->setTextColor(255,255,255);
$pdf->Cell(40,10,'Hello World!', 1);
$pdf->Cell(40,10,'khan', 1);
$pdf->Cell(40,10,'ali', 1, 0, 'C', 1);
$pdf->Cell(40,10,'shakir', 1, 1);
$pdf->Cell(40,10,'aslam', 1);

$pdf->Output();


 ?>