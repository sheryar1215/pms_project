<?php
  $pageTitle = "Manage Patients Updates";
  $menuName = "Patients Update";

  include "config/connection.php";

  $id = $_GET['id'];
  if(isset($_POST['save']))
  {
    
    $name = $_POST['patient_name'];
    $age = $_POST['patient_age'];
    $contact = $_POST['contact_no'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $hiddenId = $_POST['hidden_id'];

    try{
      $con->beginTransaction();

        $updateQuery = "UPDATE `patients` SET `name` = '$name' , `age` = '$age' , `contact` = '$contact' ,
       `gender` = '$gender' , `address` = '$address' where  `id`  = $hiddenId ";
      $updateStatment = $con->prepare($updateQuery);
      $updateStatment->execute();

      
      $con->commit();
     
    }
    catch(PDOException $th)
    {
        $con->rollBack();
        echo $th->getMessage();
        exit;
        
    $message = "some database Query error";   
     }
header("location:congrats?goto_page=patients.php&message=$message");
  }

  $selectQuery = "select * from `patients` where `id` = $id";
  $selectStatment = $con->prepare($selectQuery);
  $selectStatment->execute();

  $row = $selectStatment->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'config/site_css.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <?php include 'config/pre_loader.php'; ?>

  <!-- Navbar -->
  <?php include 'config/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'config/side_bar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include 'config/bread_crumb.php'; ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- our code starts here -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Manage Patients</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label>Name</label>
                          <input type="text" class="form-control" id="" name="patient_name" 
                          placeholder="Enter patient Name" required = "required" value="<?php echo $row['name']?>">
                        </div>

                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label >Age</label>
                          <input type="text" class="form-control" id="" name="patient_age"
                           placeholder="Enter Age" required = "required" value="<?php echo $row['age']?>">
                        </div>
                      </div>


                      <div class="col-lg-4">
                        <div class="form-group">
                          <label > Contact</label>
                          <input type="text" class="form-control" id="" name="contact_no"
                           placeholder="Enter Contact Number" required = "required" value="<?php echo $row['contact']?>">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label >Gander</label><br>
                           <?php
                          $maleCheck = "";
                          $feMaleCheck = "";

                            if($row['gender'] == 'male') {
                                $maleCheck = "checked='checked'";
                            } else {
                                $feMaleCheck = "checked='checked'";
                            }
                          ?> 
                          Male <input type="radio" class="" id="" name="gender" value="male" <?php echo $maleCheck; ?> >
                          Female <input type="radio" class="" id="" name="gender" value="female" <?php echo $feMaleCheck; ?>>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" id="" name="address" 
                          placeholder="Enter Address" required = "required" value="<?php echo $row['address']?>">
                        </div>

                    </div>

                    <input type="hidden" name="hidden_id" value="<?php echo $row['id']; ?>">

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" type =  "submit" class="btn-block btn btn-success">update</button>
                        </div>
                      </div>

                    </div>      </div>
                    <!-- /.card-body -->
                </form>
              </div>

        <!-- our code ends here -->
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php include 'config/footer.php' ?>
</div>
<!-- ./wrapper -->

<?php  include 'config/site_js.php'; ?>

<script>
 $(document).ready(function() {
      $("#patients_menue").addClass('menu-open');
      $("#patients_menue_link").addClass('active');
      $("#patients_manage_link").addClass('active'); 
    
      addDataTable("patient_table");
    
    });
</script>

</body>
</html>







