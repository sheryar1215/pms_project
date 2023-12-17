<?php
  $pageTitle = "Manage Diseases Update";
  $menuName = " Diseases Update";
include "config/connection.php";
$id = $_GET['id'];
 if(isset($_POST['save']))
 {

  $diseaseName = $_POST['disease_name'];
  $hiddenId = $_POST['hidden_id'];
  try {
    $con->beginTransaction();
    $updateQuery = "UPDATE `diseases` set `disease_name` =   '$diseaseName' where `id` = $hiddenId";
    $updateStatment = $con->prepare($updateQuery);
    $updateStatment->execute();
    $con->commit();
    $message = "insert data sucessfully in disesases";
  } catch (PDOException $th) {
    $con->rollback();
    $message = "some data base querry error";
  }
 header("location:congrats?goto_page=diseases&message=$message");  
 }

   $selectQuery = "select * from `diseases` where `id` = $id";
   $selectStatment = $con->prepare($selectQuery);
   $selectStatment->execute();
$row =$selectStatment->fetch(pdo::FETCH_ASSOC);
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
                  <h3 class="card-title">Manage Diseases Update</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Diseases Name</label>
                          <input type="text" class="form-control" id="disease_name" name="disease_name"
                           placeholder="Enter Disease Name" required = "required" 
                           value="<?php echo $row['disease_name']?>">
                        </div>
                      </div>


                      <input type="hidden" name="hidden_id" value="<?php echo $row['id'] ?>">

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save"  class="btn-block btn btn-success">update</button>
                        </div>
                      </div>

                    </div>      </div>
                    <!-- /.card-body -->

                </form>
              </div>
</section>
            
</div>
                  <!-- our code ends here -->
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
    $("#Manage_Diseases_link").addClass('active');

  });
</script>
</body>
</html>
