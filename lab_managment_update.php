<?php
  $pageTitle = "Manage Lab";
  $menuName = " Lab Test";
include "config/connection.php";

$id = $_GET['id'];
  if(isset($_POST['save']))
  {
    $labTest = $_POST['lab_test'];
    $hiddenId = $_POST['hidden_id'];
    try{
      $con->beginTransaction();
      $updateQuery = "update `lab_tests` set `test_name` = '$labTest' where  `id` = $hiddenId  ";
      $updateStatment = $con->prepare($updateQuery);
      $updateStatment->execute();
      $con->commit();
      $message = "insert data sucessfully in lab_tests";
    }catch(PDOException $th){
      $message ="some database query erro";
    }
    header("location:congrats?goto_page=manage_lab&message=$message");
  }

  $selectQuery = "select * from `lab_tests` where `id` = $id";
  $selectStatment = $con->prepare($selectQuery);
  $selectStatment->execute();
   $row = $selectStatment->fetch(pdo::FETCH_ASSOC);
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

                       <input type="hidden" name="hidden_id" value="<?php echo $row['id'] ?>">
                      
                       <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Lab Tests</label>
                          <input type="text" class="form-control" id="lab_test" name="lab_test" 
                          placeholder="Enter Test Name" required = "required"
                          value="<?php echo $row['test_name'] ;?>">
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
 

  });
</script>

</body>
</html>
