<?php

function getAllMedicineNames($con , $id = 0){
    
    $selectQuery ="select * from `medicines` ";
    $selectStatment = $con->prepare($selectQuery);
    $selectStatment->execute();

    $data = "<option value=''>Select Medicine </option>";
    
        while($row = $selectStatment->fetch(PDO::FETCH_ASSOC))
    {
        if($row['id'] == $id )
        {
            $data = $data . "<option selected='selected' value = '".$row['id']."'>".$row["medicine_name"]."</option>";
        }else{
            $data = $data . "<option  value = '".$row['id']."'>".$row["medicine_name"]."</option>";
        }
    }
    
  return $data ; 

}

function getAllUserTypes($con,$id=0)
{
    $selectQuery = "select * from `user_types`";
    $selectStatment = $con->prepare($selectQuery);
    $selectStatment->execute();

    $data = "<option>Select User Type</option>";
    while($row = $selectStatment->fetch(PDO::FETCH_ASSOC))
    {
        if($row['id'] == $id)
        {
                    $data = $data . "<option selected = 'selected' value = '".$row['id']."'>".$row["type"]."</option>"; 
        }else{
                    $data = $data . "<option  value = '".$row['id']."'>".$row["type"]."</option>";
    }
    }
    return $data;
}

function getAllPatientsNames($con){

    $selectQuery = "SELECT * FROM `patients`";
    $selectStatment = $con->prepare($selectQuery);
    $selectStatment->execute();
    
    $data = "<option value='' >Select Patients</option>";
    while($row=$selectStatment->fetch(PDO::FETCH_ASSOC)){

        $data = $data . "<option  value = '".$row['id']."'>".$row["name"]."</option>";

    }

    return $data ; 
}


function getAlldiseasesNames($con){

 $selectQuery = "select * from `diseases`";
 $selectStatment = $con->prepare($selectQuery);
 $selectStatment->execute();

 $data ="<option value=''>Select Diseases</option>";
 while($row = $selectStatment->fetch(PDO::FETCH_ASSOC)){

  $data = $data . "<option value = '".$row['id']."'>".$row['disease_name']."</option>"; 

 }
return $data;
}

function getAllTests($con){

    $selectQuery = "select * from `lab_tests` ";
    $selectStatment =  $con->prepare($selectQuery);
    $selectStatment->execute();
    $data = "<option value=''>Select Tests</option>";
    while($row = $selectStatment->fetch(PDO::FETCH_ASSOC)){
 
        $data = $data . "<option value = '".$row['id']."'>".$row['test_name']."</option>";

    }
    return $data;
}
