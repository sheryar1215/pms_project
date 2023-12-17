<?php
  $pageTitle = "Manage Patients";
  $menuName = "Patients";

  include "config/connection.php";

  if(isset($_POST['save']))
  {
    $name = $_POST['patient_name'];
    $age = $_POST['patient_age'];
    $contact = $_POST['contact_no'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    try{
      $con->beginTransaction();

      $insertQuery = "insert into `patients`(`name`,`age`,`contact`,`gender`,`address`)
      value('$name','$age','$contact','$gender','$address');";

      $insertStatment = $con->prepare($insertQuery);
      $insertStatment->execute();
      
      $con->commit();
    }
    catch(PDOException $th)
    {
    $message = "some database Query error";   
     }
header("location:congrats?goto_page=patients&message=$message");
  }

$selectQuery = "select * from `patients`";
$selectStatment = $con->prepare($selectQuery);
$selectStatment->execute();
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
                          placeholder="Enter patient Name"  required = "required">
                        </div>

                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label >Age</label>
                          <input type="text" class="form-control" id="" name="patient_age"
                           placeholder="Enter Age"  required = "required">
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label > Contact</label>
                          <input type="text" class="form-control" id="" name="contact_no"
                           placeholder="Enter Contact Number"  required = "required">
                        </div>
                      </div>

                       <div class="col-lg-4">
                         <div class="form-group">
                           <label >Gander</label><br>
                           <div class="custom-control custom-checkbox">
                           <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="male" name="gender">
                          <label for="customCheckbox1" class="custom-control-label" name = "gender" >Male</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="female" name="gender">
                          <label for="customCheckbox2" class="custom-control-label">Female</label>
                        </div>

                      </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" class="form-control" id="" name="address" 
                          placeholder="Enter Address" required = "required">
                        </div>
                      </div>

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" type="submit" class="btn-block btn btn-success">Save</button>
                        </div>
                      </div>

                    </div>      </div>
                    <!-- /.card-body -->
                </form>
              </div>

        
            <!-- table starts here -->

            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">All Medicines</h3>
                </div>

                <div class="card-body">
                  <table id="patient_table" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>S_No</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $count = 0;
                      while($row = $selectStatment->fetch(PDO::FETCH_ASSOC))
                      {
                      $count++;
                      ?>

                      <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td><?php echo $row['contact'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['address'] ?></td>
                        <td><a href="update_patients?id=<?php echo $row['id']; ?>"class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                      </tr>

                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--  table end here -->
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