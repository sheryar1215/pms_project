<?php 
	include 'fpdf/fpdf.php';

	include 'config/connection.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);

$pdf->cell(0, 10, 'All Users Report' , 1, 1, 'c' );

$pdf->SetFont('Arial','B', 14);

$pdf->setFillColor(0,0,0);
$pdf->setTextColor(255,255,255);

$pdf->ln();

$pdf->cell(20, 10, 'S.No', 1, 0, 'L', 1);
$pdf->cell(40, 10, 'Full Name', 1, 0, 'L', 1);
$pdf->cell(30, 10, 'Username', 1, 0, 'L', 1);
$pdf->cell(70, 10, 'Email', 1, 0, 'L', 1);
$pdf->cell(30, 10, 'Status', 1, 1, 'L', 1);


$query = "select * from users";
$stmt = $con->prepare($query);
$stmt->execute();

$pdf->setTextColor(0,0,0);
$pdf->setFillColor(255,255,255);

$pdf->SetFont('Arial','', 12);

$i = 0;
$status = "";
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$i++;

	if($row['is_active'] == 1) {
		$status = "Active";
	} else {
		$status = "De Active";
	}

	$pdf->cell(20, 10, $i, 1, 0, 'L', 1);
	$pdf->cell(40, 10, $row['full_name'], 1, 0, 'L', 1);
	$pdf->cell(30, 10, $row['user_name'], 1, 0, 'L', 1);
	$pdf->cell(70, 10, $row['email'], 1, 0, 'L', 1);
	$pdf->cell(30, 10, $status, 1, 1, 'L', 1);

}


$pdf->Output();


 ?>