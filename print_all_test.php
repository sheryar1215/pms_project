<?php 
include 'fpdf/our_awesome_pdf.php';

include 'config/connection.php';

$pdf = new OurAwesomePdf('P', true, 'All Tests', date('Y-m-d'), date('Y-m-d'), true, 'Demo');
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->setWidths([10, 150, 20]);
$pdf->setAligns(['L', 'L', 'L']);
$pdf->addTableHeader(['S.No', 'Test Name', 'Status']);


$query = "select * from lab_tests";
$stmt = $con->prepare($query);
$stmt->execute();

$i = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$status = 'Active';
	if($row['is_active'] == 0) {
		$status = "De Active";
	}
	$pdf->addRow([$i, $row['test_name'], $status]); 
}


$pdf->Output();


?>