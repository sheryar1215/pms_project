<?php 
include "fpdf/our_awesome_pdf.php";
include "config/connection.php";

$pdf = new OurAwesomePdf('p',true,'All Patients','Generate Patient Reoprts');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetWidths([10,30,30,30,50,30]);
$pdf->addTableHeader(['S.No','Patient Name','Age','Contact','Gender','Address']);

$query = "select * from patients";
$stmt = $con->prepare($query);
$stmt->execute();

$count = 0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	$count++;
	$pdf->AddRow([$count,$row['name'],$row['age'],$row['contact'],$row['gender'],$row['address']]);
}


$pdf->output();

?>