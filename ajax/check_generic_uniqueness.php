<?php
    include "../config/connection.php";

    $tableName  = $_GET['table_name'];
    $columnName = $_GET['column_name'];
    $columnData = $_GET['column_data'];

    $query = "select count(*) as count from `".$tableName."` where `".$columnName."` = '$columnData'";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['count'];

?>