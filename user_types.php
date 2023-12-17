<?php
  $pageTitle = "Manage User Types";
  $menuName = "User Types";

  include "config/connection.php";
  if(isset($_POST['save'])){

    $userType = $_POST['user_type'];

    try {
             
      $con->beginTransaction();
      $insertQuery = "INSERT INTO `user_types`(`type`) value ('$userType')";
      $insertStatment = $con->prepare($insertQuery);
      $insertStatment->execute();
      $con->commit();
          $message = "insert user_type sucessfully";      
    } catch (PDOException $th) {
 
      $con->rollBack();
      $message = "some database Query error";
    }
    header("location:congrats?goto_page=user_types&message=$message");
  }
  $selectQuery = "select * from `user_types`";
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
        
        <section class="content">
        <div class="container-fluid">
          <!-- our code starts here -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Manage User Type</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Enter User Type</label>
                          <input type="text" class="form-control" id="user_type" name="user_type" placeholder="Enter User Type">
                        </div>
                      </div>


                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" "submit" class="btn-block btn btn-success">Save</button>
                        </div>
                      </div>

                    </div>

                    <!-- /.card-body -->

                </form>
              </div>
            </div>

            
            <!-- table starts here -->

            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">User Types</h3>
                </div>

                <div class="card-body">
                  <table id="user_type_id" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>S_No</th>
                        <th>User Type</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $count = 0;
                      while ($row = $selectStatment->fetch(PDO::FETCH_ASSOC)) {
                        $count++;
                        
                        ?>

                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $row['type']; ?></td>
                          <td><a class="btn btn-warning text-light " href="update_user_type?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
                          </td>
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
  addDataTable("user_type_id");
  });
</script>

</body>
</html>
