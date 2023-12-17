<?php
  $pageTitle = "Manage Lab";
  $menuName = " Lab Test";

  include "config/connection.php";

  if(isset($_POST['save']))
  {
    $labTest = $_POST['lab_test'];
    try{
      $con->beginTransaction();
      $insertQuery = "insert into `lab_tests`(`test_name`) value('$labTest')";
      $insertStatment = $con->prepare($insertQuery);
      $insertStatment->execute();
      $con->commit();
      $message = "insert data sucessfully in lab_tests";
    }catch(PDOException $th){
      $message ="some database query erro";
    }
    header("location:congrats?goto_page=manage_lab&message=$message");
  }

  $selectQuery = "select * from `lab_tests`";
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
                  <h3 class="card-title">Manage Lab Tests</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">


                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Lab Tests</label>
                          <input type="text" class="form-control" id="lab_test" name="lab_test" 
                          placeholder="Enter Test Name" required = "required">
                        </div>
                      </div>


                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save"  class="btn-block btn btn-success">Save</button>
                        </div>
                      </div>

                    </div>      </div>
                    <!-- /.card-body -->

                </form>
              </div>
                <!-- table starts -->

            <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Tests</h3>
                </div>

                <div class="card-body">
                  <table id="lab_test_table" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>S_NO</th>
                        <th>Test Name</th>
                        <th>Update</th>
                      </tr>
                    </thead>
                  
                    <tbody>
                      <?php
                      $count = 0;
                      while($row = $selectStatment->fetch(PDO::FETCH_ASSOC)){
                      $count++;
                      ?>
                      <tr>
                      <td><?php echo $count ;?></td>
                      <td><?php echo $row['test_name'];?></td>
                      <td><a href="lab_managment_update?id=<?php echo $row['id'];?>"class="btn btn-warning text-light" ><i class="fa fa-edit"></i></a></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- table ends -->

        
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
  $(document).ready(function(){
    $("#Miscellaneous_menue").addClass('menu-open');
    $("#Miscellaneous_menue_link").addClass('active');
    $("#manage_lab_test").addClass('active');
    addDataTable("lab_test_table");

  });
</script>

</body>
</html>
