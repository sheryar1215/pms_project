<?php
include "config/connection.php";
$id = $_GET['id'];
$status = $_GET['status'];
$tableName = $_GET['table_name'];
$gotoPage = $_GET['goto_page'];
$type = $_GET['type'];
$statusToUpdate = 0;
if($status == 0)
{
    $statusToUpdate  = 1;
    $message = $type." has been unblocked successfully.";
}else{
    $statusToUpdate  = 0;
    $message = $type." has been blocked successfully.";
}

$selectQuery = "UPDATE `".$tableName."` SET `is_active` = $statusToUpdate where `id` = $id ";
$selectStatment = $con->prepare($selectQuery);
$selectStatment->execute();

header("location:$gotoPage?message=$message");
?>