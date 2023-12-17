<?php
  $pageTitle = "Manage Medicines Details";
  $menuName = "Medicines Details";
  
  include "common_services/common_functions.php";
  include "config/connection.php";
  
  $id = $_GET['id'];

  if(isset($_POST['save']))
  {
    $hiddenId = $_POST['hidden_id'];
    $medicineNameId = $_POST['medicine_id'];
    $medicinePacking = $_POST['medicine_details_name'];

    try{

      $con->beginTransaction();
        
      $updateQuery = "update  `medicine_details` set `packing` = '$medicinePacking' where `id` = $hiddenId ";
      $insertStatment = $con->prepare($updateQuery);
      $insertStatment->execute();
   
      $con->commit();

      $message = "Insert Medicines Details Sucessfully";
    }
  catch(PDOException $th){
  
    $con->rollBack();
    $message = "some database Query Error occurs";
  }
  header("location:congrats?goto_page=medicines_details&message=$message");
  }

  $selectQuery = "select *  from `medicine_details` where `id` = $id";
  $selectStatment  = $con->prepare($selectQuery);
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
                  <h3 class="card-title">Manage Medicines Packing</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">


                    <div class="col-lg-4">
                        <div class="form-group">
                          <label >Medicines Packing</label>
                          <select name="medicine_id" id="medicine_id" 
                          class="form-control" required = "required">                                                      
                            <?php
                           echo getAllMedicineNames($con, $row['medicien_id']);
                          ?>                          

                          </select>
                          
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label >Medicines Packing</label>
                          <input type="text" class="form-control" id="medicine_details_name"
                         value="<?php echo $row['packing'] ?>" 
                          name="medicine_details_name" required = "required"
                           placeholder="Enter Medicine Packing">
                        </div>
                      </div>

                      <input  id="hiddenid" name="hidden_id" type="hidden"  value="<?php echo $row['id'];?>">

                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button  id="save" name="save" type="submit" class="btn-block btn btn-success">update</button>
                        </div>
                      </div>
         </div>

                    <!-- /.card-body -->

                </form>
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
  $(document).ready(function () {
    $("#medicines_menu").addClass('menu-open');
    $("#medicine_menu_link").addClass('active');
    $("#medicine_details_link").addClass('active');
  
     
  });
</script>

</body>
</html>
