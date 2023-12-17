<?php
  $pageTitle = "Manage Diseases";
  $menuName = " Diseases";
include "config/connection.php";
 if(isset($_POST['save']))
 {

  $diseaseName = $_POST['disease_name'];
  try {
    $con->beginTransaction();
    $insertQuery = "INSERT INTO `diseases`(`disease_name`) value ('$diseaseName')";
    $insertStatment = $con->prepare($insertQuery);
    $insertStatment->execute();
    $con->commit();
    $message = "insert data sucessfully in disesases";
  } catch (PDOException $th) {
    $con->rollback();
    $message = "some data base querry error";
  }
 header("location:congrats?goto_page=diseases&message=$message");  
 }

   $selectQuery = "select * from `diseases`";
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
                  <h3 class="card-title">Manage Diseases</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Diseases Name</label>
                          <input type="text" class="form-control" id="disease_name" name="disease_name"
                           placeholder="Enter Disease Name" required = "required">
                        </div>
                      </div>


                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" "submit" class="btn-block btn btn-success">Save</button>
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
                  <table id="diseases_table" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>S_No</th>
                        <th>Diseases</th>
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
                        <td><?php echo $row['disease_name'] ?></td>
                        <td><a href="diseases_update?id=<?php echo $row['id']; ?>"class="btn btn-warning  text-light"><i class="fa fa-edit"></i></a></td>
                      </tr>

                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--  table end here -->
       
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
    addDataTable("diseases_table");
  });
</script>
</body>
</html>
