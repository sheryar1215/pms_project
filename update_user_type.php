<?php
  $pageTitle = "Manage   User Type Update";
  $menuName = "User Types Update";

  include "config/connection.php";
   $id = $_GET['id'];

  if(isset($_POST['save'])){

    $userType = $_POST['user_type'];
    $hiddenId = $_POST['hidden_id'];
    try {
             
      $con->beginTransaction();
      $updateQuery = "update `user_types` set `type` = '$userType' where `id` = $hiddenId";
      $updateStatment = $con->prepare($updateQuery);
      $updateStatment->execute();
      $con->commit();
          $message = "insert user_type sucessfully";      
    } catch (PDOException $th) {
 
      $con->rollBack();
      $message = "some database Query error";
    }
    header("location:congrats?goto_page=user_types&message=$message");
  }
  $selectQuery = "select * from `user_types` where `id`= $id";
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
        
        <section class="content">
        <div class="container-fluid">
          <!-- our code starts here -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Manage User Type Updates </h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Enter User Type</label>
                          <input type="text" class="form-control" id="user_type" name="user_type" 
                          placeholder="Enter User Type" value="<?php echo $row['type']?>">
                        </div>
                      </div>

                     <input type="hidden" name= "hidden_id" value="<?php echo $row['id']?>">

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" class="btn-block btn btn-success">Upadte</button>
                        </div>
                      </div>

                    </div>

                    <!-- /.card-body -->

                </form>
              </div>
            </div>

            

            <!-- our code ends here -->
          </div>
      </section>
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
  
  $("#user_menue_link").addClass('active');
  $("#user_menue").addClass('menu-open');
  $("#user_types_link").addClass('active');  
  });
</script>

</body>
</html>
