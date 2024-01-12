<?php 
include "fpdf/our_awesome_pdf.php";
include "config/connection.php";

$patientVisitId = $_GET['patient_visit_id'];

$pdf = new 	OurAwesomePdf('p',true,'Prescription');

$pdf->AddPage();
$pdf->AliasNbPages();

$queryPatientVisit = "SELECT `p`.`name`, `p`.`contact`,`p`.`age`, `p`.`gender`, `pv`.`blood_presure`,
`pv`.`suger`,DATE_FORMAT(`pv`.`date`, '%d %b %Y') as `visit_date`,
DATE_FORMAT(`pv`.`next_visit_date`, '%d %b %Y') as `next_visit_date`
FROM `patient_visits` as `pv`, `patients` as `p`
WHERE `p`.`id` = `pv`.`patient_id` AND `pv`.`id` = $patientVisitId";

$stmtPatientVisit = $con->prepare($queryPatientVisit);
$stmtPatientVisit->execute();
$rowPatient = $stmtPatientVisit->fetch(PDO::FETCH_ASSOC);


$queryMedication = "SELECT `pvm`.`quantity`, `pvm`.`dosage`, `m`.`medicine_name`, `md`.`packing` 
FROM `patient_visit_medications` as `pvm`, `medicines` as `m`, `medicine_details` as `md`
WHERE `pvm`.`medicien_detail_id`=`md`.`id` AND `m`.`id`=`md`.`medicien_id` 
AND `pvm`.`patient_visit_id` = $patientVisitId";

$stmtMedication = $con->prepare($queryMedication);
$stmtMedication->execute();


$queryDiseases = "SELECT `d`.`disease_name` FROM `patient_visit_diseases` as `pvd`, `diseases` as `d` WHERE `d`.`id` = `pvd`.`disease_id` AND `pvd`.`patient_visit_id` = 
$patientVisitId";
$stmtDiseases = $con->prepare($queryDiseases);
$stmtDiseases->execute();


$queryTests = "SELECT  `lt`.`test_name` , `pvt`.`test_result` FROM `patient_visit_tests` AS `pvt` , `lab_tests`AS `lt` WHERE `pvt`.`lab_test_id` = `lt`.`id` AND `pvt`.`patient_visit_id` = $patientVisitId";
$stmtTests = $con->prepare($queryTests);
$stmtTests->execute();



$pdf->setFont('', '', 12);

$pdf->setWidths([40,70,30,40]);

$pdf->addRow(['Patient Name:', $rowPatient['name'], 'Gender:', ucwords(strtolower($rowPatient['gender']))], false);

$pdf->line($pdf->GetX()+40, $pdf->GetY()-1, 110, $pdf->GetY()-1);

$pdf->line($pdf->GetX()+140, $pdf->GetY()-1, 200, $pdf->GetY()-1);

$pdf->ln(3);

$pdf->addRow(['Contact Number:', $rowPatient['contact'], 'Age:', $rowPatient['age']], false);

$pdf->line($pdf->GetX()+40, $pdf->GetY()-1, 110, $pdf->GetY()-1);

$pdf->line($pdf->GetX()+140, $pdf->GetY()-1, 200, $pdf->GetY()-1);

$pdf->ln(3);

$pdf->addRow(['Suger:', '349', 'BP:', '120/89'], false);

$pdf->line($pdf->GetX()+40, $pdf->GetY()-1, 110, $pdf->GetY()-1);

$pdf->line($pdf->GetX()+140, $pdf->GetY()-1, 200, $pdf->GetY()-1);


$pdf->ln(3);

$pdf->addRow(['Date:', $rowPatient['visit_date'], 'Next Visit Date:', $rowPatient['next_visit_date']], false);

$pdf->line($pdf->GetX()+40, $pdf->GetY()-1, 110, $pdf->GetY()-1);

$pdf->line($pdf->GetX()+140, $pdf->GetY()-1, 200, $pdf->GetY()-1);

$pdf->ln(3);
$pdf->AddTableCaption('Medicines');

$pdf->setWidths([15, 90, 40, 40]);

$pdf->AddTableHeader(['S.No', 'Medicine Name', 'Quantity', 'Dosage']);

$i = 0;
while ($row = $stmtMedication->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$data = array($i, $row['medicine_name'].'('.$row['packing'].')', $row['quantity'],  $row['dosage']);

	$pdf->AddRow($data);
}

$pdf->ln(3);
$pdf->AddTableCaption('Diseases');


$pdf->setWidths([15, 170]);

$pdf->AddTableHeader(['S.No', 'Diseas Name']);

$i = 0;
while ($row = $stmtDiseases->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$data = array($i,$row['disease_name']);
	$pdf->addRow($data);
}



$pdf->ln(3);
$pdf->AddTableCaption('Tests');


$pdf->setWidths([15, 130, 40]);

$pdf->AddTableHeader(['S.No', 'Test Name', 'Test Result']);
$i = 0;
while ($row = $stmtTests->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$data = array($i,$row['test_name'],$row['test_result']);
	$pdf->addRow($data);
}

$pdf->output();

?>