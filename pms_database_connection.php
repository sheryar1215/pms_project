<?php
try{
$con = new PDO("mysql:host=localhost;dbname=patient_managment_system","root","");
$con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );


}
catch(PDOException $ex)
{
   echo $ex->getMessage();
}
?>