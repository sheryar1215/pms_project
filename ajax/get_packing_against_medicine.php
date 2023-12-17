<?php 
    include "../config/connection.php";

    $medicineId = $_GET['medicine_id'];

    $query = "select * from medicine_details where medicien_id = $medicineId";
    $stmt = $con->prepare($query);
    $stmt->execute();

    $data = "";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data = $data . "<option value='".$row['id']."'>".$row['packing']."</option>";
    }

    echo $data;

?>