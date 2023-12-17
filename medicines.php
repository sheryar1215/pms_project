<?php
$pageTitle = "Manage Medicines";
$menuName = "Medicines";
include "config/connection.php";

if (isset($_POST['save'])) {

  $medicineName = $_POST['medicine_name'];

  try {

    $con->beginTransaction();

    $insertQuery = "INSERT INTO `medicines`(`medicine_name`) values ('$medicineName');";
    $insertStatment = $con->prepare($insertQuery);
    $insertStatment->execute();

    $con->commit();

    $message =  "success-Medicine has been added successfully.";
  } catch (PDOException $ex) {
    $con->rollBack();
    $message = "error-Sone database query error occured!";
  }

  header("location:congrats?goto_page=medicines&message=$message");
}

$selectQuery = "SELECT * FROM   `medicines` ";
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
                  <h3 class="card-title">Manage Medicines</h3>
                </div>

                <form method="post">
                  <div class="card-body">
                    <div class="row">

                    

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="medicine_name">Medicine Name</label>
                          <input type="text" class="form-control" id="medicine_name" name="medicine_name" 
                          placeholder="Enter Medicine Name" required = "required">
                        </div>
                      </div>


                      <div class="col-lg-2">
                        <div class="form-group">
                          <label for="">&nbsp;</label>
                          <button id="save" name="save" type="submit" class="btn-block btn btn-success">Save</button>
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
                  <h3 class="card-title">All Medicines</h3>
                </div>

                <div class="card-body">
                  <table id="medicine_table" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Medicines Name</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $count = 0;
                      while ($row = $selectStatment->fetch(PDO::FETCH_ASSOC)) {
                        $count++;
                        $btnClass = "";
                        $btnIcon = "";
                        if ($row['is_active'] == 1) {
                          $btnIcon = "fa fa-unlock";
                          $btnClass = "btn btn-success";
                        } else {
                          $btnIcon = "fa fa-lock";
                          $btnClass = "btn btn-danger";
                        }
                      ?>

                        <tr>
              <td><?php echo $count; ?></td>
                   <td><?php echo $row['medicine_name']; ?></td>
      <td><a class="btn btn-warning text-light" href="update_medicines?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
 <a class="<?php echo $btnClass ?>" href="common_block_unblock?id=<?php 
 echo $row['id'] ?>&status=<?php echo $row['is_active'] ?>&
 table_name=medicines&  
 goto_page=medicines&type=Medicine"> 
 <i class="<?php echo $btnIcon; ?>"></i></a>
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
    <!-- /.content-wrapper -->
    <?php include 'config/footer.php' ?>
  </div>
  <!-- ./wrapper -->

  <?php include 'config/site_js.php'; ?>


  <script>
    $(document).ready(function() {
      $("#medicines_menu").addClass('menu-open');
      $("#medicine_menu_link").addClass('active');
      $("#medicine_link").addClass('active');

      $("#medicine_name").blur(function() {

        var medicineName = $(this).val();

      if (medicineName !== '') {
        $.ajax({

            url: "ajax/check_generic_uniqueness",
            type: "get",
            async: false,
            data: {
              column_name: "medicine_name",
              table_name: "medicines",
              column_data: medicineName
            },
            success: function(count) {
              count = count * 1;

              if (count > 0) {
                showMessage("error", "Medicine already exist");
                $("#save").attr("disabled", true);
              } else {               
                $("#save").removeAttr("disabled");
              }

            }


          });
        }

      });
    });

    addDataTable("medicine_table");
  </script>
</body>

</html>