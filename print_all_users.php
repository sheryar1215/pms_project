<?php 
include "fpdf/our_awesome_pdf.php";
include "config/connection.php";

$pdf = new OurAwesomePdf('p',true,'All Users','Generate Users Reoprts');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetWidths([10,30,30,30,50,30]);
$pdf->addTableHeader(['S.No','full Name','user Name','Rank','Email','Status']);

$query = "select u.* , ut.`type` from users as u , user_types as ut 
where u.`user_type_id` = ut.`id`";
$stmt = $con->prepare($query);
$stmt->execute();

$count = 0;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	$count++;
	$status = "Active";
	if($row['is_active']==0){
		$status = "Blocked";
	}
	$pdf->AddRow([$count,$row['full_name'],$row['user_name'],$row['type'],$row['email'],$status]);
}


$pdf->output();

?>