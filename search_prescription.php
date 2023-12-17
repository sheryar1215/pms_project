<?php
  $pageTitle = "Manage Search Prescriptions";
  $menuName = " Search Prescription";

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
        <div class="col-lg-12">

        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Search Prescription</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="my_div">
                <table id="search_presciption" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </thead>
                  <tbody>
                                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

       
 
  <!-- /.content-wrapper -->
  <?php include 'config/footer.php' ?>
</div>
<!-- ./wrapper -->

<?php  include 'config/site_js.php'; ?>

<script>
  $(document).ready(function(){
   
    $("#search_prescription_link").addClass('active');
    $("#patients_menue").addClass('menu-open');
      $("#patients_menue_link").addClass('active');
      // $('#my_table').DataTable();



      
    });

    addDataTable("search_presciption");

</script>
</body>
</html>
