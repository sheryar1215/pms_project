<?php 
include "fpdf/our_awesome_pdf.php";
include "config/connection.php";

$pdf = new OurAwesomePdf('p',true,'All Disease','Generate Disease Reoprts');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetWidths([20,50]);
$pdf->addTableHeader(['S.No','Disease Name']);

$query = "select * from `diseases` ";
$stmt = $con->prepare($query);
$stmt->execute();

$count = 0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	$count++;
$pdf->AddRow([$count,$row['disease_name']]);
}


$pdf->output();

?>

$pdf->Addpage();   



$pdf->output();

?>