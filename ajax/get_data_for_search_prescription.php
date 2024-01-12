<?php 

include '../config/connection.php';

$value = $_GET['value'];
$serarchBy = $_GET['search_by'];


$where = "";

if($serarchBy == 'name') {
	$where = " AND p.name like '%".$value."%';";	
} else if ($serarchBy == 'contact') {
	$where = " AND p.contact =  '".$value."';";
} else {
	$where = " AND p.address like '%".$value."%';";
}



$query = "SELECT p.name, p.age, p.contact, p.address, pv.date, pv.blood_presure, pv.id
FROM `patients` as p, patient_visits as pv 
WHERE p.id=pv.patient_id" . $where;


$stmt = $con->prepare($query);
$stmt->execute();

$data = "";

$i = 0;
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$data = $data . "<tr>";

	$data = $data . "<td>".$i."</td>";
	$data = $data . "<td>".$row['name']."</td>";
	$data = $data . "<td>".$row['date']."</td>";
	$data = $data . "<td>".$row['age']."</td>";
	$data = $data . "<td>".$row['contact']."</td>";
	$data = $data . "<td>".$row['address']."</td>";
	$data = $data . "<td> <a target='_blank' 
	href='print_prescription?patient_visit_id=".$row['id']."' class='btn btn-primary'><i class='fa fa-print'></i> </a></td>";

	$data = $data . "</tr>";
}

echo $data;

?>