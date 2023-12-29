<?php 
include "fpdf/our_awesome_pdf.php";
include "config/connection.php";

$pdf = new 	OurAwesomePdf('p',true,'All Test Reports','Generate Lab Test Report');

$pdf->AddPage();
$pdf->SetWidths([10,150,30]);
$pdf->addTableHeader(['S.No','Lab Test Name','Status']);

$query = "select * from `lab_tests`";
$stmt = $con->prepare($query);
$stmt->execute();


$count = 0;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $status= "Active";

    if($row['is_active'] == 0){
        $status = "Blocked";
    }

    $count++;
    $pdf->AddRow([$count,$row['test_name'],$status]);

}

$pdf->output();

?>