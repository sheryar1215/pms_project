<?php
include "../config/connection.php";
$columnName = $_GET['column_update_name'];
$tableName = $_GET['table_name'];
$columnData = $_GET['column_data'];
$hiddenId = $_GET['hidden_id'];


$selectQuery = "SELECT count(*) as count FROM `".$tableName."` where `".$columnName."` = '".$columnData."' and id !=  $hiddenId";

$selectStatment = $con->prepare($selectQuery);
$selectStatment->execute();
$row  = $selectStatment->fetch(PDO::FETCH_ASSOC);

echo $row['count'];
?>